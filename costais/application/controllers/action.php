<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
/*	=	=	=	=	=	=	=	=	=	=	=	=	=	=	=	
 * 						 User Functions
=	=	=	=	=	=	=	=	=	=	=	=	=	=	=	 */	
	
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
		
	}//end login
	
/*	=	=	=	=	=	=	=	=	=	=	=	=	=	=	=	
 * 						 Expense Functions
=	=	=	=	=	=	=	=	=	=	=	=	=	=	=	 */	

	public function addExpense() {
		//load session data		
		$user = $this->session->userdata('user');
		$user_id = $user['id'];
				
		//load form validation
		$this->load->library('form_validation');
		$this->form_validation->set_rules(array(
			array(
				'field' => 'trans_date',
				'label' => 'Date',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'trans_amount',
				'label' => 'Amount',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'category_id',
				'label' => 'Category',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'trans_note',
				'label' => 'Note',
				'rules' => 'trim|required',
			),	
		));
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-success"', '</div>');
		
		if($this->form_validation->run() == FALSE) {
			//if form validation didnt run
			$this->session->set_flashdata('success', false);
			redirect('/user/addExpense');
		}
		else {
			//load model
			$this->load->model('Transactions');
			$trans = new Transactions();
			
			//extract values 
			$trans->user_id = $user_id;
			$trans->trans_type = $this->input->post(0);
			
			$formatDate = date('Y-m-d', strtotime($this->input->post('trans_date')));
			
			$trans->trans_date = $formatDate;
			$trans->trans_amount = $this->input->post('trans_amount');
			$trans->trans_category = $this->input->post('category_id');
			$trans->trans_note = $this->input->post('trans_note');
			
			//save to db
			$trans->save();
			
			$this->session->set_flashdata('success', true);
			
			redirect('/user/addExpense');
		}
		
	}//end addExpense
	
	
	public function addIncom() {
		//load session data		
		$user = $this->session->userdata('user');
		$user_id = $user['id'];
				
		//load form validation
		$this->load->library('form_validation');
		$this->form_validation->set_rules(array(
			array(
				'field' => 'inc_trans_date',
				'label' => 'Date',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'inc_trans_amount',
				'label' => 'Amount',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'inc_category_id',
				'label' => 'Category',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'inc_trans_note',
				'label' => 'Note',
				'rules' => 'trim|required',
			),	
		));
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-success"', '</div>');
		
		if($this->form_validation->run() == FALSE) {
			//if form validation didnt run
			$this->session->set_flashdata('success', false);
			redirect('/user/Income');
		}
		else {
			//load model
			$this->load->model('Transactions');
			$trans = new Transactions();
			
			//extract values 
			$trans->user_id = $user_id;
			$trans->trans_type = $this->input->post(1);
			
			$formatDate = date('Y-m-d', strtotime($this->input->post('inc_trans_date')));
			
			$trans->trans_date = $formatDate;
			$trans->trans_amount = $this->input->post('inc_trans_amount');
			$trans->trans_category = $this->input->post('inc_category_id');
			$trans->trans_note = $this->input->post('inc_trans_note');
			
			//save to db
			$trans->save();
			
			$this->session->set_flashdata('success', true);
			
			redirect('/user/addIncome');
		}
		
	}//end addExpense
	
/*	=	=	=	=	=	=	=	=	=	=	=	=	=	=	=	
 * 						 Expense Functions
=	=	=	=	=	=	=	=	=	=	=	=	=	=	=	 */	

	public function categories() {
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules(array(
			array(
				'field' => 'category_name',
				'label' => 'Category Name',
				'rules' => 'trim|required',
 			),
 			array(
				'field' => 'category_type',
				'label' => 'Type ',
				'rules' => 'required',
 			),
		));
		$this->form_validation->set_error_delimiters('<div class="alert alert-success">', '</div>');  
		
		if($this->form_validation->run() == FALSE) {
			//if validation didn't run
			$this->session->set_flashdata('success', false);
			redirect('/user/categories');
		}   
		else {
			//extrack from input
			$cat->category_name = $this->input->post('category_name');
			$cat->category_type = $this->input->post('category_type');
			//save to db
			$cat->save();
			
			//after successful db add, load the page again
			$this->session->set_flashdata('success', true);
			redirect('/user/categories');	
		}
		
		//load footer
		$this->load->view('bootstrap/footer');
	}
	
}//end class
