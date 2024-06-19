<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

date_default_timezone_set('Asia/Jakarta');

class Report extends CI_Controller
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

    public function kelas_training_excel()
    {
        $this->db->select('kelas_training.id,kelas.id as kelas_id, kelas.kelas, training.id as training_id, training.training, kelas_training.tanggal_awal, kelas_training.tanggal_akhir, kelas_training.jenis');
        $this->db->from('kelas');
        $this->db->join('kelas_training', 'kelas.id = kelas_training.kelas_id');
        $this->db->join('training', 'kelas_training.training_id = training.id');
        $this->db->order_by('kelas_training.id', 'DESC');
        $data['training'] = $this->db->get()->result_array();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Report Kelas Training');

        // Set title header
        $sheet->mergeCells('A1:F1');
        $sheet->setCellValue('A1', 'Report Kelas Training');
        $sheet->getStyle('A1:F1')->getFont()->setBold(true)->setSize(15);
        $sheet->getStyle('A1:F1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Set header
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Nama Kelas');
        $sheet->setCellValue('C2', 'Nama Training');
        $sheet->setCellValue('D2', 'Tanggal Awal');
        $sheet->setCellValue('E2', 'Tanggal Akhir');
        $sheet->setCellValue('F2', 'Jenis Training');

        // Apply bold style and background color to header
        $sheet->getStyle('A2:F2')->getFont()->setBold(true)->setSize(12);;
        $sheet->getStyle('A2:F2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A2:F2')->getFill()->getStartColor()->setARGB('FFB0B0B0'); // Warna abu-abu

        // Populate data
        $baris = 3;
        $no = 1;
        foreach ($data['training'] as $item) {
            $sheet->setCellValue('A' . $baris, $no++);
            $sheet->setCellValue('B' . $baris, $item['kelas']);
            $sheet->setCellValue('C' . $baris, $item['training']);
            $sheet->setCellValue('D' . $baris, $item['tanggal_awal']);
            $sheet->setCellValue('E' . $baris, $item['tanggal_akhir']);
            $sheet->setCellValue('F' . $baris, $item['jenis']);
            $baris++;
        }

        // Apply border style to all cells
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $sheet->getStyle('A2:F' . ($baris - 1))->applyFromArray($styleArray);

        // Set auto size for all columns
        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Generate filename with current date and time
        $currentDateTime = date('Ymd_His'); // Format: YYYYMMDD_HHMMSS
        $filename = "Report_Kelas_Training_{$currentDateTime}.xlsx";

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function kelompok_pembinaan_excel()
    {
        $this->db->select('tb_kelompok_pembinaan.id, tb_kelompok_pembinaan.id_bidang, tb_kelompok_pembinaan.id_kelompok_pembinaan, tb_kelompok_pembinaan.id_jenis_personil, kelompok_pembinaan.kelompok_pembinaan, jenis_personil.jenis_personil, bidang.bidang');
        $this->db->from('tb_kelompok_pembinaan');
        $this->db->join('jenis_personil', 'tb_kelompok_pembinaan.id_jenis_personil = jenis_personil.id', 'left');
        $this->db->join('bidang', 'tb_kelompok_pembinaan.id_bidang = bidang.id', 'left');
        $this->db->join('kelompok_pembinaan', 'tb_kelompok_pembinaan.id_kelompok_pembinaan = kelompok_pembinaan.id', 'left');
        $this->db->order_by('tb_kelompok_pembinaan.id', 'DESC');
        $data['kelompok_pembinaan'] = $this->db->get()->result_array();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Report Kelompok Pembinaan');

        // Set title header
        $sheet->mergeCells('A1:D1');
        $sheet->setCellValue('A1', 'Report Kelompok Pembinaan');
        $sheet->getStyle('A1:D1')->getFont()->setBold(true)->setSize(15);;
        $sheet->getStyle('A1:D1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Set header
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Nama Kelompok Pembinaan');
        $sheet->setCellValue('C2', 'Nama Bidang');
        $sheet->setCellValue('D2', 'Jenis Personil');

        // Apply bold style and background color to header
        $sheet->getStyle('A2:D2')->getFont()->setBold(true)->setSize(12);;
        $sheet->getStyle('A2:D2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A2:D2')->getFill()->getStartColor()->setARGB('FFB0B0B0'); // Warna abu-abu

        // Populate data
        $baris = 3;
        $no = 1;
        foreach ($data['kelompok_pembinaan'] as $item) {
            $sheet->setCellValue('A' . $baris, $no++);
            $sheet->setCellValue('B' . $baris, $item['kelompok_pembinaan']);
            $sheet->setCellValue('C' . $baris, $item['bidang']);
            $sheet->setCellValue('D' . $baris, $item['jenis_personil']);
            $baris++;
        }

        // Apply border style to all cells
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $sheet->getStyle('A2:D' . ($baris - 1))->applyFromArray($styleArray);

        // Set auto size for all columns
        foreach (range('A', 'D') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Generate filename with current date and time
        $currentDateTime = date('Ymd_His'); // Format: YYYYMMDD_HHMMSS
        $filename = "Report_Kelompok_Pembinaan_{$currentDateTime}.xlsx";

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
