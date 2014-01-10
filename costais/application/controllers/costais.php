<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Costais extends CI_Controller {
	
	//Indes for costais controller
	public function index() {
		$this->load->helper('form');
		
		$this->load->view('bootstrap/header');
		$this->load->view('landing');
		$this->load->view('bootstrap/footer');
	}
	
	//Register user
	public function register() {
		$this->load->helper('form');
		
		$this->load->view('bootstrap/header');
		$this->load->view('register');
		$this->load->view('bootstrap/footer');
	}
	
	//Log user in
	public function login() {
		$this->load->helper('form');
		
		$this->load->view('bootstrap/header');
		$this->load->view('login');
		$this->load->view('bootstrap/footer');
	}
	
	public function user($user_id) {
		
	}

}//end class
