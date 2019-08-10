<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Input extends CI_Controller {	
	public function result(){
		$result = array(
			'code' => 0,
			'guide' => '',
			'info' => 'ok',
			'data' => array()
		);
		return $result;
	}
}