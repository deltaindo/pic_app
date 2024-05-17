<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluasi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('database');
        $this->load->library('form_validation');
    }
	public function index()
	{
        
        echo 'Under Construction';
	}

    public function form()
	{
       
        $this->form_validation->set_rules('nama','Nama','required');

        if($this->form_validation->run() == false) {
            $data['tittle'] = "Form Evaluasi";
            $data['judul'] = ['Pengaturan Waktu Pelatihan & Istirahat', 'Kualitas modul/materi selama pelatihan', 'Kemudahan sistem kelas online', 'Pelayanan Panitia/Petugas Kepada Peserta', 'Penyelenggaraan pelatihan secara online'];
            $data['checkbox'] = ['Baik Sekali', 'baik', 'sedang', 'kurang'];
            $data['user'] = $this->db->get_where('pendaftaran', ['id' => $this->session->userdata('id')])->row_array();
            $this->load->view('evaluasi/form', $data);
        }else {
            $this->_insert();
        }
        
        
	}

    public function instruktur()
	{
       
        $this->form_validation->set_rules('nama','Nama','required');

        if($this->form_validation->run() == false) {
            $data['tittle'] = "Form Evaluasi";
            $data['judul'] = [
                'Penguasaan materi pelatihan oleh Instruktur',
                'Teknik penyampaian materi pelatihan oleh Instruktur',
                'Kejelasan suara dan bahasa yang digunakan dalam penyampaian materi',
                'Cara memberikan kesempatan bertanya dan cara menjawab pertanyaan peserta sehubungan dengan materi pelatihan',
                'Penggunaan alat bantu dalam proses pelatihan media online',
                'Apakah materi yang diberikan pada pelatihan ini bermanfaat bagi peserta dalam menjalankan tugas sehari-hari',
            ];
            $data['checkbox'] = ['Baik Sekali', 'baik', 'sedang', 'kurang'];
            $data['user'] = $this->db->get_where('pendaftaran', ['id' => $this->session->userdata('id')])->row_array();
            $data['instruktur'] = $this->session->userdata('instruktur');
            $this->load->view('evaluasi/instruktur', $data);
        }else {
            $this->_evaluasi_instruktur();
        }
        
        
	}

    private function _evaluasi_instruktur()
    {
        $data = [
            
            'jawaban1' => $this->input->post('jawaban0'),
            'jawaban2' => $this->input->post('jawaban1'),
            'jawaban3' => $this->input->post('jawaban2'),
            'jawaban4' => $this->input->post('jawaban3'),
            'jawaban5' => $this->input->post('jawaban4'),
            'jawaban6' => $this->input->post('jawaban5'),
            'pesan' => $this->input->post('pesan'),
            'instruktur' => $this->input->post('instruktur'),
            'id_peserta' => $this->input->post('id_peserta'),
            'id_form' => $this->session->userdata('id_form'),
        ];
        $user = $this->db->get_where('pendaftaran',['id' => $this->input->post('id_peserta')])->row_array();
        $this->db->insert('survei_instruktur', $data);
        

        $this->send_sertifikat($user['no_wa'], $user['id'], $user['nama']);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Evaluasi Berhasil Di Kirim</div>');
        redirect('evaluasi/cek');
        
    }

    private function send_sertifikat($nomor, $id, $nama)
    {
        $curl = curl_init();
        $token = "1SvDVBjud0FI7MiQ4rarSlCdxHGMFmY2UsAZwsBiNYiXBCw3TxhoiHV2f252YEdo";
         
        $message = "*Dear $nama* Selamat anda sudah Melengkapi Form Evaluas,\n";
        $message .= "berikut Link untuk unduh sertifikat\n\n";
        $message .= 'https://localhost/pic/sertifikat/'.$id;
    
        $data = [
            'phone' => $nomor,
            'message' => $message,
        ];
    
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL,  "https://jogja.wablas.com/api/send-message");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);
    }

    public function _insert()
    {
        $data = [
            'id_peserta' => $this->input->post('id_peserta'),
            'id_form' => $this->session->userdata('id_form'),
            'jawaban1' => $this->input->post('jawaban0'),
            'jawaban2' => $this->input->post('jawaban1'),
            'jawaban3' => $this->input->post('jawaban2'),
            'jawaban4' => $this->input->post('jawaban3'),
            'jawaban5' => $this->input->post('jawaban4'),
            'kesan' => $this->input->post('kesan'),
            'pesan' => $this->input->post('pesan')
        ];
        $this->db->insert('survei', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Evaluasi Berhasil Di Kirim</div>');
        redirect('evaluasi/instruktur');
    }

    public function cek()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $id = $this->input->get('id');
        $instruktur = $this->input->get('instruktur');
        if ($this->form_validation->run() == false) {
            $data['tittle'] = "Form Evaluasi";
            $data['id'] = $id;
            $data['instruktur'] = $instruktur;
            $this->load->view('evaluasi/index', $data);
        } else {
                
            $this->_cekData();
            
        }
    }

    public function _cekData()
    {
        $nik = $this->input->post('nik');
        $id = $this->input->post('id');
        $instruktur = $this->input->post('instruktur');
        $user = $this->db->get_where('pendaftaran', ['nik' => strval($nik), 'id_form' => strval($id)])->row_array();
        

        // cek apakah nik terdaftarn di pelatihan tersebut
        if($user) {
            $survei = $this->db->get_where('survei', ['id_peserta' => $user['id']])->row_array();
            if($survei) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Form Survei Sudah di isi</div>');
                redirect('evaluasi/cek?id='.$id.'&instruktur='.$instruktur);
            }else{
                $data = [
                    'id' => $user['id'],
                    'instruktur' => $instruktur,
                    'id_form' => $id
                ];
                $this->session->set_userdata($data);
                redirect('evaluasi/form');  
            } 
        }else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Nik Tidak Terdaftar</div>');
            redirect('evaluasi/cek?id='.$id.'&instruktur='.$instruktur);
        }

        
    }
}
