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

	public function client($id = null)
	{	
		if($id == null){
			$this->load->view('admin/client');
		} else {
			$this->load->view('admin/detail_client');
		}
	}

	public function add_client()
	{
		$this->load->view('admin/add_client');
	}

	public function edit_client($id)
	{
		$this->load->view('admin/edit_client');
	}

	public function schedule()
	{	
		$this->load->view('admin/schedule');
	}

	public function survey($id = null)
	{
		if($id == null){
			$this->load->view('admin/survey');
		} else {
			$this->load->view('admin/detail_survey');
		}
	}

	public function instruction($id = null)
	{
		if($id == null){
			$this->load->view('admin/instruction');
		} else {
			$this->load->view('admin/detail_instruction');
		}
	}




}
