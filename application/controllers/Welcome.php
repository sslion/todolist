<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends User_Controller {

	public function index()
	{
	    redirect('todolist');
	    $data['content'] = $this->load->view('todolist', $this->data, TRUE);
		$this->load->view('templates/public_master_view', $data);
	}
}
