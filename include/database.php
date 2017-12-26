<?php
/**
 * @file
 * MySQL database interface that supports query logging.
 */

/**
 * @class Database
 * @brief MySQL database interface that supports query logging.
 * 
 * Extends the MySQLi class.
 */
class Database extends mysqli {
	
	/**
	 * Reserved session variable keys.
	 */
	public $reserved_keys = array('qid', 'rid');
	
	/**
	 * Logged queries.
	 * 
	 * Each entry is an associated array with the following fields:
	 *   - @c query -
	 *     query string
	 *   - @c resultmode -
	 *     the @c $resultmode parameter of the query
	 *   - @c success -
	 *     boolean, @c TRUE if query was successful, @c FALSE otherwise
	 */
	private $queries = array();
	
	/**
	 * Session or other variables that are stored in logs along with the query.
	 */
	private $session = array();
	
	/**
	 * Count the number of queries performed.
	 */
	private $counter = 0;
	
	/**
	 * Unique id generated for each request
	 */
	private $request_id = 0;
	
	/**
	 * MySQLi link to the database holding query logs.
	 */
	private $loghandler = NULL;
	
	/**
	 * Creates a new database connection.
	 * 
	 * Wrapper around the @c mysqli.__construct(). Port and socket parameters are
	 * not supported.
	 * 
	 * @param $host
	 *   Can be either a host name or an IP address. Passing the @c NULL value or
	 *   the string "localhost" to this parameter, the local host is assumed.
	 *   When possible, pipes will be used instead of the TCP/IP protocol.
	 *   <br />
	 *   Prepending host by p: opens a persistent connection.
	 *   @c mysqli_change_user() is automatically called on connections opened
	 *   from the connection pool.
	 * @param $username
	 *   The MySQL user name.
	 * @param $password
	 *   If not provided or @c NULL, the MySQL server will attempt to authenticate
	 *   the user against those user records which have no password only. This
	 *   allows one username to be used with different permissions (depending
	 *   on if a password as provided or not).
	 * @param $dbname
	 *   If provided will specify the default database to be used when
	 *   performing queries.
	 * @param $logdb
	 *   Database that contains the @c sv_querylog table. If @c NULL, then the
	 *   @c $dbname is used. If @c FALSE, logging to database is disabled.
	 */
	public function __construct( $host, $username, $password, $dbname, $logdb = NULL ) {
		parent::__construct( $host, $username, $password, $dbname );
		
		if(is_null($logdb)) {
			$logdb = $dbname;
		}
		
		if($logdb !== false) {
			$this->loghandler = new mysqli($host, $username, $password, $logdb);
			$this->request_id = md5(time() . rand());
		}
	}
	
	/**
	 * Performs a query on the database and logs it.
	 * 
	 * Query is handled by calling the @c mysqli.query()
	 * 
	 * @param $query
	 *   The query string. Data inside the query should be properly escaped.
	 * @param $resultmode
	 *   Either the constant @c MYSQLI_USE_RESULT or @c MYSQLI_STORE_RESULT
	 *   depending on the desired behavior. By default, @c MYSQLI_STORE_RESULT
	 *   is used.
	 * 
	 *   If you use @c MYSQLI_USE_RESULT all subsequent calls will return error
	 *   <i>Commands out of sync</i> unless you call @c mysqli_free_result()
	 * 
	 *   With @c MYSQLI_ASYNC (available with mysqlnd), it is possible to
	 *   perform query asynchronously. @c mysqli_poll() is then used to get
	 *   results from such queries.
	 * 
	 * @return
	 *   Returns @c FALSE on failure.
	 *   For successful @c SELECT, @c SHOW, @c DESCRIBE or @c EXPLAIN queries 
	 *   @c mysqli_query() will return a @c MySQLi_Result object.
	 *   For other successful queries @c mysqli_query() will return @c TRUE.
	 */
	public function query( $query, $resultmode = MYSQLI_STORE_RESULT ) {
		$result = parent::query( $query, $resultmode );
		
		// Logging
		$success = $result !== false;
		$error = !$success ? $this->error : NULL;
		
		$backtrace = debug_backtrace();
		
		$this->logQuery($query, $resultmode, $success, $backtrace);
		
		// Returning
		$this->counter++; // Increase the counter
		return $result;
	}
	
	/**
	 * Set the session variables stored in logs.
	 * 
	 * Variables are stored in an associated array.
	 * 
	 * Reserved keys: @c id
	 * 
	 * @param $key
	 *   Key of the session variable in the associated array.
	 * @param $value
	 *   Value of the session variable.
	 * @param $append
	 *   If @c TRUE, the session variable is turned into an array and the value
	 *   is appended to it. If @c FALSE, the session variable is simply stored
	 *   as a key value pair.
	 *   
	 *   Default: @c FALSE
	 */
	public function setSessionVariable( $key, $value, $append = FALSE ) {
		if( in_array($key, $this->reserved_keys) ) {
			trigger_error('Reserved session variable key: ' . $key, E_USER_WARNING);
			return;
		}
		
		if($append) {
			if( !is_array($session[$key]) ) {
				$session[$key] = array($session[$key]);
			}
			$this->session[$key][] = $value;
		} else {
			$this->session[$key] = $value;
		}
	}
	
	/**
	 * Logs a query.
	 * 
	 * @todo implement MySQL logging with prepared statements.
	 * 
	 * @param $query
	 *   Query string.
	 * @param $resultmode
	 *   @c $resultmode of the query.
	 * @param $success
	 *   @c TRUE if query was successfully executed, @c FALSE otherwise.
	 * @param $backtrace
	 *   Backtrace of the @c query() method call.
	 */
	private function logQuery( $query, $resultmode, $success, $backtrace ) {
		// Set internal session variables
		$this->session['qid'] = $this->counter;
		$this->session['rid'] = $this->request_id;
		
		// Log queries to the local variable
		$this->queries[] = array(
			'query' => $query,
			'resultmode' => $resultmode,
			'success' => $success,
			'backtrace' => $backtrace,
			'session' => $this->session
		);
		
		// logging to the 'sv_querylog' table
		if(is_null($this->loghandler)) return;
		
		$resultmode_str = $this->getResultmodeString($resultmode);
		$success_int = $success ? 1 : 0;
		$backtrace_ser = serialize($backtrace);
		$session_ser = serialize($this->session);
		
		$q = "INSERT INTO sv_querylog (query, resultmode, success, backtrace, session) VALUES (?, ?, ?, ?, ?)";
		$stmt = $this->loghandler->prepare($q);
		
		$stmt->bind_param('ssiss',
		         $query,
		         $resultmode_str,
		         $success_int,
		         $backtrace_ser,
		         $session_ser
		);
		
		if( !$stmt->execute() ) {
			trigger_error($stmt->error, E_USER_WARNING);
			trigger_error('Related query: ' . $q, E_USER_NOTICE);
		}
	}
	
	/**
	 * Returns an array of all log entries.
	 * 
	 * Array uses the same structure as the private @c $query variable.
	 * 
	 * @return
	 *   Array of all log entries.
	 */
	public function getLog() {
		return $this->queries;
	}
	
	/**
	 * Returns the HTML representation of the logged queries.
	 * 
	 * @todo Document the HTML format.
	 * 
	 * @return
	 *   String representing the HTML formatted queries.
	 */
	public function getHtmlQueries() {
		$queries_html = '<div id="debug"><div id="debugheader">MySQL queries</div>{QUERIES}</div>';
		$query_html = '<div class="debugitem"><b>{QUERY_NR}:</b> {QUERY} <i>({SUCCESS})</i></div>';

		$nr = 1;
		$queries = ( empty($this->queries) )?'<div class="debugitem"><i>No queries performed!</i></div>':'';
		foreach( $this->queries as $query ) {
			$i = $query_html;
			
			$i = str_replace('{QUERY}', $query['query'], $i);
			$i = str_replace('{QUERY_NR}', $nr, $i);
			$i = str_replace('{SUCCESS}', $query['success']?'successful':'failed', $i);
			//$i .= '<pre>' . print_r($this->session, true) . '</pre>';
			$queries .= $i;
			
			$nr++;
		}
		
		return str_replace('{QUERIES}', $queries, $queries_html);
	}
	
	/**
	 * Returns the current query count.
	 * 
	 * @return number of queries performed
	 */
	public function getQueryCounter() {
		return $this->counter;
	}
	
	/**
	 * Returns a string representation of a MySQLi query $resultmode variable.
	 * 
	 * @param $resultmode
	 *   A mysqli @c $resultmode variable.
	 * 
	 * @return
	 *   String representation of the variable (PHP's constant name).
	 *   In case of an invalid or unsupported @c $resultmode,
	 *   @c "INVALID_RESULTMODE({$resultmode})" is returned.
	 */
	public static function getResultmodeString( $resultmode ) {
		switch( $resultmode ) {
			case MYSQLI_STORE_RESULT:
				return 'MYSQLI_STORE_RESULT';
				break;
			case MYSQLI_USE_RESULT:
				return 'MYSQLI_USE_RESULT';
				break;
			default:
				return 'INVALID_RESULTMODE (' . $resultmode . ')';
				break;
		}
	}
}
