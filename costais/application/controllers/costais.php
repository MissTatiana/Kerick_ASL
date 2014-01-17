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
		
		if($this->session->flashdata('success')){
			$this->load->view('success');
		}else{
			$this->load->view('register');
		}
		
		if($this->session->flashdata('bad_creditials')) {
			//set some message for wrong email/password
		}
		
		$this->load->view('bootstrap/footer');
		
	}//end register
	
	//Log user in
	public function login() {
		$this->load->helper('form');
		
		$this->load->view('bootstrap/header');
		
		
		if($this->session->flashdata('success')){
			redirect('/user/');
		}
		else{
			$this->load->view('login');
		}
			
		$this->load->view('bootstrap/footer');
	}//end login
	
	public function verifylogin() {
		
		
		
		$this->load->view('verifylogin');	
	}//end verifylogin

}//end class
