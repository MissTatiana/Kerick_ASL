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
			$this->load->model('Transactions');
			$trans = $this->Transactions->get_with_id($user_id);
			$transactions = array();
			foreach($trans as $tran) {
				array_push($transactions, array(
					'trans_type' => $tran->trans_type,
					'trans_date' => $tran->trans_date,
					'trans_amount' => $tran->trans_amount,
					'trans_category' => $tran->trans_category,
					'trans_note' => $tran->trans_note,
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
	}


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
			$this->load->view('user/add_expense', array(
				'category_form_options' => $category_from_options,
			));
		}
		
		//load footer
		$this->load->view('bootstrap/footer');
	}

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
				anchor('user/editCategory/' . $category->category_id, 'Edit') . ' | ' .
				anchor('user/deleteCategory/' . $category->category_id, 'Delete'),
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
	}

	public function editCateogy($category_id) {
		$this->load->helper('form');
		
		$this->load->view('bootstrap/user_header');
		
		//load table for display
		$this->load->library('table');
		$cats = array();
		//load model
		$this->load->model('Category');
		$cat = new Category();
		$cat->load($category_id);
		
		if(!$cat->category_id) {
			show_404();
		}
		
		$categories = $this->Category->get();
		foreach($categories as $category) {
			$cats[] = array(
				$category->category_name,
				anchor('user/edit/' . $category->category_id, 'Edit') . ' | ' .
				anchor('user/delete/' . $category->category_id, 'Delete'),
			);
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules(array(
			array(
				'field' => 'edit_category_name',
				'label' => 'Edit Category',
				'rules' => 'trim|required',
 			),
		));
		$this->form_validation->set_error_delimiters('<div class="alert alert-success">', '</div>');  
		
		if($this->form_validation->run() == FALSE) {
			//if validation didn't run
			//load the view, with array of data
			$this->load->view('user/edit_category', array(
				'cats' => $cats,
			));
		}   
		else {
			//extrack from input
			$cat->category_name = $this->input->post('edit_category_name');
			//save to db
			$cat->update();
			
			//after successful db add, load the page again
			redirect('/user/categories', 'refresh');	
		}
		
		$this->load->view('bootstrap/footer');
	}
	
	public function deleteCategory($category_id) {
		$this->load->view('bootstrap/user_header');
		
		$this->load->model('Category');
		$category = new Category();
		
		$category->delete();
		$this->load->view('user/category_deleted');
		
		$this->load->view('bootstrap/footer');
		
	}
	
	public function logout() {
		$this->session->unset_userdata('logged_in');
		//session_destroy();
		redirect('/costais/', 'refresh');
	}
	
}//end class
	