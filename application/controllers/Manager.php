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

	public function client($id = null)
	{	
		if($id == null){
			$this->load->view('manager/client');
		} else {
			$this->load->view('manager/detail_client');
		}
	}

	public function instruction($id = null)
	{
		if($id == null){
			$this->load->view('manager/instruction');
		} else {
			$this->load->view('manager/detail_instruction');
		}
	}

	public function survey($id = null)
	{
		if($id == null){
			$this->load->view('manager/survey');
		} else {
			$this->load->view('manager/detail_survey');
		}
	}

	public function schedule()
	{	
		$this->load->view('manager/schedule');
	}

	public function schedule_report()
	{	
		$this->load->view('manager/schedule_report');
	}

	public function sales_report()
	{	
		$this->load->view('manager/sales_report');
	}

}
