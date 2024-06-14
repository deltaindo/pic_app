<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';


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
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        $excel = new PHPExcel();

        $excel->getProperties()->setCreator('Bee Technology')
            ->setLastModifiedBy('Bee Technology')
            ->setTitle("Data Siswa")
            ->setSubject("Siswa")
            ->setDescription("Laporan Semua Data Siswa")
            ->setKeywords("Data Siswa");

        $style_col = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
            )
        );
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA SISWA");
        $excel->getActiveSheet()->mergeCells('A1:E1');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A3', "No");
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "Kelas Training");
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "Nama Training");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "Tanggal Awal");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "Tanggal Akhir");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "Jenis Training");

        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);

        $this->db->select('kelas_training.id,kelas.id as kelas_id, kelas.kelas, training.id as training_id, training.training, kelas_training.tanggal_awal, kelas_training.tanggal_akhir, kelas_training.jenis');
        $this->db->from('kelas');
        $this->db->join('kelas_training', 'kelas.id = kelas_training.kelas_id');
        $this->db->join('training', 'kelas_training.training_id = training.id');
        $this->db->order_by('kelas_training.id', 'DESC');
        $siswa = $this->db->get()->result_array();
        $no = 1;
        $numrow = 4;
        foreach ($siswa as $data) {
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $result['kelas']);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $result['training']);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $result['tanggal_awal']);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $result['tanggal_akhir']);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $result['jenis']);


            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);

            $no++;
            $numrow++;
        }

        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);


        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

        $excel->getActiveSheet(0)->setTitle("Report Kelas Training");
        $excel->setActiveSheetIndex(0);

        $filename = "Report_Kelas_Training.xls";
        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
        ob_end_clean();
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename=' . $filename);
        $objWriter->save('php://output');
    }
}
