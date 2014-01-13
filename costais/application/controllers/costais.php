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
	}//end index
	
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
			//if form validation didnt run, load reg form	
			$this->load->view('register');
		}
		else {
			//load Model
			$this->load->model('User');
			$user = new User();
			
			//extract values from reg form
			$user->user_first = $this->input->post('user_first');
			$user->user_last = $this->input->post('user_last');
			$user->user_email = $this->input->post('user_email');
			$user->user_pass = $this->input->post('user_pass');
			
			//save to db
			$user->save();
			//load success view
			$this->load->view('success');
			
		}
		//load footer
		$this->load->view('bootstrap/footer');
	}//end register
	
	//Log user in
	public function login() {
		//Load form helped for login
		$this->load->helper('form');
		
		//load header
		$this->load->view('bootstrap/header');
		
		//load validation
		$this->load->library('form_validation');
		$this->form_validation->set_rules(array(
			array(
				'field' => 'log_email',
				'label' => 'log_email',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'log_pass',
				'label' => 'log_pass',
				'rules' => 'trim|required|callback_check_database',
			),
		));
		
		if($this->form_validation->run() == FALSE) {
			//if validation didnt run, load login form
			$this->load->view('login');
		}
		else {
			//load user model
			$this->load->model('User');
			$user = new User();	
			
			$email = $this->input->post('log_email');
			$password = $this->input->post('log_pass');
			
			$result = $user->login($email, $password);
			
			if($result) {
				$sess_array = array();
				foreach($result as $row) {
					$sess_array = array(
	        			'id' => $row->id,
	         			'email' => $row->user_email,
	         			'first' => $row->user_first,
	      			);
					$this->session->set_userdata('logged in', $sess_array);
				}
				return TRUE;
			}
			else {
				$this->form_validation->set_message('check_database', "Invalid email or password");
				return FALSE;
			}
		}
		
		//load footer
		$this->load->view('bootstrap/footer');
	}//end login
	
	public function verifylogin() {
		$this->load->view('verifylogin');	
	}//end verifylogin

}//end class
