<?php
/**
* xss_filter
*
* @package api
* @author mario.brandt
* @copyright Copyright (c) 2013
* @access public
 */
class xss_filter {
	private $allow_http_value = false;
	private $input;
	private $preg_patterns = array(
		// Fix &entity\n
		'!(&#0+[0-9]+)!' => '$1;',
		'/(&#*\w+)[\x00-\x20]+;/u' => '$1;>',
		'/(&#x*[0-9A-F]+);*/iu' => '$1;',
		//any attribute starting with "on" or xmlns
		'#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu' => '$1>',
		//javascript: and vbscript: protocols
		'#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu' => '$1=$2nojavascript...',
		'#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu' => '$1=$2novbscript...',
		'#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u' => '$1=$2nomozbinding...',
		// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
		'#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i' => '$1>',
		'#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu' => '$1>',
		// namespaced elements
		'#</*\w+:\w[^>]*+>#i' => '',
		//unwanted tags
		'#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i' => ''
	);

	private $normal_patterns = array(
		'\'' => '&lsquo;',
		'"' => '&quot;',
		'&' => '&amp;',
		'<' => '&lt;',
		'>' => '&gt;'
	);

	/**
	* xss_filter::filter_it()
	*
	* @access public
	* @param mixed $in
	* @return
	*/
	public function filter_it($in){
		$this->input = html_entity_decode($in, ENT_NOQUOTES, 'UTF-8');
		$this->normal_replace();
		$this->do_grep();
		return $this->input;
	}

	/**
	* xss_filter::allow_http()
	*
	*/
	public function allow_http(){
		$this->allow_http_value = true;
	}

	/**
	* xss_filter::disallow_http()
	*
	*/
	public function disallow_http(){
		$this->allow_http_value = false;
	}

	/**
	* xss_filter::normal_replace()
	*
	* @access private
	*/
	private function normal_replace(){
		$this->input = str_replace(array('&amp;', '&lt;', '&gt;'), array('&amp;amp;', '&amp;lt;', '&amp;gt;'), $this->input);
		if($this->allow_http_value == false){
			$this->input = str_replace(array('&', '%', 'script', 'http', 'localhost'), array('', '', '', '', ''), $this->input);
		}
		else
		{
			$this->input = str_replace(array('&', '%', 'script', 'localhost'), array('', '', '', ''), $this->input);
		}
		foreach($this->normal_patterns as $pattern => $replacement){
			$this->input = str_replace($pattern,$replacement,$this->input);
		}
	}

	/**
	* xss_filter::do_grep()
	*
	* @access private
	*/
	private function do_grep(){
		foreach($this->preg_patterns as $pattern => $replacement){
			$this->input = preg_replace($pattern,$replacement,$this->input);
		}
	}
}