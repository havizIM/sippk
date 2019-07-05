<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting extends CI_Controller {

	public function index()
	{
		$this->load->view('accounting/main');
	}
	
	public function dashboard()
	{
		$this->load->view('accounting/dashboard');
	}

	public function client($id = null)
	{	
		if($id == null){
			$this->load->view('agent/client');
		} else {
			$this->load->view('agent/detail_client');
		}
	}

	public function schedule()
	{
		$this->load->view('accounting/schedule');
	}

	public function instruction($id = null)
	{
		if($id == null){
			$this->load->view('accounting/instruction');
		} else {
			$this->load->view('accounting/detail_instruction');
		}
	}

	public function survey($id = null)
	{
		if($id == null){
			$this->load->view('accounting/survey');
		} else {
			$this->load->view('accounting/detail_survey');
		}
	}


}
