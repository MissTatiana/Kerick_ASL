<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Costais extends CI_Controller {
	/*
	 *Controlls aspects of site before user log in
	 * managed registering and logging in 
	 */
	
	//Index for costais controller
	public function index() {
		$this->load->helper('form');
		
		$this->load->view('bootstrap/header');
		$this->load->view('landing');
		$this->load->view('bootstrap/footer');
	}
	
	//Register user
	public function register() {
		//load form helper for register	
		$this->load->helper('form');
		
		//load header
		$this->load->view('bootstrap/header');
		
		//load validation for register
		$this->load->library('form_validation');
		$this->form_validation->set_rules(array(
			array(
				'field' => 'user_first',
				'label' => 'First Name',
				'rules' => ('trim|required|max_length[150]|xss_clean'),
			),
			array(
				'field' => 'user_last',
				'label' => 'Last Name',
				'rules' => ('trim|required|max_length[150]|xss_clean'),
			),
			array(
				'field' => 'user_email',
				'label' => 'Email Address',
				'rules' => ('required|valid_email|matches[conf_email]|is_unique[users.email]'),
			),
			array(
				'field' => 'conf_email',
				'label' => 'Confirm Email',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'user_pass',
				'label' => 'Password',
				'rules' => 'trim|required|matches[passconf]|md5',
			),
			array(
				'field' => 'conf_pass',
				'label' => 'Confirm Password',
				'rules' => 'trim|required',
			),
		));
		
		$this->form_validation->set_error_delimiter('<div class="alert alert-success"', '</div>');
		
		
		
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
