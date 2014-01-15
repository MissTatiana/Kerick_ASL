<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function register() {

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
		
		// user submitted invalid data
		if($this->form_validation->run() == FALSE) {
			//if form validation didnt run, load reg form
			
			$this->session->set_flashdata('success', false);
			// $this->session->set_flashdata('error', 'Y');
			
			redirect('/costais/register');
				
		}
		
		// user submitted valid data
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

			$this->session->set_flashdata('success', true);
			
			redirect('/costais/register');
			
		}

	}//end register
	
	public function login(){
		
		// validate variables
		
		// pull data about user from database
		
		// check if password in db matches form password
		
		// set session to database variable if matching
		
		// redirect to whatever page
		
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
			$this->session->set_flashdata('success', false);
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
	        			'id' => $row->user_id,
	         			'email' => $row->user_email,
	         			'first' => $row->user_first,
	      			);
					//probably need to pass in an array when loading vreify view
					$this->session->set_userdata('user', $sess_array);
				}
				redirect('/user/');
			}
			else {
				$this->session->set_flashdata('success', false);
			}
		}
		
	}
	
}//end class
