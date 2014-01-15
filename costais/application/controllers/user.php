<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
/*
 * Controlls aspect after the user as logged in/registers
 */
 
 //Index for costais controller
	public function index() {		
		$this->load->view('bootstrap/user_header');
		$this->load->view('user/user_home');
		$this->load->view('bootstrap/footer');
	}
	
/*	=	=	=	=	=	=	=	=	=	=	=	=	=	=	=	=	
 * 			Expense
 =	=	=	=	=	=	=	=	=	=	=	=	=	=	=	=	*/		
	
	public function addExpense() {
		//load form helper
		$this->load->helper('form');
		//load header
		$this->load->view('bootstrap/user_header');
		
		//populate categories for dropdown
		$this->load->model('Category');
		$categories = $this->Category->get();
		$category_from_options = array();
		foreach($categories as $id => $category) {
			$category_from_options[$id] = $category->category_name;
		}
		
		//load form validation
		$this->load->library('form_validation');
		$this->form_validation->set_rules(array(
			array(
				'field' => 'user_id',
				'label' => 'User id',
				'rules' => 'required',
			),
			array(
				'field' => 'trans_type',
				'label' => 'Type',
				'rules' => 'required',
			),
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
				'field' => 'trans_category',
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
			//load add expense view, with array of categories
			$this->load->view('user/add_expense', array(
				'category_form_options' => $category_from_options,
			));
		}
		else {
			//load model
			$this->load->model('Transactions');
			$trans = new Transactions();
			
			//extract values 
			$trans->user_id = $this->input->post('user_id');
			$trans->trans_type = $this->input->post('trans_type');
			$trans->trans_date = $this->input->post('trans_date');
			$trans->trans_amount = $this->input->post('trans_amount');
			$trans->trans_category = $this->input->post('trans_category');
			$trans->trans_note = $this->input->post('trans_note');
			
			//save to db
			$trans->save();
			$this->load->view('user/user_home');
		}
		
		$this->load->view('bootstrap/footer');
	}


/*	=	=	=	=	=	=	=	=	=	=	=	=	=	=	=	=	
 * 			Income
 =	=	=	=	=	=	=	=	=	=	=	=	=	=	=	=	*/
	
	public function addIncome() {
		//load form helper
		$this->load->helper('form');
		//load header
		$this->load->view('bootstrap/user_header');
		
		$this->load->model('Category');
		$categories = $this->Category->get();
		$category_from_options = array();
		foreach($categories as $id => $category) {
			$category_from_options[$id] = $category->category_name;
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules(array(
			array(
				'field' => 'inc_user_id',
				'label' => 'User id',
				'rules' => 'required'
			),
			array(
				'field' => 'inc_trans_type',
				'label' => 'Type',
				'rules' => 'required'
			),
			array(
				'field' => 'inc_trans_date',
				'label' => 'Date',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'inc_trans_amount',
				'label' => 'Amount',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'inc_trans_category',
				'label' => 'Category',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'inc_trans_note',
				'label' => 'Note',
				'rules' => 'trim|required',
			),
		));
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-success">', '</div>');
		if($this->form_validation->run() == FALSE) {
			$this->load->view('user/add_income', array(
				'category_form_options' => $category_from_options,
			));
		}
		else {
			$this->load->model('Transactions');
			$trans = new Transactions();
			
			$trans->user_id = $this->input->post('inc_user_id');
			$trans->trans_type = $this->input->post('inc_trans_type');
			$trans->trans_date = $this->input->post('inc_trans_date');
			$trans->trans_amount = $this->input->post('inc_trans_amount');
			$trans->trans_category = $this->input->post('inc_trans_category');
			$trans->trans_note = $this->input->post('inc_trans_note');
			
			$trans->save();
			
			$this->load->view('user/user_home');
		}
		
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
	