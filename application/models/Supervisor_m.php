<?php 

class Supervisor_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'supervisor';
		$this->data['primary_key']	= 'username';
	}

	public function login($data)
	{
		$result = $this->get_row(['username' => $data['username'], 'password' => $data['password']]);
		if (!isset($result))
			return $result;
		$this->session->set_userdata([
			'username'	=> $result->username,
			'role'		=> 'supervisor'
		]);
		return $result;
	}
}