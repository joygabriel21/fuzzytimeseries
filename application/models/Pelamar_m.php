<?php defined('BASEPATH') || exit('No direct script allowed');

class Pelamar_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'pelamar';
		$this->data['primary_key'] = 'id_pelamar';
	}
}

