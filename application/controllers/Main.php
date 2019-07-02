<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->load->view('client/main');
	}

	public function dashboard()
	{
		$this->load->view('client/dashboard');
	}

	public function profile()
	{
		$this->load->view('client/profile');
	}

	public function schedule()
	{
		$this->load->view('client/schedule');
	}

	public function add_schedule()
	{
		$this->load->view('client/add_schedule');
	}

    
}
