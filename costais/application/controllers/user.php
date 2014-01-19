<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
/*
 * Controlls aspect after the user as logged in/registers
 */
 
 //Index for costais controller
	public function index() {

		if($this->session->userdata('user')){
			//load url helper
			$this->load->helper('url');
			//load header		
			$this->load->view('bootstrap/user_header');
			
			$user = $this->session->userdata('user');
			$user_id = $user['id'];
			$userData = array();
			array_push($userData, array(
				'user_id' => $user['id'],
				'user_first' => $user['first'],
			));
			
			//load table for expense display
			$this->load->model(array('Transactions', 'Category'));
			$trans = $this->Transactions->get_with_id($user_id);
			$transactions = array();
			foreach($trans as $tran) {
				$category = new Category();
				$category->load($tran->trans_category);
				array_push($transactions, array(
					'trans_type' => $tran->trans_type,
					'trans_date' => $tran->trans_date,
					'trans_amount' => $tran->trans_amount,
					'trans_category' => $category->category_name,
					'trans_note' => $tran->trans_note,
					'trans_id' => $tran->trans_id,
				));
			}
			
			//load home view with array of data
			$this->load->view('user/user_home', array(
				'userData' => $userData,
				'transactions' => $transactions,
			));
		
		}
		else {
			redirect('/costais/');
		}
		
		
		//load footer
		$this->load->view('bootstrap/footer');
	}//index
	
/*	=	=	=	=	=	=	=	=	=	=	=	=	=	=	=	=	
 * 			Expense
 =	=	=	=	=	=	=	=	=	=	=	=	=	=	=	=	*/		
	
	public function addExpense() {
		//load session data		
		$user = $this->session->userdata('user');
		$user_id = $user['id'];
		
		//load form helper
		$this->load->helper('form');
		//load header
		$this->load->view('bootstrap/user_header');
		
		//populate categories for dropdown
		$this->load->model('Category');
		$categories = $this->Category->get_where(0);
		$category_from_options = array();
		foreach($categories as $id => $category) {
			$category_from_options[$id] = $category->category_name;
		}
		
		if($this->session->flashdata('success')) {
			redirect('/user/');
		}
		else {
			$this->load->view('user/add_expense', array(
				'category_form_options' => $category_from_options,
			));
		}
		
		//load footer
		$this->load->view('bootstrap/footer');
	}//end addExpense
	
	public function editExpense($trans_id) {
		$this->load->helper('url');
		$this->load->helper('form');
		
		//load session data		
		$user = $this->session->userdata('user');
		$user_id = $user['id'];
		
		$this->load->view('bootstrap/user_header');
		
		$this->load->model(array('Transactions', 'Category'));
		$transactions = new Transactions();
		$transactions->load($trans_id);
		
		//get the list of categories
		$categories = $this->Category->get_where(0);
		$category_form_options = array();
		foreach($categories as $id => $category) {
			$category_form_options[$id] = $category->category_name;
		}
		
		//get the category with the trans_id		
		$category = new Category();
		$category->load($transactions->trans_category);
		
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules(array(
			array(
				'field' => 'edit_trans_date',
				'label' => 'Date',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'edit_trans_amount',
				'label' => 'Amount',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'edit_category_id',
				'label' => 'Category',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'edit_trans_note',
				'label' => 'Note',
				'rules' => 'trim|required',
			),
		));		
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-success">', '</div>');
		
		$formatDate = date('Y-m-d', strtotime($this->input->post('edit_trans_date')));
		
		if($this->form_validation->run() == FALSE) {
			$this->load->view('user/edit_expense', array(
				'transactions' => $transactions,
				'category_form_options' => $category_form_options,
				'category' => $category,
			));
		}
		else {
			
			//load model
			$this->load->model('Transactions');
			$trans = new Transactions();
			
			$formatDate = date('Y-m-d', strtotime($this->input->post('edit_trans_date')));
			//extract values;
			$transData = array(
				$trans->user_id = $user_id,
				$trans->trans_type = 0,
				$trans->trans_id = $this->input->post('edit_trans_id'),
				$trans->trans_date = $formatDate,
				$trans->trans_amount = $this->input->post('edit_trans_amount'),
				$trans->trans_category = $this->input->post('edit_trans_category'),
				$trans->trans_note = $this->input->post('edit_trans_note'),			
			);
			
			//$this->db->where('trans_id', $trans->trans_id);
			$this->db->update('Transactions', $transData);
			
			redirect('/user/');
		}
	
		$this->load->view('bootstrap/footer');
		
	}//end editExpense


/*	=	=	=	=	=	=	=	=	=	=	=	=	=	=	=	=	
 * 			Income
 =	=	=	=	=	=	=	=	=	=	=	=	=	=	=	=	*/
	
	public function addIncome() {
		//load session data		
		$user = $this->session->userdata('user');
		$user_id = $user['id'];
		
		//load form helper
		$this->load->helper('form');
		//load header
		$this->load->view('bootstrap/user_header');
		
		//populate categories for dropdown
		$this->load->model('Category');
		$categories = $this->Category->get_where(1);
		$category_from_options = array();
		foreach($categories as $id => $category) {
			$category_from_options[$id] = $category->category_name;
		}
		
		if($this->session->flashdata('success')) {
			redirect('/user/');
		}
		else {
			$this->load->view('user/add_income', array(
				'category_form_options' => $category_from_options,
			));
		}
		
		//load footer
		$this->load->view('bootstrap/footer');
	}
	
	public function editIncome($trans_id) {
		$this->load->helper('url');
		$this->load->helper('form');
		
		//load session data		
		$user = $this->session->userdata('user');
		$user_id = $user['id'];
		
		$this->load->view('bootstrap/user_header');
		
		$this->load->model(array('Transactions', 'Category'));
		$transactions = new Transactions();
		$transactions->load($trans_id);
		
		//get the list of categories
		$categories = $this->Category->get_where(1);
		$category_form_options = array();
		foreach($categories as $id => $category) {
			$category_form_options[$id] = $category->category_name;
		}
		
		//get the category with the trans_id		
		$category = new Category();
		$category->load($transactions->trans_category);
		
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules(array(
			array(
				'field' => 'edit_inc_trans_date',
				'label' => 'Date',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'edit_inc_trans_amount',
				'label' => 'Amount',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'edit_inc_category_id',
				'label' => 'Category',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'edit_inc_trans_note',
				'label' => 'Note',
				'rules' => 'trim|required',
			),
		));		
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-success">', '</div>');
		
		$formatDate = date('Y-m-d', strtotime($this->input->post('edit_inc_trans_date')));
		
		if($this->form_validation->run() == FALSE) {
			$this->load->view('user/edit_income', array(
				'transactions' => $transactions,
				'category_form_options' => $category_form_options,
				'category' => $category,
			));
		}
		else {
			
			//load model
			$this->load->model('Transactions');
			$trans = new Transactions();
			
			$formatDate = date('Y-m-d', strtotime($this->input->post('edit_inc_trans_date')));
			//extract values;
			$transData = array(
				$trans->user_id = $user_id,
				$trans->trans_type = 0,
				$trans->trans_id = $this->input->post('edit_inc_trans_id'),
				$trans->trans_date = $formatDate,
				$trans->trans_amount = $this->input->post('edit_inc_trans_amount'),
				$trans->trans_category = $this->input->post('edit_inc_trans_category'),
				$trans->trans_note = $this->input->post('edit_inc_trans_note'),			
			);
			
			//$this->db->where('trans_id', $trans->trans_id);
			$this->db->update('Transactions', $transData);
			
			redirect('/user/');
		}
	
		$this->load->view('bootstrap/footer');
		
	}//end editIncome

	public function delete($trans_id) {
		$this->load->view('bootstrap/user_header');
		$this->load->model('Transactions');
		$transaction = new Transactions();
		$transaction->load($trans_id);
		if(!$transaction->trans_id) {
			show_404();
		}
		$transaction->delete();
		redirect('/user/');
	}//end delete

/*	=	=	=	=	=	=	=	=	=	=	=	=	=	=	=	=	
 * 			Category CRUD
 =	=	=	=	=	=	=	=	=	=	=	=	=	=	=	=	*/	
	
	public function categories() {
		//load form help for add category
		$this->load->helper('form');
		
		//load url helped for edit/delete
		$this->load->helper('url');
		
		//load header
		$this->load->view('bootstrap/user_header');
		
		//load table for display
		$this->load->library('table');
		$cats = array();
		//load model
		$this->load->model('Category');
		$cat = new Category();
		$categories = $this->Category->get();
		foreach($categories as $category) {
			$cats[] = array(
				$category->category_name,
				$category->category_type,
				anchor('/user/editCategory/' . $category->category_id, 'Edit') . ' | ' .
				anchor('/user/deleteCategory/' . $category->category_id, 'Delete'),
			);
		}
		
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
			//load the view, with array of data
			$this->load->view('user/categories', array(
				'cats' => $cats,
			));
		}   
		else {
			//extrack from input
			$cat->category_name = $this->input->post('category_name');
			$cat->category_type = $this->input->post('category_type');
			//save to db
			$cat->save();
			
			//after successful db add, load the page again
			redirect('/user/categories', 'refresh');	
		}
		
		//load footer
		$this->load->view('bootstrap/footer');
	}//end categories
	
	public function editCategory($category_id) {
		$this->load->helper('url');
		$this->load->helper('form');

		$this->load->view('bootstrap/user_header');
		
		$this->load->model('Category');
		$category = new Category();
		$category->load($category_id);
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules(array(
			array(
				'field' => 'edit_category_name',
				'label' => 'Edit category name',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'edit_category_type',
				'label' => 'Edit type',
				'rules' => 'trim|required',
			),
		));		
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-success">', '</div>');
		
		if($this->form_validation->run() == FALSE) {
			$this->load->view('user/edit_category', array(
				'category' => $category,		
			));
		}
		else {
			//category model already loaded			
			
			$category->category_id = $this->input->post('edit_category_id');
			$category->category_name = $this->input->post('edit_category_name');
			$category->category_type = $this->input->post('edit_category_type');
			
			$category->update($category_id);
			
			redirect('/user/categories');
		}
		
		$this->load->view('bootstrap/footer');
		
	}//end editCategory
	
	public function deleteCategory($category_id) {
		$this->load->view('bootstrap/user_header');
		$this->load->model('Category');
		$category = new Category();
		$category->load($category_id);
		if(!$category->category_id) {
			show_404();
		}
		$category->delete();
		redirect('/user/categories');
		
	}
	
	public function logout() {
		$this->session->unset_userdata('logged_in');
		//session_destroy();
		redirect('/costais/', 'refresh');
	}
	
}//end class
	