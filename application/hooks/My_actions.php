<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_actions {

	protected $CI;

	public function __construct()
	{
			$this->CI =& get_instance();
	}

	public function foo()
	{
			$this->CI->load->helper('url');
			redirect();
	}

	public function bar()
	{
			$this->CI->config->item('base_url');
	}

	public function action() {
			//$this->CI->load->helper('url');
			//$this->CI->load->library('session');

 			if(isset($_GET['action'])) 
		{
			$action = $_GET['action'];
			$this->$action();
		}
	}

	public function set_region() {
		if(isset($_GET['region_id']) && isset($_GET['region_name']))
		{
			$region_id = $_GET['region_id'];
			$region_name = $_GET['region_name'];
			//$this->CI->session->set_userdata('region_name', $region_name);
			$_COOCIE['region_name'] = $region_name;
			
		}
	}
}