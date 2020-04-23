<?php

/**
 * 
 */
class Admin {
	private $_db,
	        $_data,
			$_sessionAdmin,
			$_cookieName,
			$_isLoggedIn;
	
	public function __construct($admin = null) 
	{
	 $this->_db = DB::getInstance();
	 
	 $this->_sessionAdmin = Config::get('session/session_admin');		
	 $this->_cookieName = Config::get('remember/cookie_name');	
	 
	 if (!$admin) {
		if (Session::exists($this->_sessionAdmin)) {
		  $admin = Session::get($this->_sessionAdmin);
		  if ($this->find($admin)) {
			 $this->_isLoggedIn = true;
		  }else {
			  //Process logout
		  }		
		} 
	 } else {
		 $this->find($admin);
	 }
	}
	
	public function update($fields = array(), $where)
	{
	  if (!$where && $this->isLoggedIn()) {
		  $adminid = $this->data()->adminid; 
	  }
		
	  if (!$this->_db->update('admin', $fields, $where)) {
		throw new Exception('There was an a problem updating.');
		 
	  }	
	}
	
	public function create($fields = array())
	{
	  if (!$this->_db->insert('admin', $fields)) {
		throw new Exception('There was an a problem creating an account.');
		 
	  }	
	}
	
	public function find($admin = null)
	{
	  if ($admin) {
		 $field = (is_numeric($admin)) ? 'adminid' : 'email';
		 $data = $this->_db->get("admin", "*", [$field => $admin]);
		 
		 if ($data->count()) {
		 	$this->_data = $data->first();
			return true;  
		 }
	  }	
	 return false;	
	}
	
	public function login($email = null, $password = null, $remember = false)
	{
	 if (!$email && !$password && $this->exists()) {
	 	Session::put($this->_sessionAdmin, $this->data()->adminid);
		 
	 } else {
		 
	  $admin = $this->find($email);
	  if ($admin) {
		 if ($this->data()->password === Hash::make($password, $this->data()->salt)) {
			Session::put($this->_sessionAdmin, $this->data()->adminid);
			
			if ($remember) {
			 $hash = Hash::unique();
			 $hashCheck = $this->_db->get("users_session", "*", ["user_id" => $this->data()->adminid]);
			 
			 if (!$hashCheck->count()) {
				$this->_db->insert('users_session', array(
				  'user_id' => $this->data()->adminid,
				  'hash' => $hash
				)); 
			 } else {
			   $hash = $hashCheck->first()->hash;
			 }
			 Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
			} 
			 
			return true; 
		 } 
	  }
	 }
	  return false;
	}
				
	public function hasPermission($key)
	{
	 $group = $this->_db->get("groups", "*", ["id" => $this->data()->user_type]);
	 
	 if ($group->count()) {
	   $permissions = json_decode($group->first()->permissions, true);
	   
	   if (isset($permissions[$key]) == true) {
		  return true;
	   }	 
		 
	 }
	  return false;	
	}
		
	public function exists()
	{
	 return (!empty($this->_sessionAdmin)) ? true : false;	
	}
	
	public function logout()
	{
	  $this->_db->delete("users_session", ["user_id" => $this->data()->adminid]);
		
	  Session::delete($this->_sessionAdmin);
	  Cookie::delete($this->_cookieName);
	}
	
	public function data()
	{
	  return $this->_data;
	}
	
    public function isLoggedIn()
	{
	  return $this->_isLoggedIn;
	}
	
}




?>