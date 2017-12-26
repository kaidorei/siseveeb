<?php
/**
 * @file
 * File that describes the SessionManager class.
 *
 * @author Morten Piibeleht
 */

/**
 * @class SessionManager
 * @brief Creates, destroys and validates user sessions using MySQL and cookies.
 *
 * Uses the MySQLi interface for database communications.
 */
class SessionManager {
	// Configuration constants
	/**
	 * Session expire delay in seconds.
	 */
	const EXPIRE = 3600; // seconds
	/**
	 * Session cookie parameter configuration.
	 */
	private $cookie = NULL;

	/**
	 * Session table name in a MySQL database.
	 */
	private $table;

	/**
	 * Used to make sure that the request field is increased once
	 * per request.
	 */
	private $new_request = true;

	/**
	 * Creates a new session handler instance.
	 *
	 * Also deactivates all expires sessions.
	 *
	 * @param $db MySQLi database link.
	 * @param $table session table name in database.
	 */
	public function __construct( $db, $table, $cookie ) {
		$this->table = $table;
		$this->cookie = $cookie;

		// Deactivate old sessions
		$query = "UPDATE {$this->table} SET active = 0 WHERE active > 0 AND expires < CURRENT_TIMESTAMP;";
		if( ! ($result = $db->query($query)) ) {
			trigger_error($db->error, E_USER_ERROR);
			trigger_error('Related query: ' . $query, E_USER_NOTICE);
		}
	}

	/**
	 * Validates the current session.
	 *
	 * Checks for the existence of a session cookie and an active session.
	 *
	 * @param $db MySQLi database link.
	 * @param $update if TRUE, updates the current session (if any).
	 *   Default: TRUE
	 *
	 * @return TRUE if user's session ID corresponds to an active session,
	 *   FALSE otherwise
	 */
	public function validateSession( $db, $update = true ) {

		if( !isset($_COOKIE[$this->cookie['name']]) ) {
			return false;
		}

		$sid = $_COOKIE[$this->cookie['name']];

		$query = "SELECT id,uid FROM {$this->table} WHERE active > 0 AND sid = '{$sid}';";
		if( ! ($result = $db->query($query)) ) {
			trigger_error($db->error, E_USER_ERROR);
			trigger_error('Related query: ' . $query, E_USER_NOTICE);
		}

		// check for an active session
		if( $result->num_rows > 0 ) {
			$session_row = $result->fetch_assoc();
			$id = $session_row['id']; // row id
			$uid = $session_row['uid'];

			// if $update===true, update the session
			if( $update ) {
				$query = "UPDATE {$this->table} SET active=1, expires=ADDTIME(CURRENT_TIMESTAMP, SEC_TO_TIME(" . self::EXPIRE . ")), lastactivity=CURRENT_TIMESTAMP WHERE id={$id};";
				if( !$db->query($query) ) {
					trigger_error($db->error, E_USER_ERROR);
					trigger_error('Related query: ' . $query, E_USER_NOTICE);
				}

				setcookie( $this->cookie['name'], $sid, time()+self::EXPIRE, '/', $this->cookie['domain'] );
			}

			// Increase the request counter
			if( $this->new_request ) {
				$query = "UPDATE {$this->table} SET requests=requests+1 WHERE id={$id};";
				if( !$db->query($query) ) {
					trigger_error($db->error, E_USER_ERROR);
					trigger_error('Related query: ' . $query, E_USER_NOTICE);
				}

				$this->new_request = false;
			}

			return $uid;
		} else {
			return false;
		}
	}

	/**
	 * Creates a new session for the specified user ID.
	 *
	 * @param $db MySQLi database link.
	 * @param $uid user id
	 *
	 * @return nothing
	 */
	public function createSession( $db, $uid ) {

		$sid = SessionManager::generateSID();

		// Add a row to the session table
		$query = "INSERT INTO {$this->table} (sid, created, expires, lastactivity, active, uid) VALUES ('{$sid}', NOW(), ADDTIME(NOW(), SEC_TO_TIME(" . self::EXPIRE . ")), NOW(), 1, {$uid});";
		if( !$db->query($query) ) {
			trigger_error($db->error, E_USER_ERROR);
			trigger_error('Related query: ' . $query, E_USER_NOTICE);
		}
		echo "Tere";

		// Set user cookie
		setcookie( $this->cookie['name'], $sid, time()+self::EXPIRE, '/');//, $this->cookie['domain'] );
	}

	/**
	 * Destroys the current session.
	 *
	 * @param $db MySQLi database link.
	 *
	 * @return nothing
	 */
	public function destroySession( $db ) {
		if( !isset($_COOKIE[$this->cookie['name']]) ) {
			trigger_error( 'No session to destroy!', E_USER_NOTICE );
			return;
		}

		$sid = $_COOKIE[$this->cookie['name']];

		// Deactivate session in DB
		$query = "UPDATE {$this->table} SET active=0 WHERE active>0 AND sid='{$sid}';";
		if( ! ($result = $db->query($query)) ) {
			trigger_error($db->error, E_USER_WARNING);
			trigger_error('Related query: ' . $query, E_USER_NOTICE);
		}

		// Unset the session cookie
		setcookie( $this->cookie['name'], '', time()-3600, '/', $this->cookie['domain'] );
	}

	/**
	 * Returns an associative array with session information.
	 *
	 * @param $db MySQLi database link.
	 *
	 * @return associative array with session information
	 *   or @c FALSE on failure.
	 */
	public function sessionData( $db ) {
		if( !isset($_COOKIE[$this->cookie['name']]) ) {
			trigger_error( 'No session!', E_USER_NOTICE );
			return false;
		}

		$sid = $_COOKIE[$this->cookie['name']];

		$query = "SELECT * FROM {$this->table} WHERE sid='{$sid}'";
		if( ! ($result = $db->query($query)) ) {
			trigger_error($db->error, E_USER_WARNING);
			trigger_error('Related query: ' . $query, E_USER_NOTICE);
			return false;
		}

		return $result->fetch_assoc();
	}

	/**
	 * Creates a new random session ID.
	 *
	 * md5() of the HTTP_USER_AGENT, users IP, timestamp and a random integer
	 *
	 * @return new random SID
	 */
	static public function generateSID() {
		return md5( $_SERVER['HTTP_USER_AGENT'] + $_SERVER['REMOTE_ADDR'] + time() + rand() );
	}
}
