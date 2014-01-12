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
		$this->load->view('bootstrap/user_header');
		$this->load->view('user/add_expense');
		$this->load->view('bootstrap/footer');
	}
	
}//end class
	