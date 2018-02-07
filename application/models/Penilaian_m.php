<?php defined('BASEPATH') || exit('No direct script allowed');

class Penilaian_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']  = 'penilaian';
		$this->data['primary_key'] = 'id_penilaian';
	}

	public function decide($hasil)
	{
		$this->load->model('keputusan_m');
		$keputusan = $this->keputusan_m->get_row(['min <=' => $hasil, 'max >=' => $hasil]);
		return isset($keputusan) ? $keputusan->nama : 'Tidak Layak';
	}

	public function defuzzification($data)
	{
		$this->load->model('bobot_m');
		$this->load->model('keputusan_m');
		$this->load->model('kriteria_m');

		$hasil = 0;
		foreach ($data as $row)
		{
			$nilai = $this->bobot_m->get_row(['id_bobot' => $row->id_bobot])->nilai;
			$bobot = $this->kriteria_m->get_row(['id_kriteria' => $row->id_kriteria])->bobot;
			// echo $this->crisping($row->id_kriteria, $nilai) . ' * ' . $bobot . ' + ';
			// echo $nilai . ' ';
			$hasil += $this->crisping($row->id_kriteria, $nilai) * $bobot;
		}

		return $hasil;
	}

	public function crisping($id_kriteria, $bobot)
	{
		return $bobot / $this->get_threshold($id_kriteria)->nilai_max;
	}

	public function get_nilai($cond = '')
	{
		if (is_array($cond) or (is_string($cond) && strlen($cond) > 3))
			$this->db->where($cond);
		$this->db->select(['id_penilaian', 'id_bobot', 'id_kriteria', 'id_pelamar', 'fuzzy', 'nilai']);
		$this->db->from($this->data['table_name']);
		$this->db->join('bobot', $this->data['table_name'] . '.id_bobot = bobot.id_bobot');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_threshold($id_kriteria, $type = 'MAX')
	{
		$this->db->select([$type . '(nilai) AS nilai_' . strtolower($type)]);
		$this->db->from($this->data['table_name']);
		$this->db->join('bobot', $this->data['table_name'] . '.id_bobot = bobot.id_bobot');
		$this->db->where([$this->data['table_name'] . '.id_kriteria' => $id_kriteria]);
		$query = $this->db->get();
		return $query->row();
	}

	public function max($cond = '')
	{
		$this->db->select_max('hasil');
		if (is_array($cond))
			$this->db->where($cond);
		if (is_string($cond) && strlen($cond) > 3)
			$this->db->where($cond);

		$query = $this->db->get($this->data['table_name']);

		return $query->row();
	}

	public function min($cond = '')
	{
		$this->db->select_min('hasil');
		if (is_array($cond))
			$this->db->where($cond);
		if (is_string($cond) && strlen($cond) > 3)
			$this->db->where($cond);

		$query = $this->db->get($this->data['table_name']);

		return $query->row();
	}

	public function total($cond = '')
	{
		$this->db->select_sum('hasil');
		if (is_array($cond))
			$this->db->where($cond);
		if (is_string($cond) && strlen($cond) > 3)
			$this->db->where($cond);

		$query = $this->db->get($this->data['table_name']);

		return $query->row();
	}
}

