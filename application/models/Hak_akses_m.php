<?php 

class Hak_akses_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'hak_akses';
		$this->data['primary_key']	= 'id_hak_akses';
	}
}