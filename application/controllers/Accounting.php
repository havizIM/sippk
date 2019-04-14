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

}
