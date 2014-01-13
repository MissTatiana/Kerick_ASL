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
				'rules' => ('trim|required|max_length[150]'),
			),
			array(
				'field' => 'user_last',
				'label' => 'Last Name',
				'rules' => ('trim|required|max_length[150]'),
			),
			array(
				'field' => 'user_email',
				'label' => 'Email Address',
				'rules' => ('trim|required|valid_email|matches[conf_email]|is_unique[users.user_email]'),
			),
			array(
				'field' => 'conf_email',
				'label' => 'Confirm Email',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'user_pass',
				'label' => 'Password',
				'rules' => 'trim|required|matches[conf_pass]|md5',
			),
			array(
				'field' => 'conf_pass',
				'label' => 'Confirm Password',
				'rules' => 'trim|required',
			),
		));
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-success"', '</div>');
		if($this->form_validation->run() == FALSE) {
			$this->load->view('register');
		}
		else {
			$this->load->model('User');
			$user = new User();
			
			$user->user_first = $this->input->post('user_first');
			$user->user_last = $this->input->post('user_last');
			$user->user_email = $this->input->post('user_email');
			$user->user_pass = $this->input->post('user_pass');
			
			$user->save();
			$this->load->view('success');
			
		}
		
		
		//$this->load->view('register');
		$this->load->view('bootstrap/footer');
	}
	
	//Log user in
	public function login() {
		$this->load->helper('form');
		
		$this->load->view('bootstrap/header');
		$this->load->view('login');
		$this->load->view('bootstrap/footer');
	}

}//end class
