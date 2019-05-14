<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent extends CI_Controller {

	public function index()
	{
		$this->load->view('agent/main');
	}
	public function dashboard()
	{
		$this->load->view('agent/dashboard');
	}

	public function client()
	{
		$this->load->view('agent/client');
	}

}
