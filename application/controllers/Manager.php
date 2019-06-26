<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {

	public function index()
	{
		$this->load->view('manager/main');
	}

	public function dashboard()
	{
		$this->load->view('manager/dashboard');
	}

	public function client()
	{
		$this->load->view('manager/client');
	}

}
