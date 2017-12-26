<?php
/** * @file * Configuration constants and variables.
 */
// Set debugging

define('DEBUG',         true);define('MYSQL_LOGGING', true);

/** * All global configuration variables are stored in this array.
 */

$config = array();// Database

$config['db']['username'] = '';$config['db']['password'] = '';
$config['db']['host']     = 'localhost';
$config['db']['database'] = '';

// Cookie parameters
$config['cookie']['name']   = 'omad';$config['cookie']['domain'] = '.fyysika.ee';
