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
		$this->load->helper('form');
		
		$this->load->view('bootstrap/user_header');
		$this->load->view('user/add_expense');
		$this->load->view('bootstrap/footer');
	}
	
	public function addIncome() {
		$this->load->helper('form');
		
		$this->load->view('bootstrap/user_header');
		$this->load->view('user/add_income');
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
	