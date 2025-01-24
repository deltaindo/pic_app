<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

date_default_timezone_set('Asia/Jakarta');

class Dokumen extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('database');
    }


    public function uploadDokumenUlang()
    {
       
        $data['field'] = $this->database->getFieldkosong($this->session->userdata('id'));
        $data['id'] = $this->session->userdata('id');
        $this->load->view('form/form', $data);

    }

    public function index()
    {
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nik', 'NIK', 'required');
       
        if ($this->form_validation->run() == false) {
            $data['tittle'] ='Cek Dokumen';
            $this->load->view('form/data');
        } else {
            
            $this->_cekData();
            
        }
    }

    public function _cekData()
    {
        $nik = $this->input->post('nik');
        $user = $this->db->get_where('pendaftaran',['nik' => $nik])->row_array();

        if($user) {
            $data = [
               
                'id' => $user['id']
               
            ];
                
            $this->session->set_userdata($data);
            redirect('dokumen/uploadDokumenUlang'); 
        }else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Nik Tidak Terdaftar</div>');
             redirect('dokumen');
        }

    }

    public function updatePeserta()
    {
        $upload_path = './pendaftaran/images/dokumen/';
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size'] = 2048; // Ukuran maksimum berkas (2MB)
        $config['encrypt_name'] = TRUE;
    
        $this->load->library('upload', $config);
    
        $data_to_update = array(); // Inisialisasi array untuk data yang akan diupdate
        $id_user = $this->input->post('id'); // ID user yang akan diupdate
    
        // Mendefinisikan jenis-jenis dokumen yang akan diupdate
        $document_types = array('surat', 'ijazah', 'ktp', 'sk', 'foto', 'bukti','surat_sehat');
    
        // Mendapatkan data dokumen lama (dokumen_old)
        $dokumen_old = $this->db->get_where('dokumen_pendaftaran', array('id_user' => $id_user))->row_array();
    
        foreach ($document_types as $type) {
            if ($this->upload->do_upload($type)) {
                $data = $this->upload->data();
                $data_to_update[$type] = $data['file_name'];
            } else {
                // Jika dokumen tidak diunggah, tetapkan dokumen lama jika ada
                if (isset($dokumen_old[$type])) {
                    $data_to_update[$type] = $dokumen_old[$type];
                }
            }
        }
    
        // Memastikan bahwa ID user tidak kosong dan setidaknya satu dokumen telah diunggah
        if (!empty($id_user) && !empty(array_filter($data_to_update))) {
            // Memperbarui data dokumen dalam database
            $this->db->where('id_user', $id_user);
            $this->db->update('dokumen_pendaftaran', $data_to_update);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Dokumen Berhasil di Upload</div>');
            redirect('dokumen');
        } else {
            // Menampilkan pesan kesalahan jika ID user atau dokumen kosong
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Mengupdate Dokumen</div>');
            redirect('dokumen');
        }
    }
    

}