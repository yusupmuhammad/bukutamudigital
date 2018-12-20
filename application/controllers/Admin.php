<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function HalamanLogin()
	{
		$this->load->view('login');
	}

	public function login()
	{
		$data = array(
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password'))
		);

		$cek = $this->M_Admin->cekLogin($data);

		if ($cek > 0) {
			$sess = array(
				'status' => TRUE,
				'level'	 => 'admin'
			);

			$this->session->set_userdata($sess);

			redirect(base_url('admin/dashboard'));

		}else{

			redirect(base_url('login'));

		}
	}

	public function logout(){
		session_destroy();

		redirect(base_url());
	}

	public function HalamanDashboard(){
		if ($this->session->status === TRUE) {
			
				date_default_timezone_set("Asia/Jakarta");

				$apr = array('bulan' => 'April');
				$data['april'] = $this->M_Admin->baca_data($apr);

				// Filter bulan Mei
				$may = array('bulan' => 'May');
				$data['mei'] = $this->M_Admin->baca_data($may);

				// Filter bulan Juni
				$jun = array('bulan' => 'June');
				$data['juni'] = $this->M_Admin->baca_data($jun);

				// Filter bulan Juli
				$jul = array('bulan' => 'July');
				$data['juli'] = $this->M_Admin->baca_data($jul);

				// Filter berdasarkan bulan dan tahun sekarang
				$filter = array('bulan' => date('F'),
								'tahun' => date('Y'));
				$data['tamu'] = $this->M_Admin->baca_data($filter);
			$this->load->view('guestbook', $data);

		}else{
			redirect(base_url());
		}
	}

	public function tambahData() {
		// Lokasi waktu untuk jakarta dan sekitarnya
		date_default_timezone_set("Asia/Jakarta");

		$data = array(	'nama' => $this->input->post('nama', TRUE),
						'subject' => $this->input->post('subject', TRUE),
						'isi' => $this->input->post('isi', TRUE),
						'jam' => date('h:ia'),
						'tanggal' => date('j'),
						'bulan' => date('F'),
						'tahun'		=> date('Y')
					);
		$this->M_Admin->tambah_data($data);
		redirect('admin/dashboard');
	}

	public function pembaruanData() {

		// Diubah berdasarkan id
		$id = array('id' => $this->input->post('id', TRUE));

		$data = array(	'nama' => $this->input->post('nama', TRUE),
						'subject' => $this->input->post('subject', TRUE),
						'isi' => $this->input->post('isi', TRUE)
					);
		$this->M_Admin->ubah_data($data, $id);
		redirect('admin/dashboard');
	}

	public function hapusData() {
		$this->M_Admin->hapus();
		redirect('admin/dashboard');
	}
}