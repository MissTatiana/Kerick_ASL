<?php 

class User extends My_Model {
	const DB_TABLE = 'users';
	const DB_TABLE_PK = 'user_id';
	
	//User unique identifer - int
	public $user_id;
	
	//User first name - string
	public $user_first;
	
	//User last name - string
	public $user_last;
	
	//User email address - string - should be hashed
	public $user_email;
	
	//User password - string
	public $user_pass;
	
}//end class

?>