<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use SebastianBergmann\Environment\Console;

date_default_timezone_set('Asia/Jakarta');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data = [
            'id' => $user['id'],
            'email' => $user['email'],
            'nama' => $user['nama']
        ];
        $this->session->set_userdata($data);
        $this->load->model('database');
    }

    public function sertifikat_indonesia()
    {
        $data['tittle'] = 'Sertifikat Indonesia | Delta Indonesia';

        $this->db->order_by('id', 'DESC');
        $data['sertifikat_indonesia'] = $this->db->get('sertifikat_indonesia')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/sertifikat_indonesia', $data);
        $this->load->view('template/footer');
    }

    public function sertifikat_indonesia_simpan()
    {
        $data = [
            'sertifikat_indonesia' => $this->input->post('nama_sertifikat_indonesia')
        ];
        $this->db->insert('sertifikat_indonesia', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sertifikat Indonesia Berhasil di Tambah</div>');
        redirect('dashboard/sertifikat_indonesia');
    }

    public function edit_sertifikat_indonesia($id)
    {
        $data['tittle'] = 'Edit Sertifikat Indonesia | Delta Indonesia';
        $data['sertifikat_indonesia'] = $this->database->getDataSertifikatIndonesia($id);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/edit_sertifikat_indonesia', $data);
        $this->load->view('template/footer');
    }

    public function update_sertifikat_indonesia($id)
    {
        $data = [
            'sertifikat_indonesia' => $this->input->post('nama_sertifikat_indonesia')
        ];
        $this->db->where('id', $id);
        $this->db->update('sertifikat_indonesia', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sertifikat Indonesia Berhasil di Update</div>');
        redirect('dashboard/sertifikat_indonesia');
    }

    public function delete_sertifikat_indonesia($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('sertifikat_indonesia');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sertifikat Bahasa Indonesia Berhasil di Hapus</div>');
        redirect('dashboard/sertifikat_indonesia');
    }

    public function jenis_alat()
    {
        $data['tittle'] = 'Jenis Alat | Delta Indonesia';

        $this->db->order_by('id', 'DESC');
        $data['jenis_alat'] = $this->db->get('jenis_alat')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/jenis_alat', $data);
        $this->load->view('template/footer');
    }

    public function jenis_alat_edit($id)
    {
        $data['tittle'] = 'Edit Jenis Alat | Delta Indonesia';
        $data['jenis_alat'] = $this->database->getDataJenisAlat($id);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/edit_JenisAlat', $data);
        $this->load->view('template/footer');
    }

    public function delete_jenis_alat($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('jenis_alat');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jenis Alat Berhasil di Hapus</div>');
        redirect('dashboard/jenis_alat');
    }


    public function kelas_pembina()
    {
        $data['tittle'] = 'Daftar Kelas Pembina | Delta Indonesia';

        $this->db->order_by('id', 'DESC');
        $data['kelas'] = $this->db->get('kelas_pembina')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/kelas_pembina', $data);
        $this->load->view('template/footer');
    }

    public function kelas_simpan_pembina()
    {
        // Belum di auto increment pada database tabel kelas
        $data = [
            'kelas' => $this->input->post('nama_kelas')
        ];
        $this->db->insert('kelas_pembina', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kelas Berhasil di Tambah</div>');
        redirect('dashboard/kelas_pembina');
    }

    public function edit_kelas_pembina($id)
    {
        $data['tittle'] = 'Edit Kelas Pembina | Delta Indonesia';
        $data['kelas'] = $this->database->getDataKelas($id);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/edit_kelas', $data);
        $this->load->view('template/footer');
    }

    public function updateKelasPembina($id)
    {
        $data = [
            'kelas' => $this->input->post('nama_kelas')
        ];
        $this->db->where('id', $id);
        $this->db->update('kelas_pembina', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kelas Berhasil di Update</div>');
        redirect('dashboard/kelas_pembina');
    }

    public function delete_kelas_pembina($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('kelas_pembina');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kelas Pembina Berhasil di Hapus</div>');
        redirect('dashboard/kelas_pembina');
    }

    public function kelas()
    {
        $data['tittle'] = 'Daftar Kelas | Delta Indonesia';

        $this->db->order_by('id', 'DESC');
        $data['kelas'] = $this->db->get('kelas')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/kelas', $data);
        $this->load->view('template/footer');
    }

    public function kelas_simpan()
    {
        // Belum di auto increment pada database tabel kelas
        $data = [
            'kelas' => $this->input->post('nama_kelas')
        ];
        $this->db->insert('kelas', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kelas Berhasil di Tambah</div>');
        redirect('dashboard/kelas');
    }

    public function edit_kelas($id)
    {
        $data['tittle'] = 'Edit Kelas | Delta Indonesia';
        $data['kelas'] = $this->database->dataKelas($id);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/kelas_edit', $data);
        $this->load->view('template/footer');
    }

    public function updateKelas($id)
    {
        $data = [
            'kelas' => $this->input->post('nama_kelas')
        ];
        $this->db->where('id', $id);
        $this->db->update('kelas', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kelas Berhasil di Update</div>');
        redirect('dashboard/kelas');
    }

    public function delete_kelas($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('kelas');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kelas Berhasil di Hapus</div>');
        redirect('dashboard/kelas');
    }

    public function training()
    {
        $data['tittle'] = 'Daftar training | Delta Indonesia';

        $this->db->order_by('id', 'DESC');
        $data['training'] = $this->db->get('training')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/training', $data);
        $this->load->view('template/footer');
    }

    public function training_simpan()
    {
        $data = [
            'training' => $this->input->post('nama_training')
        ];
        $this->db->insert('training', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Training Berhasil di Tambah</div>');
        redirect('dashboard/training');
    }

    public function edit_training($id)
    {
        $data['tittle'] = 'Edit Training | Delta Indonesia';
        $data['training'] = $this->database->dataTraining($id);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/training_edit', $data);
        $this->load->view('template/footer');
    }

    public function update_training($id)
    {
        $data = [
            'training' => $this->input->post('nama_training')
        ];
        $this->db->where('id', $id);
        $this->db->update('training', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Training Berhasil di Update</div>');
        redirect('dashboard/training');
    }

    public function delete_training($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('training');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Training Berhasil di Hapus</div>');
        redirect('dashboard/training');
    }

    public function hapus_bulk_daftar_training()
    {
        $ids = $this->input->post('id');
        if ($ids) {
            foreach ($ids as $id) {
                $this->db->delete('training', ['id' => $id]);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Daftar Training Berhasil di Hapus</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Tidak ada Daftar Training yang dipilih untuk dihapus</div>');
        }
        redirect('dashboard/training');
    }

    public function hapus_bulk_kelas_pembina()
    {
        $ids = $this->input->post('id');
        if ($ids) {
            foreach ($ids as $id) {
                $this->db->delete('kelas_pembina', ['id' => $id]);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Daftar Kelas Pembina Berhasil di Hapus</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Tidak ada Daftar Kelas Pembina yang dipilih untuk dihapus</div>');
        }
        redirect('dashboard/kelas_pembina');
    }

    public function hapus_bulk_data_kelas()
    {
        $ids = $this->input->post('id');
        if ($ids) {
            foreach ($ids as $id) {
                $this->db->delete('kelas', ['id' => $id]);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Daftar Kelas Berhasil di Hapus</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Tidak ada Daftar Kelas yang dipilih untuk dihapus</div>');
        }
        redirect('dashboard/kelas');
    }

    public function hapus_bulk_jenis_bidang()
    {
        $ids = $this->input->post('id');
        if ($ids) {
            foreach ($ids as $id) {
                $this->db->delete('bidang', ['id' => $id]);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Daftar Bidang Berhasil di Hapus</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Tidak ada Daftar Bidang yang dipilih untuk dihapus</div>');
        }
        redirect('dashboard/daftar_bidang');
    }

    public function hapus_bulk_sertifikat_indonesia()
    {
        $ids = $this->input->post('id');
        if ($ids) {
            foreach ($ids as $id) {
                $this->db->delete('sertifikat_indonesia', ['id' => $id]);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Daftar Sertifikat Indonesia Berhasil di Hapus</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Tidak ada Daftar Sertifikat Indonesia yang dipilih untuk dihapus</div>');
        }
        redirect('dashboard/sertifikat_indonesia');
    }

    public function daftar_bidang()
    {
        $data['tittle'] = 'Daftar Bidang | Delta Indonesia';

        $this->db->order_by('id', 'DESC');
        $data['bidang'] = $this->db->get('bidang')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/bidang', $data);
        $this->load->view('template/footer');
    }

    public function simpan_bidang()
    {
        $data = [
            'bidang' => $this->input->post('nama_bidang')
        ];
        $this->db->insert('bidang', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Bidang Berhasil di Tambah</div>');
        redirect('dashboard/daftar_bidang');
    }

    public function edit_bidang($id)
    {
        $data['tittle'] = 'Edit Bidang | Delta Indonesia';
        $data['bidang'] = $this->database->dataBidang($id);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/bidang_edit', $data);
        $this->load->view('template/footer');
    }

    public function update_bidang($id)
    {
        $data = [
            'bidang' => $this->input->post('nama_bidang')
        ];
        $this->db->where('id', $id);
        $this->db->update('bidang', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Bidang Berhasil di Update</div>');
        redirect('dashboard/daftar_bidang');
    }

    public function delete_bidang($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('bidang');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Bidang Berhasil di Hapus</div>');
        redirect('dashboard/daftar_bidang');
    }

    public function jenis_personil()
    {
        $data['tittle'] = 'Daftar Jenis Personil | Delta Indonesia';

        $this->db->order_by('id', 'DESC');
        $data['personil'] = $this->db->get('jenis_personil')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/jenis_personil', $data);
        $this->load->view('template/footer');
    }

    public function jenis_personil_simpan()
    {
        $data = [
            'jenis_personil' => $this->input->post('nama_jenis_personil')
        ];
        $this->db->insert('jenis_personil', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jenis Personil Berhasil di Tambah</div>');
        redirect('dashboard/jenis_personil');
    }

    public function edit_personil($id)
    {
        $data['tittle'] = 'Edit Jenis Personil | Delta Indonesia';
        $data['personil'] = $this->database->dataJenisPersonil($id);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/jenis_personil_edit', $data);
        $this->load->view('template/footer');
    }

    public function updateJenisPersonil($id)
    {
        $data = [
            'jenis_personil' => $this->input->post('nama_jenis_personil')
        ];
        $this->db->where('id', $id);
        $this->db->update('jenis_personil', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jenis Personil Berhasil di Update</div>');
        redirect('dashboard/jenis_personil');
    }

    public function delete_jenis_personil($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('jenis_personil');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jenis Personil Berhasil di Hapus</div>');
        redirect('dashboard/jenis_personil');
    }

    public function hapus_bulk_jenis_personil()
    {
        $ids = $this->input->post('id');
        if ($ids) {
            foreach ($ids as $id) {
                $this->db->delete('jenis_personil', ['id' => $id]);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jenis Personil Berhasil di Hapus</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Tidak ada Jenis Personil yang dipilih untuk dihapus</div>');
        }
        redirect('dashboard/jenis_personil');
    }

    public function pendidikan()
    {
        $data['tittle'] = 'Daftar Jenis Pendidikan | Delta Indonesia';

        $this->db->order_by('id', 'DESC');
        $data['pendidikan'] = $this->db->get('pendidikan')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/jenis_pendidikan', $data);
        $this->load->view('template/footer');
    }

    public function pendidikan_simpan()
    {
        $data = [
            'pendidikan' => $this->input->post('nama_jenis_pendidikan')
        ];
        $this->db->insert('pendidikan', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jenis Pendidikan Berhasil di Tambah</div>');
        redirect('dashboard/pendidikan');
    }

    public function edit_jenis_pendidikan($id)
    {
        $data['tittle'] = 'Edit Jenis Pendidikan | Delta Indonesia';
        $data['pendidikan'] = $this->database->dataJenisPendidikan($id);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/jenis_pendidikan_edit', $data);
        $this->load->view('template/footer');
    }

    public function update_pendidikan($id)
    {
        $data = [
            'pendidikan' => $this->input->post('nama_pendidikan')
        ];
        $this->db->where('id', $id);
        $this->db->update('pendidikan', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jenis Pendidikan Berhasil di Update</div>');
        redirect('dashboard/pendidikan');
    }

    public function delete_jenis_pendidikan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pendidikan');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jenis Pendidikan Berhasil di Hapus</div>');
        redirect('dashboard/pendidikan');
    }

    public function hapus_bulk_jenis_pendidikan()
    {
        $ids = $this->input->post('id');
        if ($ids) {
            foreach ($ids as $id) {
                $this->db->delete('pendidikan', ['id' => $id]);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jenis Pendidikan Berhasil di Hapus</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Tidak ada Jenis Pendidikan yang dipilih untuk dihapus</div>');
        }
        redirect('dashboard/pendidikan');
    }

    public function update_jenis_alat($id)
    {
        $data = [
            'jenis_alat' => $this->input->post('jenis_alat')
        ];
        $this->db->where('id', $id);
        $this->db->update('jenis_alat', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jenis Alat Berhasil di Update</div>');
        redirect('dashboard/jenis_alat');
    }

    public function hapus_bulk_jenis_alat()
    {
        $ids = $this->input->post('id');
        if ($ids) {
            foreach ($ids as $id) {
                $this->db->delete('jenis_alat', ['id' => $id]);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jenis Alat Berhasil di Hapus</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Tidak ada Jenis Alat yang dipilih untuk dihapus</div>');
        }
        redirect('dashboard/jenis_alat');
    }

    public function index()
    {
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['tittle'] = 'Halaman PIC | Delta Indonesia';
        $data['form'] = $this->db->order_by('tanggal_pembuatan', 'desc')->get_where('form', ['id_user' => $this->session->userdata('id')])->result_array();
        $data['bidang'] = $this->db->get('bidang')->result_array();
        $data['training'] = $this->db->get('training')->result_array();
        $data['kelas'] = $this->db->get('kelas')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/pendaftaran', $data);
        $this->load->view('template/footer');
    }

    public function editPendaftaran()
    {
        if ($this->input->post()) {
            $ids = $this->input->post('id');
            $forms = $this->input->post('form');
            $dates = $this->input->post('tanggal');
            $groups = $this->input->post('grup');

            for ($i = 0; $i < count($ids); $i++) {
                $data = array(
                    'form' => $forms[$i],
                    'tanggal_pelaksanaan' => $dates[$i],
                    'link_grup' => $groups[$i],
                    // Add other fields if needed
                );

                // Update data using set method
                $this->db->set($data);
                $this->db->where('id', $ids[$i]);
                $this->db->update('form');
            }

            redirect('dashboard');
        } else {
            // Handle the case where the form is not submitted
        }
    }

    public function admin()
    {
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($user['level'] != 1) {
            show_404();
        }
        $data['tittle'] = 'Halaman Admin | Delta Indonesia';
        $data['form'] = $this->database->getForm();
        $data['training'] = $this->db->get('training')->result_array();
        $data['kelas'] = $this->db->get('kelas')->result_array();
        $data['bidang'] = $this->db->get('bidang')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/admin', $data);
        $this->load->view('template/footer');
    }

    public function profil()
    {
        $data['tittle'] = 'judul';
        $data['profil'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/profil', $data);
        $this->load->view('template/footer');
    }
    public function hapus()
    {
        $id = $this->input->post('id');

        foreach ($id as $i) {
            $data = [
                'id' => $i
            ];

            $this->db->delete('form', $data);
        }
        echo 'sukses';
    }

    public function hapus_pembina()
    {
        $id = $this->input->post('id');

        foreach ($id as $i) {
            $data = [
                'id' => $i
            ];

            $this->db->delete('tb_kelompok_pembinaan', $data);
        }
        echo 'sukses';
    }

    public function hapusData()
    {
        $ids = $this->input->post('id');

        foreach ($ids as $id) {
            // Mengambil nama file dari tabel dokumen_pendaftaran
            $query = $this->db->get_where('dokumen_pendaftaran', array('id_user' => $id));

            // Memastikan ada hasil dari query
            if ($query->num_rows() > 0) {
                $results = $query->result();

                foreach ($results as $result) {

                    // Jenis file yang terkait dengan pendaftaran
                    $jenis_file = array('surat', 'ijazah', 'ktp', 'sk', 'foto', 'bukti', 'surat_sehat');

                    // Menghapus file dari folder
                    foreach ($jenis_file as $jenis) {
                        $file_path = FCPATH . 'pendaftaran/images/dokumen/' . $result->$jenis;

                        if (file_exists($file_path)) {
                            unlink($file_path);
                        }
                    }
                    // Menghapus data dari tabel pendaftaran
                    $this->db->delete('pendaftaran', array('id' => $id));

                    // Menyelesaikan transaksi
                    $this->db->trans_complete();
                }
            } else {
                // Handle jika tidak ada data yang ditemukan
                echo "Data tidak ditemukan!";
            }
        }

        echo 'sukses';
    }

    public function editForm()
    {

        $this->form_validation->set_rules('form[]', 'Form', 'required');
        if ($this->form_validation->run() == FALSE) {
            $selected_ids = $this->input->post('id');

            if (!empty($selected_ids)) {
                // Membuat kueri IN untuk mengambil elemen berdasarkan id yang dipilih
                $this->db->where_in('id', $selected_ids);
                $data['produk'] = $this->db->get('form')->result_array();
            } else {
                // Jika tidak ada yang dipilih, alihkan ke halaman dashboard
                redirect('dashboard');
            }

            $data['tittle'] = 'Edit Form';
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('dashboard/edit', $data);
            $this->load->view('template/footer');
        } else {
            $this->update();
        }
    }

    public function editPeserta()
    {
        $selected_ids = $this->input->post('id');

        if (!empty($selected_ids)) {
            $this->db->where_in('id_user', $selected_ids);
            $data['produk'] = $this->db->get('dokumen_pendaftaran')->row_array();
        } else {
            redirect('dashboard');
        }

        $data['tittle'] = 'Edit Data Peserta';
        $data['field'] = $this->database->getFieldkosong(reset($selected_ids));

        // Tidak ada validasi formulir, lanjutkan dengan menampilkan halaman edit
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/editPeserta', $data);
        $this->load->view('template/footer');
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
        $id_user = $this->input->post('id_user'); // ID user yang akan diupdate

        // Mendefinisikan jenis-jenis dokumen yang akan diupdate
        $document_types = array('surat', 'ijazah', 'ktp', 'sk', 'foto', 'bukti', 'cv', 'surat_sehat');

        // Mendapatkan data dokumen lama (dokumen_old)
        $dokumen_old = $this->db->get_where('dokumen_pendaftaran', array('id_user' => $id_user))->row_array();

        foreach ($document_types as $type) {
            if (!empty($_FILES[$type]['name'])) {
                // File selected, proceed with upload
                if ($this->upload->do_upload($type)) {
                    $data = $this->upload->data();
                    $data_to_update[$type] = $data['file_name'];
                } else {
                    // Handle upload error
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $error . '</div>');
                    redirect('dashboard');
                }
            } else {
                // No file selected, use the old document if available
                if (!isset($data_to_update[$type]) && isset($dokumen_old[$type])) {
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
            redirect('dashboard');
        } else {
            // Menampilkan pesan kesalahan jika ID user atau dokumen kosong
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Mengupdate Dokumen</div>');
            redirect('dashboard');
        }
    }



    public function buatLink()
    {
        $generatedToken = substr(bin2hex(random_bytes(4)), 0, 6);

        $data = [
            'id_user' => $this->session->userdata('id'),
            'form' => $this->input->post('form'),
            'kelas' => $this->input->post('kelas'),
            'program' => $this->input->post('program'),
            'tanggal_pembuatan' => date("Y-m-d H:i:s"),
            'tanggal_pelaksanaan' => $this->input->post('tanggal'),
            'tanggal_selesai' => $this->input->post('tanggal_selesai'),
            'training' => $this->input->post('training'),
            'link_grup' => $this->input->post('link'),
            'token' => $generatedToken,
            'status' => 'Aktif',
            'link' => base_url() . 'pendaftaran/cekForm/' . $this->session->userdata('id') . '/' . $generatedToken , 
            'tempat_pelaksanaan' => $this->input->post('tempat_pelaksanaan'),
        ];

        $this->db->insert('form', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Link Berhasil Di Tambahkan</div>');
        redirect('dashboard');
    }

    public function simpanJenisAlat()
    {
        // Di DB pada tabel jenis_alat belum AUTO_INCREMENT
        $data = [
            'jenis_alat' => $this->input->post('jenis_alat')
        ];

        $this->db->insert('jenis_alat', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jenis Alat Berhasil Di Tambahkan</div>');
        redirect('dashboard/jenis_alat');
    }

    public function pendaftaran($id)
    {
        $data['tittle'] = 'judul';
        $data['form'] = $this->database->getDataPeserta($id);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/detail', $data);
        $this->load->view('template/footer');
    }

    public function nonaktif($status, $id)
    {
        $this->db->set('status', $status);
        $this->db->where('id', $id);
        $this->db->update('form');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Link Berhasil di Update</div>');
        redirect('dashboard');
    }

    public function success()
    {
        $this->load->view('form/success');
    }

    public function download_excel($id)
    {

        $spreadsheet = new Spreadsheet();

        // Add worksheet
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Daftar Peserta');



        // Set headers
        $sheet->setCellValue('A1', 'KTP');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Tempat');
        $sheet->setCellValue('D1', 'Tanggal Lahir');
        $sheet->setCellValue('E1', 'Instansi');
        $sheet->setCellValue('F1', 'Alamat Perusahaan');


        $data = $this->database->getData($id);

        // Loop through data and add to spreadsheet
        $row = 2;
        foreach ($data as $item) {
            // url
            $sheet->setCellValue('A' . $row, $item['nik']);
            $sheet->setCellValue('B' . $row, $item['nama']);
            $sheet->setCellValue('C' . $row, $item['ttl']);
            $sheet->setCellValue('D' . $row, $item['tgl_lahir']);
            $sheet->setCellValue('E' . $row, $item['instansi']);
            $sheet->setCellValue('F' . $row, $item['alamat_perusahaan']);

	    $row++;
	    die('Method is working');

        }

        // Create file name
        $filename = 'Daftar_Peserta.xlsx';

        // Set headers for download
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Create writer object and save spreadsheet as file
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

        exit();
    }

    public function update()
    {
        $id = $this->input->post('id');
        foreach ($id as $i => $val) {
            $this->db->set('form', $this->input->post('form')[$val]);
            $this->db->set('link_grup', $this->input->post('grup')[$val]);
            $this->db->where('id', $val);
            $this->db->update('form');
        }
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">Data berhasil diperbarui.</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }




    public function importPeserta()
    {
        if (!empty($_FILES['excel_file']['name'])) {
            // Konfigurasi upload file
            $upload_path = './pendaftaran/images/dokumen/';
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'xlsx'; // Hanya izinkan file Excel
            $config['max_size'] = 2048; // Ukuran maksimum berkas (2MB)
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            // Memeriksa apakah unggahan file berhasil
            if ($this->upload->do_upload('excel_file')) {
                $data = $this->upload->data();
                $file_path = $config['upload_path'] . $data['file_name'];

                // Memuat file Excel menggunakan PHPSpreadsheet
                $spreadsheet = IOFactory::load($file_path);
                $worksheet = $spreadsheet->getActiveSheet();
                $data = $worksheet->toArray(null, true, true, true);

                // Loop melalui baris-baris spreadsheet mulai dari baris kedua
                foreach (array_slice($data, 1) as $row) { // Menggunakan array_slice untuk melewati baris judul
                    // Data untuk tabel 'peserta'
                    $data_peserta = array(
                        'id_form' => $this->uri->segment('3'),
                        'id_program' => $this->uri->segment('4'),
                        'nama' => $row['B'],
                        'nik' => $row['A'],
                        'ttl' => $row['C'],
                        'tgl_lahir' => $row['D'],
                        'golongan_darah' => $row['E'],
                        'pendidikan' => $row['F'],
                        'sekolah' => $row['G'],
                        'no_ijazah' => $row['H'],
                        'tgl_ijazah' => $row['I'],
                        'alamat' => $row['J'],
                        'email' => $row['L'],
                        'no_wa' => $row['K'],
                        'instansi' => $row['M'],
                        'sektor' => $row['N'],
                        'jabatan' => $row['O'],
                        'alamat_perusahaan' => $row['P'],
                        'tlp_kantor' => $row['Q'],
                    );

                    // Simpan data ke dalam tabel 'peserta' dan ambil ID yang baru saja di-insert
                    $this->db->insert('pendaftaran', $data_peserta);
                    $peserta_id = $this->db->insert_id();

                    // Data untuk tabel 'dokumen'
                    $data_dokumen = array(
                        'id_user' => $peserta_id
                    );

                    // Simpan data ke dalam tabel 'dokumen'
                    $this->db->insert('dokumen_pendaftaran', $data_dokumen);
                }

                // Hapus file Excel yang diunggah setelah selesai mengimpor
                unlink($file_path);

                // Redirect atau tampilkan pesan sukses
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                // File gagal diunggah, tampilkan pesan kesalahan
                $upload_error = $this->upload->display_errors();
                echo "Error: " . $upload_error;
            }
        } else {
            // File Excel tidak diunggah, tampilkan pesan kesalahan
            echo "Error: File Excel tidak diunggah.";
        }
    }

    public function updateProfil()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $tlp = $this->input->post('tlp');
        $password = $this->input->post('password');

        // Ambil password sebelumnya dari database
        $passwordSebelumnya = $this->db->get_where('user', array('id' => $id))->row()->password;

        // Jika password kosong, gunakan password sebelumnya
        if (empty($password)) {
            $password = $passwordSebelumnya;
        } else {
            // Jika password tidak kosong, hash password baru
            $password = md5($password);
        }

        // Update data dalam database
        $data = array(
            'nama' => $nama,
            'email' => $email,
            'phone_number' => $tlp,
            'password' => $password
        );

        $this->db->where('id', $id); // Ubah sesuai dengan field ID user Anda
        $this->db->update('user', $data);
        redirect('dashboard');
    }

    public function hapusDokumen($dokumen, $id, $file)
    {
        $file_path = FCPATH . 'pendaftaran/images/dokumen/' . $dokumen;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        $this->db->where('id_user', $id);
        $this->db->update('dokumen_pendaftaran', [$file => null]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function pesan()
    {
        $ids = $this->input->post('ids');
        $pesan = $this->input->post('pesan');

        // Inisialisasi nomor WhatsApp yang akan digunakan sebagai penerima
        $receiverNumber = '';

        // Melakukan loop melalui setiap ID dan mengambil data dari database
        foreach ($ids as $id) {
            $user = $this->db->get_where('pendaftaran', ['id' => $id])->row_array();

            // Jika data ditemukan, ambil nomor WhatsApp pertama dan keluar dari loop
            if ($user) {
                $receiverNumber = $user['no_wa'];
                break;
            }
        }

        // Mengirim pesan WhatsApp ke nomor WhatsApp yang telah ditemukan
        $this->sendWhatsapp($receiverNumber, $pesan);


        echo json_encode('Pesan Berhasil Dikirim');
    }

    public function sendWhatsapp($nomor, $pesan)
    {
        $curl = curl_init();
        $token = "1SvDVBjud0FI7MiQ4rarSlCdxHGMFmY2UsAZwsBiNYiXBCw3TxhoiHV2f252YEdo";

        $data = [
            'phone' => $nomor,
            'message' => $pesan
        ];

        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Authorization: $token"]);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL,  "https://jogja.wablas.com/api/send-message");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_exec($curl);
        curl_close($curl);
    }

    public function getKelas($id)
    {
        $this->database->getKelas($id);
    }
    public function getBidang($id)
    {
        $this->database->getBidang($id);
    }
    public function jenisKelompok($id, $kelas)
    {
        $this->database->getKelompok($id, $kelas);
    }

    public function jenisAlat($id)
    {
        $this->database->getAlat($id);
    }

    public function kirimSertifikat()
    {
        $ids = $this->input->post('id'); // Mengubah $ids menjadi array dengan data ID user
        $nomor = $this->input->post('no_sertifikat');


        // $numbers = [];
        // $increment = 0; // Inisialisasi inkrement dengan 1

        // foreach ($ids as $id) {
        //     $numbers[] = (intval($nomor) + $increment) . substr($nomor, strlen(intval($nomor)));
        //     $increment++; // Tambahkan 1 ke inkrement untuk nomor berikutnya
        // }

        // foreach ($numbers as $n) {
        //     $this->sertifikat($_POST, $n);
        // }
        $user = $this->db->get_where('pendaftaran', ['id' => $ids[0]])->row_array();

        echo json_encode($user);
    }


    public function centerText($font, $text, $fontSize, $image, $y)
    {
        $box = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $box[2] - $box[0];
        $imageWidth = imagesx($image);
        $x = ($imageWidth - $textWidth) / 2;
        return $x;
    }

    public function wrapText($text, $maxWidth)
    {
        if (strlen($text) > $maxWidth) {
            $text = wordwrap($text, $maxWidth, "\n", true);
        }
        return $text;
    }

    public function sertifikat($id)
    {

        $user = $this->db->get_where('sertifikat', ['id_pendaftaran' => $id])->row_array();
        if (!$user) {
            echo "Tidak di Temukan";
        }

        $font = FCPATH . 'assets/sertifikat/Copperplate Gothic Bold Regular.ttf';
        $reguler =  FCPATH . 'assets/sertifikat/italic.ttf';
        $judul = FCPATH . 'assets/sertifikat/CopperplateGothicBold.ttf';

        $image = imagecreatefromjpeg(FCPATH . 'assets/sertifikat/sertifikat.jpg');
        $color = imagecolorallocate($image, 100, 100, 100);
        $redColor = imagecolorallocate($image, 103, 10, 3);
        $blue =  imagecolorallocate($image, 0, 32, 96);

        $nomor = $user['no_sertifikat'];
        $name = $user['nama'];
        $perusahaan = 'PT DELTA INDONESIA PRANENGAR';
        $pelatihan = $user['training'];
        $pelatihan_ing = $user['training_inggris'];
        $tanggal_pelaksanaan = $user['pelaksanaan'];
        $tanggal_pelaksanaan_ing = $user['pelaksanaan_inggris'];
        $tanggal_sertifikat = $user['terbit'];
        $tanggal_ing_ser = $user['terbit_inggris'];


        $name_font_size = 50;
        $pelatihan_font_size = 40;
        $pelatihan_ing_font_size = 20;
        $tanggal_pelaksanaan_size = 35;

        $nameX = $this->centerText($font, $name, $name_font_size, $image, 940);
        $pelatihan = $this->wrapText($pelatihan, 200);
        $pelatihanX = $this->centerText($font, $pelatihan, $pelatihan_font_size, $image, 1250);
        $pelatihan_ing = $this->wrapText($pelatihan_ing, 200);
        $pelatihanIngX = $this->centerText($font, $pelatihan_ing, $pelatihan_ing_font_size, $image, 1250);
        $perusahaanX = $this->centerText($font, $perusahaan, $name_font_size, $image, 1030);
        $pelaksanaanX = $this->centerText($font, $tanggal_pelaksanaan, $tanggal_pelaksanaan_size, $image, 1500);
        $pelaksanaan_inX = $this->centerText($font, $tanggal_pelaksanaan_ing, $pelatihan_ing_font_size, $image, 1550);
        $tangglx = $this->centerText($font, $tanggal_sertifikat, $tanggal_pelaksanaan_size, $image, 1650);
        $tglx = $this->centerText($font, $tanggal_sertifikat, $pelatihan_ing_font_size, $image, 1700);

        imagettftext($image, 30, 0, 2700, 250, $blue, $font, $nomor);
        imagettftext($image, $name_font_size, 0, $nameX, 940, $redColor, $judul, $name);
        imagettftext($image, $name_font_size, 0, $perusahaanX, 1030, $redColor, $font, $perusahaan);
        imagettftext($image, $pelatihan_font_size, 0, $pelatihanX, 1250, $blue, $font, $pelatihan);
        imagettftext($image, $pelatihan_ing_font_size, 0, $pelatihanIngX, 1300, $blue, $reguler, $pelatihan_ing);
        imagettftext($image, $tanggal_pelaksanaan_size, 0, $pelaksanaanX, 1500, $blue, $font, $tanggal_pelaksanaan);
        imagettftext($image, $pelatihan_ing_font_size, 0, $pelaksanaan_inX, 1550, $blue, $reguler, $tanggal_pelaksanaan_ing);
        imagettftext($image, $tanggal_pelaksanaan_size, 0, $tangglx, 1650, $blue, $font, $tanggal_sertifikat);
        imagettftext($image, $pelatihan_ing_font_size, 0, $tglx, 1700, $blue, $reguler, $tanggal_ing_ser);

        header('Content-Type: image/jpeg');
        imagejpeg($image);
        imagedestroy($image);
    }

    // edit peserta
    public function edit_peserta($id)
    {
        $this->form_validation->set_rules('nik', 'nik', 'required');
        if ($this->form_validation->run() == FALSE) {

            $data['tittle'] = 'Edit Data Peserta';
            $data['p'] = $this->db->get_where('pendaftaran', ['id' => $id])->row_array();

            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('dashboard/edit_peserta', $data);
            $this->load->view('template/footer');
        } else {
            $data = array();
            $fields = array('nik', 'nama', 'ttl', 'tgl_lahir', 'golongan_darah', 'pendidikan', 'sekolah', 'no_ijazah', 'alamat', 'email', 'no_wa');
            foreach ($fields as $field) {
                $data[$field] = $this->input->post($field);
            }

            $this->db->where('id', $id);
            $this->db->update('pendaftaran', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Link Berhasil Di Update</div>');
            redirect('dashboard');
        }
    }

    public function zip($id)
    {
        $p = $this->db->get_where('dokumen_pendaftaran', ['id_user' => $id])->row_array();

        // Muat library Zip
        $this->load->library('zip');

        // Tambahkan setiap file ke dalam ZIP
        if (!empty($p['surat'])) {
            $this->zip->add_data('surat_' . $p['surat'], file_get_contents('pendaftaran/images/dokumen/' . $p['surat']));
        }
        if (!empty($p['ijazah'])) {
            $this->zip->add_data('ijazah_' . $p['ijazah'], file_get_contents('pendaftaran/images/dokumen/' . $p['ijazah']));
        }
        if (!empty($p['ktp'])) {
            $this->zip->add_data('ktp_' . $p['ktp'], file_get_contents('pendaftaran/images/dokumen/' . $p['ktp']));
        }
        if (!empty($p['sk'])) {
            $this->zip->add_data('sk_' . $p['sk'], file_get_contents('pendaftaran/images/dokumen/' . $p['sk']));
        }
        if (!empty($p['foto'])) {
            $this->zip->add_data('foto_' . $p['foto'], file_get_contents('pendaftaran/images/dokumen/' . $p['foto']));
        }
        if (!empty($p['cv'])) {
            $this->zip->add_data('cv_' . $p['cv'], file_get_contents('pendaftaran/images/dokumen/' . $p['cv']));
        }
        if (!empty($p['surat_sehat'])) {
            $this->zip->add_data('surat_sehat_' . $p['surat_sehat'], file_get_contents('pendaftaran/images/dokumen/' . $p['surat_sehat']));
        }

        // Tambahkan file lainnya

        // Set header untuk mengarahkan pengguna untuk mengunduh file ZIP
        $this->zip->download('files.zip');
    }

    public function hapusI()
    {
        $ids = [154];

        foreach ($ids as $id) {
            // Mengambil nama file dari tabel dokumen_pendaftaran
            $query = $this->db->get_where('dokumen_pendaftaran', array('id_user' => $id));

            // Memastikan ada hasil dari query
            if ($query->num_rows() > 0) {
                $results = $query->result();

                foreach ($results as $result) {

                    // Jenis file yang terkait dengan pendaftaran
                    $jenis_file = array('surat', 'ijazah', 'ktp', 'sk', 'foto', 'bukti', 'surat_sehat');

                    // Menghapus file dari folder
                    foreach ($jenis_file as $jenis) {
                        $file_path = FCPATH . 'pendaftaran/images/dokumen/' . $result->$jenis;

                        if (file_exists($file_path)) {
                            unlink($file_path);
                        }
                    }
                }
            } else {
                // Handle jika tidak ada data yang ditemukan
                echo "Data tidak ditemukan!";
            }
        }

        echo 'sukses';
    }

    public function cetak()
    {
        $selected_ids = $this->input->post('id');
        $data = [
            'id_peserta' => $selected_ids
        ];

        $this->session->set_userdata($data);
    }

    public function callBack()
    {
        $selected_ids = $this->session->userdata('id_peserta');

        $data['tittle'] = 'Kirim Sertifikat';
        $this->db->where_in('id', $selected_ids);
        $data['sertifikat'] = $this->db->get('pendaftaran')->result_array();
        $data['idn'] = $this->db->get('sertifikat_indonesia')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/sertifikat', $data);
        $this->load->view('template/footer');
    }

    public function get_ing()
    {
        $idnValue = $this->input->post('idn');
        // Ambil data untuk dropdown kedua berdasarkan nilai yang dipilih di dropdown pertama
        $ingOptions = $this->db->get_where('sertifikat_ing', ['id_ser' => $idnValue])->result_array();
        $optionsHtml = '<option selected>Pilih Training</option>';
        foreach ($ingOptions as $ingOption) {
            $optionsHtml .= '<option value="' . $ingOption['sertifikat_ing'] . '">' . $ingOption['sertifikat_ing'] . '</option>';
        }
        echo $optionsHtml;
    }

    public function insertSertifikat()
    {
        $this->database->insertData($_POST);

        redirect('dashboard');
    }

    public function ulasan()
    {
        $selected_ids = $this->input->post('id');


        foreach ($selected_ids as $id => $val) {
            $user = $this->db->get_where('pendaftaran', ['id' => $val])->row_array();

            $this->send_sertifikat($id, $user['no_wa'], $user['nama']);
        }
        echo 'Sukses';
    }

    private function send_sertifikat($id, $nomor, $nama)
    {
        $curl = curl_init();
        $token = "1SvDVBjud0FI7MiQ4rarSlCdxHGMFmY2UsAZwsBiNYiXBCw3TxhoiHV2f252YEdo";

        $message = "*Dear $nama*,\n";
        $message .= "Berikut Link Sertifikat yang anda bisa unduh\n\n";
        $message .= base_url('sertifikat/cetak/' . $id) . "\n\n";





        $data = [
            'phone' => $nomor,
            'message' => $message
        ];

        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Authorization: $token"]);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL,  "https://jogja.wablas.com/api/send-message");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_exec($curl);
        curl_close($curl);
    }

    public function daftar_sertifikat()
    {
        $this->load->model('database');
        $data['tittle'] = 'Daftar Sertifikat | Delta Indonesia';
        $this->db->select('sertifikat_ing.id as id_ing,sertifikat_indonesia.sertifikat_indonesia, sertifikat_indonesia.id, sertifikat_ing.sertifikat_ing');
        $this->db->from('sertifikat_indonesia');
        $this->db->join('sertifikat_ing', 'sertifikat_ing.id_ser = sertifikat_indonesia.id');
        $data['sertifikat'] = $this->db->get()->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/sertifikatt', $data);
        $this->load->view('template/footer');
    }

    public function tambah_ser()
    {

        $data = [
            'sertifikat_indonesia' => $this->input->post('ser_id')
        ];

        $this->db->insert('sertifikat_indonesia', $data);

        $id = $this->db->insert_id();

        $data_serti = [
            'sertifikat_ing' => $this->input->post('ser_ing'),
            'id_ser' => $id
        ];

        $this->db->insert('sertifikat_ing', $data_serti);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Link Berhasil di Tambakan</div>');
        redirect('dashboard/daftar_sertifikat');
    }

    public function pembinaan()
    {
        $data['tittle'] = "Halaman Pembinaan";
        $query = "SELECT
    kkp.id AS id_tb_kelompok_pembinaan,
    b.bidang,
    jp.jenis_personil,
    kp.kelompok_pembinaan
    FROM
    tb_kelompok_pembinaan kkp
    INNER JOIN bidang b ON kkp.id_bidang = b.id
    INNER JOIN jenis_personil jp ON kkp.id_jenis_personil = jp.id
    INNER JOIN kelompok_pembinaan kp ON kkp.id_kelompok_pembinaan = kp.id";

        $data['bidang'] = $this->db->query($query)->result_array();
        $data['bidangg'] = $this->db->get('bidang')->result_array();
        $data['personil'] = $this->db->get('jenis_personil')->result_array();
        $data['pembinaan'] = $this->db->get('kelompok_pembinaan')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/pembinaan', $data);
        $this->load->view('template/footer');
    }

    public function tambah_kelompok()
    {
        $data =
            [
                'id_bidang' => $this->input->post('bidang'),
                'id_jenis_personil' => $this->input->post('personil'),
                'id_kelompok_pembinaan' => $this->input->post('pembinaan')
            ];

        $this->db->insert('tb_kelompok_pembinaan', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil di Tambakan</div>');
        redirect('dashboard/pembinaan');
    }

    public function kelas_pendidikan_terakhir()
    {
        $data['tittle'] = "Halaman Pendidikan Terakhir";
        $this->db->select('pendidikan_terakhir.id, kelas.kelas, pendidikan.pendidikan');
        $this->db->from('pendidikan_terakhir');
        $this->db->join('kelas', 'pendidikan_terakhir.id_kelas = kelas.id');
        $this->db->join('pendidikan', 'pendidikan_terakhir.id_pendidikan = pendidikan.id');
        $this->db->order_by('pendidikan_terakhir.id', 'DESC');
        $data['pendidikan_terakhir'] = $this->db->get()->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/pendidikan_terakhir', $data);
        $this->load->view('template/footer');
    }

    public function tambah_pendidikan_terakhir()
    {
        $data['tittle']          = "Tambah Pendidikan Terakhir";
        $data['semuakelas']      = $this->database->semuaDataKelas();
        $data['semuapendidikan'] = $this->database->semuaDataPendidikan();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/pendidikan_terakhir_tambah', $data);
        $this->load->view('template/footer');
    }

    public function simpan_pendidikan_terakhir()
    {
        $data = [
            'id_pendidikan' => $this->input->post('nama_pendidikan'),
            'id_kelas' => $this->input->post('nama_kelas')
        ];
        $this->db->insert('pendidikan_terakhir', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kelas Pendidikan Terakhir Berhasil di Tambahkan</div>');
        redirect('dashboard/kelas_pendidikan_terakhir');
    }

    public function edit_pendidikan_terakhir($id)
    {
        $data['tittle']             = "Edit Pendidikan Terakhir";
        $data['semuakelas']         = $this->database->semuaDataKelas();
        $data['semuapendidikan']    = $this->database->semuaDataPendidikan();
        $data['kelas_pendidikan']   = $this->database->editKelasPendidikanTerakhir($id);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/pendidikan_terakhir_edit', $data);
        $this->load->view('template/footer');
    }

    public function update_pendidikan_terakhir($id)
    {
        $data = [
            'id_pendidikan' => $this->input->post('nama_pendidikan'),
            'id_kelas' => $this->input->post('nama_kelas')
        ];
        $this->db->where('id', $id);
        $this->db->update('pendidikan_terakhir', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kelas Pendidikan Terakhir Berhasil di Update</div>');
        redirect('dashboard/kelas_pendidikan_terakhir');
    }

    public function delete_kelas_pendidikan_terakhir($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pendidikan_terakhir');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kelas Pendidikan Terakhir Berhasil di Hapus</div>');
        redirect('dashboard/kelas_pendidikan_terakhir');
    }

    public function delete_bulk_kelas_pendidikan_terakhir()
    {
        $ids = $this->input->post('id');
        if ($ids) {
            foreach ($ids as $id) {
                $this->db->delete('pendidikan_terakhir', ['id' => $id]);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Daftar Kelas Pendidikan Terakhir Berhasil di Hapus</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Tidak ada Daftar Kelas Pendidikan Terakhir yang dipilih untuk dihapus</div>');
        }
        redirect('dashboard/kelas_pendidikan_terakhir');
    }

    public function kelas_training()
    {
        $data['tittle'] = "Halaman Kelas Training";
        $this->db->select('kelas_training.id,kelas.id as kelas_id, kelas.kelas, training.id as training_id, training.training, kelas_training.tanggal_awal, kelas_training.tanggal_akhir, kelas_training.jenis');
        $this->db->from('kelas');
        $this->db->join('kelas_training', 'kelas.id = kelas_training.kelas_id');
        $this->db->join('training', 'kelas_training.training_id = training.id');
        $this->db->order_by('kelas_training.id', 'DESC');
        $data['kelas_training'] = $this->db->get()->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/kelas_training', $data);
        $this->load->view('template/footer');
    }

    public function tambah_kelas_training()
    {
        $data['tittle']     = "Tambah Kelas Training";
        $data['trainings']  = $this->database->semuaDataTraining();
        $data['semuakelas'] = $this->database->semuaDataKelas();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/kelas_training_tambah', $data);
        $this->load->view('template/footer');
    }

    public function simpan_kelas_training()
    {
        $data = [
            'training_id'   => $this->input->post('nama_training'),
            'kelas_id'      => $this->input->post('nama_kelas'),
            'tanggal_awal'  => $this->input->post('tanggal_awal'),
            'tanggal_akhir' => $this->input->post('tanggal_akhir'),
            'jenis'         => $this->input->post('jenis_training')
        ];
        $this->db->insert('kelas_training', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil di Tambahkan</div>');
        redirect('dashboard/kelas_training');
    }

    public function delete_kelas_training($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('kelas_training');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil di Hapus</div>');
        redirect('dashboard/kelas_training');
    }

    public function edit_kelas_training($id)
    {
        $data['tittle']         = "Edit Kelas Training";
        $data['semuatraining']  = $this->database->semuaDataTraining();
        $data['semuakelas']     = $this->database->semuaDataKelas();
        $data['editTraining']   = $this->database->dataKelasTraining($id);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/kelas_training_edit', $data);
        $this->load->view('template/footer');
    }

    public function update_kelas_training($id)
    {
        $data = [
            'training_id'   => $this->input->post('nama_training'),
            'kelas_id'      => $this->input->post('nama_kelas'),
            'tanggal_awal'  => $this->input->post('tanggal_awal'),
            'tanggal_akhir' => $this->input->post('tanggal_akhir'),
            'jenis'         => $this->input->post('jenis_training')
        ];
        $this->db->where('id', $id);
        $this->db->update('kelas_training', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil di Update</div>');
        redirect('dashboard/kelas_training');
    }

    public function hapus_bulk_kelas_training()
    {
        $ids = $this->input->post('id');
        if ($ids) {
            foreach ($ids as $id) {
                $this->db->delete('kelas_training', ['id' => $id]);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kelas Training Berhasil di Hapus</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Tidak ada Kelas Training yang dipilih untuk dihapus</div>');
        }
        redirect('dashboard/kelas_training');
    }

    public function kelompok_pembinaan()
    {
        $data['tittle'] = "Halaman Kelompok Pembinaan";

        $this->db->select('tb_kelompok_pembinaan.id, tb_kelompok_pembinaan.id_bidang, tb_kelompok_pembinaan.id_kelompok_pembinaan, tb_kelompok_pembinaan.id_jenis_personil, kelompok_pembinaan.kelompok_pembinaan, jenis_personil.jenis_personil, bidang.bidang');
        $this->db->from('tb_kelompok_pembinaan');
        $this->db->join('jenis_personil', 'tb_kelompok_pembinaan.id_jenis_personil = jenis_personil.id', 'left');
        $this->db->join('bidang', 'tb_kelompok_pembinaan.id_bidang = bidang.id', 'left');
        $this->db->join('kelompok_pembinaan', 'tb_kelompok_pembinaan.id_kelompok_pembinaan = kelompok_pembinaan.id', 'left');
        $this->db->order_by('tb_kelompok_pembinaan.id', 'DESC');
        $data['kelompok_pembinaan'] = $this->db->get()->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/kelompok_pembinaan', $data);
        $this->load->view('template/footer');
    }

    public function kelompok_pembinaan_tambah()
    {
        $data['tittle']                 = "Halaman Tambah Data Kelompok Pembinaan";
        $data['kelompok_pembinaan']     = $this->database->semuaKelompokPembinaan();
        $data['bidangs']                = $this->database->semuaBidang();
        $data['jenis_personil']         = $this->database->semuaJenisPersonil();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/kelompok_pembinaan_tambah', $data);
        $this->load->view('template/footer');
    }

    public function edit_kelompok_pembinaan($id)
    {
        $data['tittle']                 = "Halaman Edit Data Kelompok Pembinaan";
        $data['kelompok_pembinaan']     = $this->database->semuaKelompokPembinaan();
        $data['bidangs']                = $this->database->semuaBidang();
        $data['jenis_personil']         = $this->database->semuaJenisPersonil();
        $data['editKelompokPembinaan']  = $this->database->dataKelompokPembinaan($id);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/kelompok_pembinaan_edit', $data);
        $this->load->view('template/footer');
    }

    public function update_kelompok_pembinaan($id)
    {
        $data = [
            'id_kelompok_pembinaan' => $this->input->post('kelompok_pembinaan'),
            'id_bidang'             => $this->input->post('nama_bidang'),
            'id_jenis_personil'     => $this->input->post('jenis_personil')
        ];
        $this->db->where('id', $id);
        $this->db->update('tb_kelompok_pembinaan', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil di Edit</div>');
        redirect('dashboard/kelompok_pembinaan');
    }

    public function delete_kelompok_pembinan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_kelompok_pembinaan');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil di Hapus</div>');
        redirect('dashboard/kelompok_pembinaan');
    }

    public function simpan_kelompok_pembinaan()
    {
        $data = [
            'id_bidang'             => $this->input->post('nama_bidang'),
            'id_jenis_personil'     => $this->input->post('jenis_personil'),
            'id_kelompok_pembinaan' => $this->input->post('kelompok_pembinaan')
        ];
        $this->db->insert('tb_kelompok_pembinaan', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil di Tambahkan</div>');
        redirect('dashboard/kelompok_pembinaan');
    }

    public function list_admin()
    {
        $data['tittle'] = "Halaman List Data Admin";
        $data['admins'] = $this->db->get('user')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/list_admin', $data);
        $this->load->view('template/footer');
    }

    public function admin_simpan()
    {
        $data = [
            'nama'          => $this->input->post('name_admin'),
            'email'         => $this->input->post('email_admin'),
            'phone_number'  => $this->input->post('mobilephone_admin'),
            'password'      => md5($this->input->post('password_admin')),
            'level'         => 2
        ];
        $this->db->insert('user', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil di Tambahkan</div>');
        redirect('dashboard/list_admin');
    }

    public function edit_admin($id)
    {
        $data['tittle'] = "Halaman Edit Data Admin";
        $data['admin'] = $this->database->dataAdmin($id);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/edit_admin', $data);
        $this->load->view('template/footer');
    }

    public function update_admin($id)
    {
        if ($this->input->post('password_admin') == null) {
            $data = [
                'nama'          => $this->input->post('admin_name'),
                'email'         => $this->input->post('email_admin'),
                'phone_number'  => $this->input->post('mobilephone_admin'),
            ];
        } else {
            $data = [
                'nama'          => $this->input->post('admin_name'),
                'email'         => $this->input->post('email_admin'),
                'phone_number'  => $this->input->post('mobilephone_admin'),
                'password'      => md5($this->input->post('password_admin')),
            ];
        }
        $this->db->where('id', $id);
        $this->db->update('user', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Admin Berhasil di Update</div>');
        redirect('dashboard/list_admin');
    }

    public function delete_admin($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Admin Berhasil di Hapus</div>');
        redirect('dashboard/list_admin');
    }

    public function delete_bulk_data_admin()
    {
        $ids = $this->input->post('id');
        if ($ids) {
            foreach ($ids as $id) {
                $this->db->delete('user', ['id' => $id]);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Admin Berhasil di Hapus</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Tidak ada Data Admin yang dipilih untuk dihapus</div>');
        }
        redirect('dashboard/list_admin');
    }

    public function alat_kelompok_pembinaan()
    {
        $data['tittle'] = "Halaman List Alat Kelompok Pembina";
        $this->db->select('tb_jenis_alat.id,jenis_alat.jenis_alat, kelompok_pembinaan.kelompok_pembinaan');
        $this->db->from('tb_jenis_alat');
        $this->db->join('jenis_alat', 'jenis_alat.id = tb_jenis_alat.Jenis_alat');
        $this->db->join('kelompok_pembinaan', 'kelompok_pembinaan.id = tb_jenis_alat.id_kelompok_pembinaan');
        $this->db->order_by('tb_jenis_alat.id', 'DESC');
        $data['alat_kelompok'] = $this->db->get()->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/alat_kelompok_pembinaan', $data);
        $this->load->view('template/footer');
    }

    public function tambah_alat_kelompok_pembinaan()
    {
        $data['tittle'] = "Halaman Tambah Alat Kelompok Pembina";

        $data['kelompok_pembinaan']     = $this->database->semuaKelompokPembinaan();
        $data['jenis_alat']             = $this->database->semuaJenisAlat();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/alat_kelompok_pembinaan_tambah', $data);
        $this->load->view('template/footer');
    }

    public function simpan_alat_kelompok_pembinaan()
    {
        $data = [
            'jenis_alat'            => $this->input->post('jenis_alat'),
            'id_kelompok_pembinaan' => $this->input->post('kelompok_pembinaan'),
        ];

        $this->db->insert('tb_jenis_alat', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Alat Kelompok Pembinaan Berhasil di Tambahkan</div>');
        redirect('dashboard/alat_kelompok_pembinaan');
    }

    public function alat_kelompok_pembinaan_edit($id)
    {
        $data['tittle'] = "Halaman Edit Alat Kelompok Pembina";

        $data['alat_kelompok']      = $this->database->editAlatKelompokPembinaan($id);
        $data['kelompok_pembinaan'] = $this->database->semuaKelompokPembinaan();
        $data['jenis_alat']         = $this->database->semuaJenisAlat();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/alat_kelompok_pembinaan_edit', $data);
        $this->load->view('template/footer');
    }

    public function update_alat_kelompok_pembinaan($id)
    {
        $data = [
            'jenis_alat'            => $this->input->post('jenis_alat'),
            'id_kelompok_pembinaan' => $this->input->post('kelompok_pembinaan'),
        ];

        $this->db->where('id', $id);
        $this->db->update('tb_jenis_alat', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Alat Kelompok Pembinaan Berhasil di Edit</div>');
        redirect('dashboard/alat_kelompok_pembinaan');
    }

    public function delete_kelompok_alat_pembinan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_jenis_alat');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Alat Kelompok Pembinaan Berhasil di Hapus</div>');
        redirect('dashboard/alat_kelompok_pembinaan');
    }

    public function hapus_bulk_alat_kelompok_pembinaan()
    {
        $ids = $this->input->post('id');
        if ($ids) {
            foreach ($ids as $id) {
                $this->db->delete('tb_jenis_alat', ['id' => $id]);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Alat Kelompok Pembinaan Berhasil di Hapus</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Tidak ada Data Alat Kelompok Pembinaan yang dipilih untuk dihapus</div>');
        }
        redirect('dashboard/alat_kelompok_pembinaan');
    }

    public function bidang_personil()
    {
        $data['tittle'] = "Halaman List Bidang Personil";
        $this->db->select('tb_personil.id, jenis_personil.jenis_personil, bidang.bidang');
        $this->db->from('tb_personil');
        $this->db->join('jenis_personil', 'tb_personil.id_jenis_personil = jenis_personil.id');
        $this->db->join('bidang', 'tb_personil.id_bidang = bidang.id');
        $this->db->order_by('tb_personil.id', 'DESC');
        $data['bidang_personil'] = $this->db->get()->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/bidang_personil', $data);
        $this->load->view('template/footer');
    }

    public function tambah_bidang_personil()
    {
        $data['tittle'] = "Halaman Tambah Bidang Personil";

        $data['bidangs']                = $this->database->semuaBidang();
        $data['jenis_personil']         = $this->database->semuaJenisPersonil();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/bidang_personil_tambah', $data);
        $this->load->view('template/footer');
    }

    public function simpan_bidang_personil()
    {
        $data = [
            'id_jenis_personil' => $this->input->post('jenis_personil'),
            'id_bidang'         => $this->input->post('bidang_personil'),
        ];
        $this->db->insert('tb_personil', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Bidang Personil Berhasil di Tambah</div>');
        redirect('dashboard/bidang_personil');
    }

    public function edit_bidang_personil($id)
    {
        $data['tittle']             = 'Edit Bidang Personil | Delta Indonesia';
        $data['bidangs']            = $this->database->semuaBidang();
        $data['jenis_personil']     = $this->database->semuaJenisPersonil();
        $data['bidang_personil']    = $this->database->editBidangPersonil($id);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/bidang_personil_edit', $data);
        $this->load->view('template/footer');
    }

    public function update_bidang_jenis_personil($id)
    {
        $data = [
            'id_jenis_personil' => $this->input->post('jenis_personil'),
            'id_bidang'         => $this->input->post('nama_bidang'),
        ];
        $this->db->where('id', $id);
        $this->db->update('tb_personil', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Bidang Personil Berhasil di Edit</div>');
        redirect('dashboard/bidang_personil');
    }

    public function delete_bidang_personil($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_personil');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Bidang Personil Berhasil di Hapus</div>');
        redirect('dashboard/bidang_personil');
    }

    public function hapus_bulk_bidang_personil()
    {
        $ids = $this->input->post('id');
        if ($ids) {
            foreach ($ids as $id) {
                $this->db->delete('tb_personil', ['id' => $id]);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Bidang Personil Berhasil di Hapus</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Tidak ada Data Bidang Personil yang dipilih untuk dihapus</div>');
        }
        redirect('dashboard/bidang_personil');
    }

    public function edit_daftar_sertifikat($id)
    {
        $data['tittle'] = 'Edit Daftar Sertifikat | Delta Indonesia';
        $data['sertifikat_ing'] = $this->database->dataSertifikat($id);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/edit_daftar_sertifikat', $data);
        $this->load->view('template/footer');
    }

    public function update_sertifikat_ing($id)
    {
        $data = [
            'sertifikat_ing' => $this->input->post('nama_sertifikat')
        ];
        $this->db->where('id', $id);
        $this->db->update('sertifikat_ing', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil di Update</div>');
        redirect('dashboard/daftar_sertifikat');
    }

    public function delete_sertifikat_ing($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('sertifikat_ing');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil di Hapus</div>');
        redirect('dashboard/daftar_sertifikat');
    }

    public function master_kelompok_pembinaan()
    {
        $data['tittle'] = "Halaman Master Kelompok Pembinaan";

        $this->db->order_by('id', 'DESC');
        $data['kelompok_pembinaan'] = $this->db->get('kelompok_pembinaan')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/master_kelompok_pembinaan', $data);
        $this->load->view('template/footer');
    }

    public function kelompok_pembinaan_simpan()
    {
        $data = [
            'kelompok_pembinaan' => $this->input->post('kelompok_pembinaan')
        ];
        $this->db->insert('kelompok_pembinaan', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil di Tambah</div>');
        redirect('dashboard/master_kelompok_pembinaan');
    }

    public function edit_master_kelompok_pembinaan($id)
    {
        $data['tittle'] = 'Edit Master Kelompok Pembinaan | Delta Indonesia';
        $data['kelompok'] = $this->database->semuaMasterKelompokPembinaan($id);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/master_kelompok_pembinaan_edit', $data);
        $this->load->view('template/footer');
    }

    public function update_master_kelompok_pembinaan($id)
    {
        $data = [
            'kelompok_pembinaan' => $this->input->post('nama_kelompok_pembinaan')
        ];
        $this->db->where('id', $id);
        $this->db->update('kelompok_pembinaan', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil di Update</div>');
        redirect('dashboard/master_kelompok_pembinaan');
    }

    public function delete_master_kelompok_pembinaan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('kelompok_pembinaan');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil di Hapus</div>');
        redirect('dashboard/master_kelompok_pembinaan');
    }

    public function hapus_bulk_kelompok_pembinaan()
    {
        $ids = $this->input->post('id');

        if (!$ids) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Tidak ada Data yang dipilih untuk dihapus</div>');
            redirect('dashboard/master_kelompok_pembinaan');
        } else {
            $this->db->where_in('id', $ids);
            $this->db->delete('kelompok_pembinaan');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil di Hapus</div>');
            redirect('dashboard/master_kelompok_pembinaan');
        }
    }
}   


// public function hapusData()
// {
//     $ids = $this->input->post('id');

//     foreach ($ids as $id) {
//         // Mengambil nama file dari tabel dokumen_pendaftaran
//         $query = $this->db->get_where('dokumen_pendaftaran', array('id_pendaftaran' => $id));

//         // Memastikan ada hasil dari query
//         if ($query->num_rows() > 0) {
//             $results = $query->result();

//             foreach ($results as $result) {
//                 // Menghapus data dari tabel pendaftaran
//                 $this->db->delete('pendaftaran', array('id' => $id));

//                 // Menyelesaikan transaksi
//                 $this->db->trans_complete();

//                 // Jenis file yang terkait dengan pendaftaran
//                 $jenis_file = array('ktp', 'rekening', 'pasfoto', 'ijazah');

//                 // Menghapus file dari folder
//                 foreach ($jenis_file as $jenis) {
//                     $file_path = FCPATH . 'path/to/your/folder/' . $result->$jenis;

//                     if (file_exists($file_path)) {
//                         unlink($file_path);
//                     }
//                 }
//             }
//         } else {
//             // Handle jika tidak ada data yang ditemukan
//             echo "Data tidak ditemukan!";
//         }
//     }

//     echo 'sukses';
// }
