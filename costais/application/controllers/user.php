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
	
	public function categories() {
		//load form help for add category
		$this->load->helper('form');
		
		//load url helped for edit/delete
		$this->load->helper('url');
		
		//load header
		$this->load->view('bootstrap/user_header');
		
		$this->load->library('table');
		$this->load->model('Categories');
		$categories = $this->Categories->get();
		foreach($categories as $category) {
			//still working on trying to display the categories
		}
		
		//load the view
		$this->load->view('user/categories');
		
		//load footer
		$this->load->view('bootstrap/footer');
	}
	
	public function logout() {
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('/costais/', 'refresh');
	}
	
}//end class
	