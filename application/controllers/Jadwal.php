<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

	public function index()
	{
        $this->load->model('database');

        $data['tittle'] = "Jadwal Training";
        $data['training'] = $this->database->get_training(); 
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/jadwal', $data);
        $this->load->view('template/footer');
	}

    public function pendaftaran($id)
    {
        $this->load->model('database');
        $data['tittle'] = 'Detail Peserta';
        $data['form'] = $this->database->getDataPeserta($id);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/detail', $data);
        $this->load->view('template/footer');
    }
}
