<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
	}

	public function ext_login()
	{
		$this->load->view('ext_login');
	}
}
