<?php 

class My_Model extends CI_Model {
	const DB_TABLE = 'abstract';
	const DB_TABLE_PK = 'abstract';
	
	//Create record
	private function insert() {
		$this->db->insert($this::DB_TABLE, $this);
		$this->{$this::DB_TABLE_PK} = $this->db->insert_id();
	}//end insert
	
	//Update record
	private function update() {
		$this->db->update($this::DB_TABLE, $this, $this::DB_TABLE_PK);
	}//end update
	
	//Populate from an array or stand class
	public function populate($row) {
		foreach ($row as $key => $value) {
			$this->$key = $value;
		}
	}//end populate
	
	//Load from the db
	public function load($id) {
		$query = $this->db->get_where($this::DB_TABLE, array (
			$this::DB_TABLE_PK => $id
		));
		$this->populate($query->$row());
	}//end load
	
	//Delete current record
	public function delete() {
		$this->db->delete($this::DB_TABLE, array(
			$this::DB_TABLE_PK => $this->{$this::DB_TABLE_PK},
		));
		unset($this->{$this::DB_TABLE_PK});
	}//end delete
	
	//Save record
	public function save() {
		if(isset($this->{$this::DB_TABLE_PK})) {
			$this->update();
		}
		else {
			$this->insert();
		}
	}//end save
	
	/*
	 * Get an array of Model with an option limit, offset
	 * 
	 * return array Models populated by database, keyed by PK
	 */
	 public function get($limit = 0, $offset = 0) {
	 	if($limit) {
	 		$query = $this->db->get($this::DB_TABLE, $limit, $offset);
	 	}
		else {
			$query = $this->db->get($this::DB_TABLE);
		} 
		
		$ret_val = array();
		$class = get_class($this);
		
		foreach($query->result() as $row) {
			$model = new $class;
			$model->populate($row);
			$ret_val[$row->{$this::DB_TABLE_PK}] = $model;
		} 
		return $ret_val;
	 }//end get
	 
	public function get_where($type) {
		$query = $this->db->get_where($this::DB_TABLE, array('category_type' => $type));
		
		$ret_val = array();
		$class = get_class($this);
		
		foreach($query->result() as $row) {
			$model = new $class;
			$model->populate($row);
			$ret_val[$row->{$this::DB_TABLE_PK}] = $model;
		} 
		return $ret_val;
	}
	 
	 public function login($email, $password) {
	 	$this->db->select('user_id, user_email, user_first');
		$this->db->from('users');
		$this->db->where('user_email', $email);
		$this->db->where('user_pass', md5($password));
		$this->db->limit(1);
		
		$query = $this->db->get();
		
		if($query->num_rows() == 1) {
			return $query->result();
		}
		else {
			return false;
		}
		
	 }//end login
	
}//end class

?>