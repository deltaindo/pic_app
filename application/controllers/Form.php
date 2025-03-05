<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('token'))
        {
            show_404();
        }
        $this->load->model('api');
        $this->load->model('database');
    }
	public function index()
	{
        $form = $this->db->get_where('form',['id' => $this->session->userdata('id_form'), 'status' => 'Nonaktif'])->row_array();
        if($form) {
            $this->session->sess_destroy();
            show_404();
        }
        $kelas = $this->db->get_where('form',['id' => $this->session->userdata('id_form')])->row_array();
        $data['pendidikan'] = $this->database->getPendidikan($kelas['kelas']);
        $data['provinsi'] = $this->api->getProvinsi();
        $data['form'] = $this->session->userdata('form');
		$this->load->view('form/index', $data);
	}

    public function inhouse()
    {
        $form = $this->db->get_where('form',['id' => $this->session->userdata('id_form'), 'status' => 'Nonaktif'])->row_array();
        if($form) {
            $this->session->sess_destroy();
            show_404();
        }
 
        $data['pendidikan'] = $this->database->getPendidikan($kelas['kelas']);
        $data['provinsi'] = $this->api->getProvinsi();
        $data['form'] = $this->session->userdata('form');
		$this->load->view('form/inhouse', $data);
    }

    public function insertData()
    {
        $user = $this->db->get_where('pendaftaran',['nik' => $this->input->post('ktp')])->row_array();
        if($user) {
            if($user['id_program'] == $this->session->userdata('id_program')) {
                echo json_encode(array('status' => 'gagal', 'message' => 'NIK Anda Sudah terdaftar di Pelatihan Tersebut'));
            }else {
                $this->insert();
            }
        }else{
            $this->insert();
        }
        

    }

    public function insert()
    {
        $data = array(
            'id_form' => $this->session->userdata('id_form'),
            'id_program' => $this->session->userdata('id_program'),
            'nama' => $this->input->post('nama'),
            'nik' => $this->input->post('ktp'),
            'provinsi' => $this->input->post('provinsi'),
            'kabupaten' => $this->input->post('kabupaten'),
            'kecamatan' => $this->input->post('kecamatan'),
            'kelurahan' => $this->input->post('kelurahan'),
            'ttl' => $this->input->post('tempat_lahir'),
            'tgl_lahir' => $this->input->post('tanggal_lahir'),
            'golongan_darah' => $this->input->post('golongan'),
            'pendidikan' => $this->input->post('pendidikan'),
            'sekolah' => $this->input->post('nama_sekolah'),    
            'no_ijazah' => $this->input->post('no_ijazah'),
            'tgl_ijazah' => $this->input->post('tgl_ijazah'),
            'alamat' => $this->input->post('alamat_rumah'),
            'email' => $this->input->post('email'),
            'no_wa' => $this->input->post('wa'),
            'instansi' => $this->capitalizeWords($this->input->post('instansi')),
            'sektor' => $this->input->post('sektor'),
            'jabatan' => $this->input->post('jabatan'),
            'alamat_perusahaan' => $this->input->post('alamat_perusahaan'),
            'tlp_kantor' => $this->input->post('tlp_kantor')
        );
        
        $form = $this->db->get_where('form',['token' => $this->session->userdata('token')])->row_array();

        $user = $this->db->get_where('user',['id' => $form['id_user']])->row_array();

        $this->db->insert('pendaftaran', $data);
        $insert_id = $this->db->insert_id();
      
        $this->uploadDokumen($insert_id);
        $this->sendWhatsapp($this->input->post('wa'), $this->input->post('nama'), $user['phone_number'], $form['form'], $form['link_grup'], $user['nama'], $insert_id);
        $this->sendPic($this->input->post('wa'), $this->input->post('nama'), $user['phone_number'], $form['form'], $insert_id);
    }

    

    public function uploadDokumen($insert_id)
    {
        $upload_path = './pendaftaran/images/dokumen/';
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size'] = 2048; // Ukuran maksimum berkas (2MB)
        $config['encrypt_name'] = TRUE;
    
        $this->load->library('upload', $config);
    
        $data_to_insert = array(); // Inisialisasi array untuk data yang akan dimasukkan ke dalam database
        $data_to_insert['id_user'] = $insert_id;
        $document_types = array('surat', 'ijazah', 'ktp', 'sk', 'foto', 'bukti','cv','surat_sehat'); // Nama-nama jenis dokumen
    
        foreach ($document_types as $type) {
            if ($this->upload->do_upload($type)) {
                $data = $this->upload->data();
                $data_to_insert[$type] = $data['file_name'];
            } else {
                // Dokumen tidak diunggah, tetapi itu masih oke, lanjutkan saja.
                // Tidak perlu menampilkan pesan kesalahan.
            }
        }
    
        // Menambahkan field insert_id ke dalam data yang akan dimasukkan ke dalam database
       
    
        // Simpan data ke dalam database
        if ($this->db->insert('dokumen_pendaftaran', $data_to_insert)) {
            // Berhasil disimpan
            echo json_encode(array('status' => 'berhasil'));
        } else {
            // Gagal disimpan
            echo json_encode(array('status' => 'gagal', 'message' => 'Terjadi kesalahan saat menyimpan data ke database.'));
        }
    }

    private function sendPic($nomor, $nama, $tlp, $form,  $id)
    {
        $curl = curl_init();
        $token = "1SvDVBjud0FI7MiQ4rarSlCdxHGMFmY2UsAZwsBiNYiXBCw3TxhoiHV2f252YEdo";
    
        $message = "*$nama* Berhasil Mendaftar pada pelatihan *$form*,\n";
        $message .= "Nama Peserta: *$nama*\n";
         if (substr($nomor, 0, 2) !== '62') {
            $nomor = '62' . ltrim($nomor, '0');
        }
        $message .= "Nomor Telepon: (https://wa.me/$nomor)\n\n";
    
        // Inisialisasi daftar dokumen yang kosong
        $dokumenKosong = array();
    
        // Periksa setiap field dokumen dan tambahkan ke pesan jika kosong
        $queryResult = $this->db->get_where('dokumen_pendaftaran', ['id_user' => $id])->row();
        if (empty($queryResult->ktp)) {
            $dokumenKosong[] = "Foto KTP";
        }
        if (empty($queryResult->ijazah)) {
            $dokumenKosong[] = "Ijazah";
        }
        if (empty($queryResult->foto)) {
            $dokumenKosong[] = "Foto";
        }
        if (empty($queryResult->surat)) {
            $dokumenKosong[] = "Surat Pernyataan Peserta";
        }
        if (empty($queryResult->sk)) {
            $dokumenKosong[] = "Surat Keterangan Kerja";
        }
        if (empty($queryResult->cv)) {
            $dokumenKosong[] = "Curiculum Vitae";
        }
        if (empty($queryResult->surat_sehat)) {
            $dokumenKosong[] = "Surat Sehat";
        }
        if (empty($queryResult->bukti)) {
            $dokumenKosong[] = "Bukti Transfer (*jika Reguler*)";
        }
    
        // Cek apakah ada dokumen yang kosong
        if (!empty($dokumenKosong)) {
            // Jika ada dokumen yang kosong, tambahkan pesan untuk melengkapi dokumen
            $message .= "Dokumen yang belum diunggah :\n";
            foreach ($dokumenKosong as $dokumen) {
                $message .= "- $dokumen\n";
            }
        } else {
            // Jika tidak ada dokumen yang kosong, tambahkan pesan selamat datang kembali
            $message .= "";
        }
    
        $data = [
            'phone' => $tlp,
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

    private function sendWhatsapp($nomor, $nama, $tlp, $form, $grup, $pic, $id)
    {
        $curl = curl_init();
        $token = "1SvDVBjud0FI7MiQ4rarSlCdxHGMFmY2UsAZwsBiNYiXBCw3TxhoiHV2f252YEdo";
    
        $message = "*Dear $nama*,\n";
        $message .= "Terima kasih telah mendaftarkan biodata diri Anda untuk pelatihan *$form*.\n";
        $message .= "Kami sangat menghargai partisipasi Anda dalam program ini.\n";
        $message .= "Untuk pertanyaan atau informasi lebih lanjut, silakan hubungi PIC kami:\n";
        $message .= "Nama PIC: *$pic*\n";
         if (substr($tlp, 0, 2) !== '62') {
            $tlp = '62' . ltrim($tlp, '0');
        }
        $message .= "Nomor Telepon PIC: (https://wa.me/$tlp)\n\n";
        $message .= "Silahkan Bergabung di Grup untuk informasi lebih lanjut: $grup\n\n";
    
        // Inisialisasi daftar dokumen yang kosong
        $dokumenKosong = array();
    
        // Periksa setiap field dokumen dan tambahkan ke pesan jika kosong
        $queryResult = $this->db->get_where('dokumen_pendaftaran', ['id_user' => $id])->row();
        if (empty($queryResult->foto_ktp)) {
            $dokumenKosong[] = "Foto KTP";
        }
        if (empty($queryResult->ijazah)) {
            $dokumenKosong[] = "Ijazah";
        }
        if (empty($queryResult->foto)) {
            $dokumenKosong[] = "Foto";
        }
        if (empty($queryResult->surat)) {
            $dokumenKosong[] = "Surat Pernyataan Pesertan";
        }
        if (empty($queryResult->sk)) {
            $dokumenKosong[] = "Surat Keterangan Kerja";
        }
        if (empty($queryResult->bukti)) {
            $dokumenKosong[] = "Bukti Transfer";
        }
        if (empty($queryResult->cv)) {
            $dokumenKosong[] = "Curiculum Vitae";
        }
        if (empty($queryResult->surat_sehat)) {
            $dokumenKosong[] = "Surat Sehat";
        }
    
        // Cek apakah ada dokumen yang kosong
        if (!empty($dokumenKosong)) {
            // Jika ada dokumen yang kosong, tambahkan pesan untuk melengkapi dokumen
            $message .= "Ada beberapa dokumen yang belum Anda unggah. Silakan segera lengkapi dokumen-dokumen berikut sebelum batas waktu pendaftaran:\n";
            foreach ($dokumenKosong as $dokumen) {
                $message .= "- $dokumen\n";
            }
            $message .= "Anda Dapat Upload Dokumen trsbt ke Link Berikut : \n";
            $message .= base_url('dokumen');
        } else {
            // Jika tidak ada dokumen yang kosong, tambahkan pesan selamat datang kembali
            $message .= "";
        }

        
    
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
    

    public function success()
    {
        $this->load->view('form/success');
    }   
    
    public function getKab($selectedProvinsi)
    {
        $this->api->getKabupaten($selectedProvinsi);
    }

    public function getKecamatan($selectedKec)
    {
        $this->api->getKecamatan($selectedKec);
    }

    public function getKelurahan($selectedKec)
    {
        $this->api->getKelurahan($selectedKec);
    }

    private function capitalizeWords($input) {
        $output = '';
        $words = explode(' ', $input);
    
        foreach ($words as $word) {
            $output .= ucfirst(strtolower($word)) . ' ';
        }
    
        return rtrim($output);
    }

}
