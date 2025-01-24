<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends CI_Controller {

	public function index()
	{
        $this->load->model('database');

        $data['tittle'] = "Jadwal Training";
        $data['training'] = $this->database->get_training();
        // var_dump($data['training']);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/jadwal', $data);
        $this->load->view('template/footer');
	}
}
