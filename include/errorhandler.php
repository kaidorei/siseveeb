<?php

/**
 * errorhandler.php
 * 
 * This file describes the ErrorHandler class.
 * 
 * Global variable $errorhandler is the instance of the class.
 */

class ErrorHandler {
	private $errors = array();
	
	public function __construct() {
		//
	}
	
	public function handlerCallback($errno, $errstr, $errfile, $errline, $errcontext) {
		$this->errors[] = func_get_args();
	
		// If the function returns FALSE then the normal error handler continues. [php.net/manual]
		return false;
		//return true;
	}
	
	public function getHtmlErrors() {
		$debug_html = '<div id="debug"><div id="debugheader">PHP debug</div>{DEBUG_ITEMS}</div>';
		$debugitem_html = '<div class="debugitem"><b>{DEBUG_ERROR}:</b> {DEBUG_MSG} <i>(in <b>{DEBUG_FILE}</b> on line <b>{DEBUG_LINE}</b>)</i></div>';

		$debugitems = ( empty($this->errors) )?'<div class="debugitem"><i>No errors reported!</i></div>':'';
		foreach( $this->errors as $error ) {
			$i = $debugitem_html;
			
			$i = str_replace('{DEBUG_ERROR}', ErrorHandler::errorLevel($error[0]), $i);
			$i = str_replace('{DEBUG_MSG}', $error[1], $i);
			$i = str_replace('{DEBUG_FILE}', $error[2], $i);
			$i = str_replace('{DEBUG_LINE}', $error[3], $i);
			$debugitems .= $i;
		}
		
		return str_replace('{DEBUG_ITEMS}', $debugitems, $debug_html);
	}
	
	public static function errorLevel($errno) {
		switch ($errno) {
		case E_ERROR:
			return 'Error';		
			break;

		case E_WARNING:
			return 'Warning';
			break;

		case E_NOTICE:
			return 'Notice';
			break;
			
		case E_DEPRECATED:
			return 'Deprecated';
			break;
			
		case E_USER_NOTICE:
			return 'User notice';
			break;
			
		case E_USER_WARNING:
			return 'User warning';
			break;
			
		case E_USER_ERROR:
			return 'User error';
			break;

		default:
			return 'Unknown ('.$errno.')';
			break;
		}
	}
}
