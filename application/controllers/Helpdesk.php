<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Helpdesk extends CI_Controller {

	public function index()
	{
		$this->load->view('helpdesk/main');
	}
	public function dashboard()
	{
		$this->load->view('helpdesk/dashboard');
	}
	public function user()
	{
		$this->load->view('helpdesk/user');
	}
	public function log_user()
	{
		$this->load->view('helpdesk/log_user');
	}
	public function add_user()
	{
		$this->load->view('helpdesk/add_user');
	}
	public function edit_user($id)
	{
		$this->load->view('helpdesk/edit_user');
	}
}
