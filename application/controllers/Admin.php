<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		$this->load->view('admin/main');
	}

	public function dashboard()
	{
		$this->load->view('admin/dashboard');
	}

	public function client()
	{
		$this->load->view('admin/client');
	}

	public function add_client()
	{
		$this->load->view('admin/add_client');
	}

	public function edit_client($id)
	{
		$this->load->view('admin/edit_client');
	}


}
