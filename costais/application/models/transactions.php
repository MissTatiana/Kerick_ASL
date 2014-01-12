<?php 

class Transactions extends My_Model {
	const DB_TABLE = 'transactions';
	const DB_TABLE_PK = 'tans_id';
	
	//Transactions unqiue identifier - int
	public $trans_id;
	
	//User's id for transactions specific to them - int
	public $user_id;
	
	//Transaction type (expense/income) - string
	public $trans_type;
	
	//Transactions date - date
	public $trans_date;
	
	//Transactions amount - int
	public $trans_amount;
	
	//Transactions category - string
	public $trans_category;
	
	//Transactions note - text
	public $trans_note;
	
}//end class


?>