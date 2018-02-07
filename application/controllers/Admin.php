<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
{
	private $data = [];

  	public function __construct()
	{
	    parent::__construct();		
        $this->data['username']     = $this->session->userdata('username');
        $this->data['id_hak_akses'] = $this->session->userdata('id_hak_akses');
        
        if (!isset($this->data['username'], $this->data['id_hak_akses']) or $this->data['id_hak_akses'] != 1)
        {
            $this->session->sess_destroy();
            redirect('login');
            exit;
        }

		$this->load->model('pelamar_m');
  	}

  	public function index()
  	{
        $this->load->model('hasil_penilaian_m');
        $this->load->model('user_m');
        $this->load->model('kriteria_m');
        $this->data['kriteria'] = $this->kriteria_m->get();
        $this->data['pengguna']	= $this->user_m->get();
        $this->data['hasil']    = $this->hasil_penilaian_m->get();
	    $this->data['pelamar']	= $this->pelamar_m->get();
	    $this->data['title'] 	= 'Dashboard Admin';
	    $this->data['content']	= 'admin/dashboard';
	    $this->template($this->data);
	}

	public function daftar_pelamar()
  	{
  		$this->load->model('kriteria_m');
  		$this->load->model('bobot_m');
  		$this->load->model('penilaian_m');
  		$this->load->model('keputusan_m');
  		$this->load->model('hasil_penilaian_m');
  		
  		if ($this->POST('simpan')) 
  		{
  			$this->data['entri'] = [
  				'nama'			=> $this->POST('nama'),
  				'alamat'		=> $this->POST('alamat'),
  				'tempat_lahir'	=> $this->POST('tempat_lahir'),
  				'tgl_lahir'		=> $this->POST('tgl_lahir'),
  				'no_hp'			=> $this->POST('no_hp'),
  				'email'			=> $this->POST('email'),
  				'jk'			=> $this->POST('jk')
  			];

  			$this->pelamar_m->insert($this->data['entri']);
            $this->upload($this->db->insert_id(), 'foto', 'foto');

  			$this->flashmsg('<i class="fa fa-check"></i> Data pelamar berhasil ditambahkan');
  			redirect('admin/daftar-pelamar');
  			exit;
  		}

        if ($this->POST('delete') && $this->POST('id_pelamar'))
        {
            $this->hasil_penilaian_m->delete_by(['id_pelamar' => $this->POST('id_pelamar')]);
            $this->penilaian_m->delete_by(['id_pelamar' => $this->POST('id_pelamar')]);
            $this->pelamar_m->delete($this->POST('id_pelamar'));
            @unlink(APPPATH . '../assets/foto/' . $this->POST('id_pelamar') . '.jpg');
            exit;
        }

  		$this->data['kriteria'] = $this->kriteria_m->get();

  		if ($this->POST('input_nilai') && $this->POST('id_pelamar'))
  		{
  			foreach ($this->data['kriteria'] as $kriteria)
  			{
  				$this->data['entri'] = [
  					'id_bobot'		=> $this->POST($kriteria->nama),
  					'id_kriteria'	=> $kriteria->id_kriteria,
  					'id_pelamar'	=> $this->POST('id_pelamar')
  				];

  				$this->penilaian_m->insert($this->data['entri']);
  			}

  			// $penilaian = $this->penilaian_m->get(['id_pelamar' => $this->POST('id_pelamar')]);
  			// $hasil = $this->penilaian_m->defuzzification($penilaian);
  			// $keputusan = $this->keputusan_m->get_row(['nama' => $this->penilaian_m->decide($hasil)]);
  			
  			// $this->data['entri'] = [
  			// 	'id_pelamar'	=> $this->POST('id_pelamar'),
  			// 	'hasil'			=> $hasil,
  			// 	'id_keputusan'	=> $keputusan->id_keputusan
  			// ];
  			
  			// $this->hasil_penilaian_m->insert($this->data['entri']);

  			$this->flashmsg('<i class="fa fa-check"></i> Nilai pelamar berhasil dimasukan');
  			redirect('admin/hasil-penilaian/' . $this->POST('id_pelamar'));
  			exit;
  		}

	    $this->data['title'] 	= 'Daftar Pelamar';
	    $this->data['content']	= 'admin/daftar_pelamar';
	    $this->data['pelamar']	= $this->pelamar_m->get();
	    $this->template($this->data);
	}

    public function kriteria()
    {
	    $this->load->model('Kriteria_m');
	    if ($this->POST('insert'))
	    {
	        $this->data['entry'] = [
                "nama"      => $this->POST("nama"),
                "benefit"   => $this->POST("benefit"),
                "bobot"     => $this->POST("bobot"),
            ];
            $this->Kriteria_m->insert($this->data['entry']);
            $this->flashmsg('<i class="fa fa-check"></i> Data Kriteria berhasil ditambahkan');
            redirect('admin/kriteria');
            exit;
	    }
	    
	    if ($this->POST('delete') && $this->POST('id_kriteria'))
	    {
            $this->Kriteria_m->delete($this->POST('id_kriteria'));
            $this->flashmsg('<i class="fa fa-check"></i> Data Kriteria berhasil dihapus');
            exit;
	    }
	        
	    if ($this->POST('edit') && $this->POST('edit_id_kriteria'))
	    {
            $this->data['entry'] = [
                "nama"      => $this->POST("nama"),
                "benefit"   => $this->POST("benefit"),
                "bobot"     => $this->POST("bobot"),
            ];
            $this->Kriteria_m->update($this->POST('edit_id_kriteria'), $this->data['entry']);
            $this->flashmsg('<i class="fa fa-check"></i> Data Kriteria berhasil diedit');
            redirect('admin/kriteria');
            exit;
	    }

	    if ($this->POST('get') && $this->POST('id_kriteria'))
	    {
            $this->data['kriteria'] = $this->Kriteria_m->get_row(['id_kriteria' => $this->POST('id_kriteria')]);
            echo json_encode($this->data['kriteria']);
            exit;
	    }
	        
	    $this->data['data']   = $this->Kriteria_m->get();
	    $this->data['columns']  = ["id_kriteria","nama","benefit","bobot",];
	    $this->data['title']  = 'Kriteria';
	    $this->data['content']  = 'admin/kriteria_all';
	    $this->template($this->data);
    }

	public function hasil_penilaian()
  	{
  		$this->data['id_pelamar']	= $this->uri->segment(3);
  		if (!isset($this->data['id_pelamar']))
  		{
  			redirect('admin/daftar-pelamar');
  			exit;
  		}

  		$this->load->model('kriteria_m');
  		$this->load->model('bobot_m');
  		$this->load->model('penilaian_m');
  		$this->load->model('keputusan_m');
  		$this->load->model('hasil_penilaian_m');

  		$this->data['pelamar']		= $this->pelamar_m->get_row(['id_pelamar' => $this->data['id_pelamar']]);
  		$this->data['penilaian']	= $this->penilaian_m->get(['id_pelamar' => $this->data['id_pelamar']]);
	    $this->data['title'] 		= 'Hasil Penilaian Pelamar';
	    $this->data['content']		= 'admin/hasil_penilaian';
	    $this->template($this->data);
	}

    public function ranking_penilaian()
    {
        $this->load->model('pelamar_m');
        $this->load->model('hasil_penilaian_m');
        $this->load->model('keputusan_m');
        $this->load->model('kriteria_m');
        $this->load->model('bobot_m');
        $this->load->model('penilaian_m');

        $this->data['kriteria']	= $this->kriteria_m->get();
        $this->data['hasil']    = $this->hasil_penilaian_m->get_by_order('hasil', 'DESC');
        $this->data['title']    = 'Ranking Pelamar';
        $this->data['content']  = 'admin/ranking_penilaian';
        $this->template($this->data);
    }

    public function user()
    {
        $this->load->model('user_m');

        if ($this->POST('simpan')) 
        {
          $pass1 = $this->POST('password1');
          $pass2 = $this->POST('password2');

          if($pass1 == $pass2){
            $this->data['entri'] = [
                'username'      => $this->POST('username'),
                'password'    => md5($this->POST('password1'))
              ];

              $id_hak_akses = $this->POST('id_hak_akses');
              if ($id_hak_akses == 'Admin')
              {
                $this->user_m->insert($this->data['entri']);
              }
              else if ($id_hak_akses == 'Supervisor')
              {
                $this->user_m->insert($this->data['entri']);
              }

              $this->flashmsg('<i class="fa fa-check"></i> Data admin berhasil ditambahkan');
              redirect('admin/user');
              exit;
          }
          else {
              $this->flashmsg('<i class="fa fa-close"></i> Password yang dimasukkan dengan konfirmasi password berbeda! Silahkan Input Ulang!','danger');
              redirect('admin/user');
              exit;
          }
        }

        if ($this->POST('edit') && $this->POST('id_user')) 
        {

            $pass1 = $this->POST('password1');
            $pass2 = $this->POST('password2');

            if($pass1 == $pass2)
            {
                $this->data['entri'] = [
                    'username'      => $this->POST('edit_username'),
                    'password'    => md5($this->POST('password1'))
                ];


                $this->user_m->update($this->POST('id_user'), $this->data['entri']);

                $this->flashmsg('<i class="fa fa-check"></i> Data admin berhasil diedit!');
                redirect('admin/user');
                exit;
            }
            else 
            {
              $this->flashmsg('<i class="fa fa-close"></i> Password yang dimasukkan dengan konfirmasi password berbeda! Silahkan Input Ulang!','danger');
              redirect('admin/user');
              exit;
            }
        }

        if ($this->POST('get') && $this->POST('id_user'))
        {
            $this->data['entri'] = $this->user_m->get_row(['id_user' => $this->POST('id_user')]);
            echo json_encode($this->data['entri']);
            exit;
        }

        if ($this->POST('delete') && $this->POST('id_user'))
        {
            $this->user_m->delete($this->POST('id_user'));
            exit;
        }

        $this->data['supervisor']   = $this->user_m->get();
        $this->data['user']         = $this->user_m->get();
        $this->data['title']        = 'Daftar User';
        $this->data['content']      = 'admin/user';
        $this->template($this->data);
    }

    public function input_penilaian()
    {
    	$this->data['id_pelamar'] = $this->uri->segment(3);
    	if (!isset($this->data['id_pelamar']))
    	{
    		$this->flashmsg('<i class="fa fa-warning"></i> Required parameter is missing', 'danger');
    		redirect('admin/daftar-pelamar');
    		exit;
    	}

    	$this->load->model('pelamar_m');
    	$this->data['pelamar'] = $this->pelamar_m->get_row(['id_pelamar' => $this->data['id_pelamar']]);
    	if (!isset($this->data['pelamar']))
    	{
    		$this->flashmsg('<i class="fa fa-warning"></i> Maaf, data pelamar tidak ditemukan.', 'danger');
    		redirect('admin/daftar-pelamar');
    		exit;
    	}

    	$this->load->model('kriteria_m');
    	$this->load->model('bobot_m');
        $this->load->model('penilaian_m');

    	$this->data['kriteria']	= $this->kriteria_m->get();

    	if ($this->POST('submit'))
    	{
    		foreach ($this->data['kriteria'] as $kriteria)
  			{
  				$this->data['entri'] = [
  					'id_bobot'		=> $this->POST(str_replace(' ', '_', $kriteria->nama)),
  					'id_kriteria'	=> $kriteria->id_kriteria,
  					'id_pelamar'	=> $this->data['id_pelamar']
  				];

                $check_penilaian = $this->penilaian_m->get_row([
                    'id_pelamar'    => $this->data['id_pelamar'], 
                    'id_kriteria'   => $this->data['entri']['id_kriteria']
                ]);
                
                if (isset($check_penilaian))
                {
                    $this->penilaian_m->update($check_penilaian->id_penilaian, $this->data['entri']);
                }
                else
                {
                    $this->penilaian_m->insert($this->data['entri']);
                }
  			}

  			$this->flashmsg('<i class="fa fa-check"></i> Nilai pelamar berhasil dimasukan');
            redirect('admin/perhitungan');
  			// redirect('admin/input-penilaian/' . $this->data['id_pelamar']);
  			exit;
    	}

    	$this->data['title']	= 'Input Penilaian' . $this->title; 
    	$this->data['content']	= 'admin/input_penilaian';
    	$this->template($this->data);
    }

    public function input_data_pelamar()
    {
    	$this->load->model('pelamar_m');
    	if ($this->POST('submit'))
    	{
            $tgl_lahir = $this->POST('tgl_lahir');
            $tgl_lahir = explode('/', $tgl_lahir);
            $tgl_lahir = $tgl_lahir[2] . '-' . $tgl_lahir[1] . '-' . $tgl_lahir[0];
    		$this->data['entri'] = [
  				'nama'			=> $this->POST('nama'),
  				'alamat'		=> $this->POST('alamat'),
  				'tempat_lahir'	=> $this->POST('tempat_lahir'),
  				'tgl_lahir'		=> $tgl_lahir,
  				'no_hp'			=> $this->POST('no_hp'),
  				'email'			=> $this->POST('email'),
  				'jk'			=> $this->POST('jk')
  			];

  			$this->pelamar_m->insert($this->data['entri']);
            $this->upload($this->db->insert_id(), 'foto', 'foto');

  			$this->flashmsg('<i class="fa fa-check"></i> Data pelamar berhasil ditambahkan');
  			redirect('admin/daftar-pelamar');
  			exit;
    	}

    	$this->data['title']	= 'Input Data Pelamar' . $this->title;
    	$this->data['content']	= 'admin/input_data_pelamar';
    	$this->template($this->data);
    }

    public function edit_profile()
    {
    	$this->load->model('user_m');
    	if ($this->POST('submit'))
    	{
    		$username 		= $this->POST('username');
    		$old_password	= $this->POST('old_password');
    		$check_pass 	= $this->user_m->get_row(['username' => $this->data['username'], 'password' => md5($old_password)]);
    		if ($check_pass)
    		{
    			$new_password 			= $this->POST('new_password');
    			$confirm_new_password	= $this->POST('confirm_new_password');
    			if ($new_password === $confirm_new_password)
    			{
    				$this->data['entri'] = [
    					'username'	=> $username,
    					'password'	=> md5($new_password)
    				];

    				$this->user_m->update($this->data['username'], $this->data['entri']);
    				$this->session->set_userdata(['username' => $username]);
    				$this->flashmsg('<i class="fa fa-check"></i> Profil berhasil di-edit');
    			}
    			else
    			{
    				$this->flashmsg('<i class="fa fa-warning"></i> Password baru anda tidak cocok dengan password konfirmasi', 'danger');		
    			}
    		}
    		else
    		{
    			$this->flashmsg('<i class="fa fa-warning"></i> Password lama anda tidak cocok', 'danger');
    		}

    		redirect('admin/edit-profile');
    		exit;
    	}

    	$this->data['title']	= 'Edit Profile' . $this->title;
    	$this->data['content']	= 'admin/edit_profile';
    	$this->template($this->data);
    }

    public function input_data_kriteria()
    {
    	$this->load->model('kriteria_m');
    	$this->load->model('bobot_m');

    	if ($this->POST('submit'))
    	{
    		$this->data['kriteria'] = [
    			'nama'		=> $this->POST('nama'),
    			'benefit'	=> $this->POST('benefit'),
    			'bobot'		=> $this->POST('bobot')
    		];
    		$this->kriteria_m->insert($this->data['kriteria']);

    		$fuzzy 			= $this->POST('fuzzy');
    		$nilai 			= $this->POST('nilai');
    		$id_kriteria 	= $this->db->insert_id();
    		for ($i = 0; $i < count($fuzzy); $i++)
    		{
    			$this->data['bobot'] = [
    				'id_kriteria'	=> $id_kriteria,
    				'fuzzy'			=> $fuzzy[$i],
    				'nilai'			=> $nilai[$i]
    			];
    			$this->bobot_m->insert($this->data['bobot']);
    		}

    		$this->flashmsg('<i class="fa fa-check"></i> Kriteria berhasil disimpan');
    		redirect('admin/perhitungan');
    		exit;
    	}

    	$this->data['title']	= 'Input Data Kriteria' . $this->title;
    	$this->data['content']	= 'admin/input_data_kriteria';
    	$this->template($this->data);
    }

    public function perhitungan()
    {
        $this->load->model('pelamar_m');
        $this->load->model('kriteria_m');
        $this->load->model('penilaian_m');
        $this->load->model('bobot_m');
        $this->load->model('hasil_penilaian_m');

        if ($this->POST('hitung_hasil'))
        {
            $pelamar = $this->pelamar_m->get();
            foreach ($pelamar as $row)
            {
                $penilaian = $this->penilaian_m->get(['id_pelamar' => $row->id_pelamar]);
                if (count($penilaian) > 0)
                {
                    $hasil      = $this->penilaian_m->defuzzification($penilaian);
                    $keputusan  = $this->keputusan_m->get_row(['nama' => $this->penilaian_m->decide($hasil)]);

                    $this->data['entri'] = [
                        'id_pelamar'    => $row->id_pelamar,
                        'hasil'         => $hasil,
                        'id_keputusan'  => $keputusan->id_keputusan
                    ];

                    $hasil_penilaian = $this->hasil_penilaian_m->get_row(['id_pelamar' => $row->id_pelamar]);
                    if ($hasil_penilaian)
                    {
                        $this->hasil_penilaian_m->update_where(['id_pelamar' => $row->id_pelamar], $this->data['entri']);
                    }
                    else
                    {
                        $this->hasil_penilaian_m->insert($this->data['entri']);
                    }
                }
            }

            $this->flashmsg('<i class="fa fa-check"></i> Hasil penilaian berhasil dikalkulasi');
            redirect('admin/perhitungan');
            exit;
        }

        $this->data['penilaian']    = $this->penilaian_m->get();
        $this->data['kriteria']     = $this->kriteria_m->get();
        $this->data['pelamar']      = $this->pelamar_m->get();
        $this->data['title']        = 'Perhitungan Fuzzy Simple Additive Weighting' . $this->title;
        $this->data['content']      = 'admin/perhitungan';
        $this->template($this->data);
    }
}
