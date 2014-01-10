<?php 

class Category extends My_Model {
	const DB_TABLE = 'categories';
	const DB_TABLE_PK = 'category_id';
	
	//Category unique identify - int
	public $category_id;
	
	//Category name - string
	public $category_name;
	
}//end class

?>