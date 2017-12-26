<?php

class Template {
	private $variables = array();
	private $template;
	
	public function __construct( $tpl ) {
		$this->template = $tpl;
	}
	
	public function setTag($tag, $value) {
		$this->variables[$tag] = $value;
	}
	
	public function parse() {
		$ret = $this->template;
		
		foreach( $this->variables as $tag => $value ) {
			$ret = str_replace('{' . $tag . '}', $value, $ret);
		}
		
		return $ret;
	}
}

class HTMLTemplate extends Template {
	const VARIABLE = 2;
	
	private $scripts = array();
	private $stylesheets = array();
	
	public function __construct( $file ) {
		parent::__construct( file_get_contents( $file ) );
	}
	
	public function parse() {
		$scripts_html = '';
		foreach( $this->scripts as $s ) {
			$scripts_html .= '<script type="text/javascript" src="' . $s . '"></script>';
		}
		$this->setTag('SCRIPTS', $scripts_html);
		
		$stylesheets_html = '';
		foreach( $this->stylesheets as $s ) {
			$stylesheets_html .= '@import url("' . $s . '");';
		}
		$this->setTag('STYLES', $stylesheets_html);
		
		return parent::parse();
	}
	
	public function addScript( $url ) {
		$this->scripts[] = $url;
	}
	
	public function addStylesheet( $url ) {
		$this->stylesheets[] = $url;
	}
}
