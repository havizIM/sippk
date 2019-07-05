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

	public function instruction($id = null)
	{
		if($id == null){
			$this->load->view('client/instruction');
		} else {
			$this->load->view('client/detail_instruction');
		}
	}

	public function add_instruction()
	{
		$this->load->view('client/add_instruction');
	}

	public function edit_instruction($id)
	{
		$this->load->view('client/edit_instruction');
	}

	public function survey($id = null)
	{
		if($id == null){
			$this->load->view('client/survey');
		} else {
			$this->load->view('client/detail_survey');
		}
	}

    
}
