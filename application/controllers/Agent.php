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
	
	public function survey($id = null)
	{
		if($id == null){
			$this->load->view('agent/survey');
		} else {
			$this->load->view('agent/detail_survey');
		}
	}
	
	public function instruction($id = null)
	{
		if($id == null){
			$this->load->view('agent/instruction');
		} else {
			$this->load->view('agent/detail_instruction');
		}
	}

	public function add_survey()
	{
		$this->load->view('agent/add_survey');
	}

	public function edit_survey()
	{
		$this->load->view('agent/edit_survey');
	}

	public function client($id = null)
	{	
		if($id == null){
			$this->load->view('agent/client');
		} else {
			$this->load->view('agent/detail_client');
		}
	}

}
