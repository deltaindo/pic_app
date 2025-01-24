<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

date_default_timezone_set('Asia/Jakarta');

class Report extends CI_Controller
{
    /**
     * Constructor for the Report class.
     *
     */
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
    /**
     * Generates an Excel file containing a report of kelas training details.
     *
     */
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

    /**
     * Generate an Excel report of the Kelompok Pembinaan data.
     *
     * This function retrieves data from the database using the selected fields and joins
     * the necessary tables. It then populates an Excel spreadsheet with the retrieved data.
     * The report includes a title header, column headers, and the actual data. The report is
     * downloaded as an Excel file with a dynamically generated filename.
     *
     * @throws Exception if there is an error retrieving data from the database or generating the report.
     */
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

    /**
     * Generates an Excel report of the bidang data in descending order of id.
     *
     * @return void
     */
    public function report_bidang_excel()
    {
        $this->db->order_by('id', 'DESC');
        $data['bidang'] = $this->db->get('bidang')->result_array();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Report Data Bidang');

        // Set title header
        $sheet->mergeCells('A1:B1');
        $sheet->setCellValue('A1', 'Report Data Bidang');
        $sheet->getStyle('A1:B1')->getFont()->setBold(true)->setSize(15);;
        $sheet->getStyle('A1:B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Set header
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Nama Bidang');

        // Apply bold style and background color to header
        $sheet->getStyle('A2:B2')->getFont()->setBold(true)->setSize(12);;
        $sheet->getStyle('A2:B2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A2:B2')->getFill()->getStartColor()->setARGB('FFB0B0B0'); // Warna abu-abu

        // Populate data
        $baris = 3;
        $no = 1;
        foreach ($data['bidang'] as $item) {
            $sheet->setCellValue('A' . $baris, $no++);
            $sheet->setCellValue('B' . $baris, $item['bidang']);
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
        $sheet->getStyle('A2:B' . ($baris - 1))->applyFromArray($styleArray);

        // Set auto size for all columns
        foreach (range('A', 'B') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Generate filename with current date and time
        $currentDateTime = date('Ymd_His'); // Format: YYYYMMDD_HHMMSS
        $filename = "Report_Data_Bidang_{$currentDateTime}.xlsx";

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    /**
     * Generates an Excel report of the data in the 'kelas' table and prompts the user to download it.
     *
     * @return void
     */
    public function report_kelas_excel()
    {
        $this->db->order_by('id', 'DESC');
        $data['kelas'] = $this->db->get('kelas')->result_array();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Report Data Kelas');

        // Set title header
        $sheet->mergeCells('A1:B1');
        $sheet->setCellValue('A1', 'Report Data Kelas');
        $sheet->getStyle('A1:B1')->getFont()->setBold(true)->setSize(15);;
        $sheet->getStyle('A1:B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Set header
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Nama Kelas');

        // Apply bold style and background color to header
        $sheet->getStyle('A2:B2')->getFont()->setBold(true)->setSize(12);;
        $sheet->getStyle('A2:B2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A2:B2')->getFill()->getStartColor()->setARGB('FFB0B0B0'); // Warna abu-abu

        // Populate data
        $baris = 3;
        $no = 1;
        foreach ($data['kelas'] as $item) {
            $sheet->setCellValue('A' . $baris, $no++);
            $sheet->setCellValue('B' . $baris, $item['kelas']);
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
        $sheet->getStyle('A2:B' . ($baris - 1))->applyFromArray($styleArray);

        // Set auto size for all columns
        foreach (range('A', 'B') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Generate filename with current date and time
        $currentDateTime = date('Ymd_His'); // Format: YYYYMMDD_HHMMSS
        $filename = "Report_Data_Kelas_{$currentDateTime}.xlsx";

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    /**
     * Generates an Excel report of the 'kelas_pembina' table and prompts the user to download it.
     *
     * This function retrieves data from the 'kelas_pembina' table in descending order by the 'id' column.
     * It then creates a new Spreadsheet object and sets the title of the active sheet to 'Report Kelas Pembina'.
     * The function sets the title header by merging cells A1:B1 and setting the value to 'Kelas Pembina'.
     * The header is styled with bold font of size 15 and centered horizontally.
     * The function sets the header cells A2 and B2 with values 'No' and 'Nama Kelas Pembina' respectively.
     * The header cells are styled with bold font of size 12 and a solid fill color of gray (#B0B0B0).
     * The function populates the data from the 'kelas' array into the sheet starting from cell A3.
     * The data is populated row by row, with the 'no' column incremented by 1 for each row.
     * The function applies a thin border style to all cells in the sheet.
     * The function sets the auto size for all columns A to B.
     * The function generates a filename for the report using the current date and time in the format 'YYYYMMDD_HHMMSS'.
     * The function sets the headers for the download, specifying the content type and filename.
     * The function saves the Spreadsheet object to the output and exits the script.
     *
     * @return void
     */
    public function kelas_pembina_excel()
    {
        $this->db->order_by('id', 'DESC');
        $data['kelas'] = $this->db->get('kelas_pembina')->result_array();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Report Kelas Pembina');

        // Set title header
        $sheet->mergeCells('A1:B1');
        $sheet->setCellValue('A1', 'Kelas Pembina');
        $sheet->getStyle('A1:B1')->getFont()->setBold(true)->setSize(15);;
        $sheet->getStyle('A1:B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Set header
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Nama Kelas Pembina');

        // Apply bold style and background color to header
        $sheet->getStyle('A2:B2')->getFont()->setBold(true)->setSize(12);;
        $sheet->getStyle('A2:B2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A2:B2')->getFill()->getStartColor()->setARGB('FFB0B0B0'); // Warna abu-abu

        // Populate data
        $baris = 3;
        $no = 1;
        foreach ($data['kelas'] as $item) {
            $sheet->setCellValue('A' . $baris, $no++);
            $sheet->setCellValue('B' . $baris, $item['kelas']);
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
        $sheet->getStyle('A2:B' . ($baris - 1))->applyFromArray($styleArray);

        // Set auto size for all columns
        foreach (range('A', 'B') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Generate filename with current date and time
        $currentDateTime = date('Ymd_His'); // Format: YYYYMMDD_HHMMSS
        $filename = "Report_Data_Kelas_{$currentDateTime}.xlsx";

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    /**
     * Generates an Excel report of the master kelompok pembinaan data.
     *
     * This function retrieves the kelompok pembinaan data from the database,
     * orders it by the 'id' column in descending order, and stores it in the
     * 'kelompok_pembinaan' key of the $data array. It then creates a new
     * Spreadsheet object and sets the active sheet title to 'Report Kelompok
     * Pembinaan'. The function sets the title header by merging cells A1:B1
     * and setting the cell values to 'Report Kelompok Pembinaan'. The title
     * header is styled with bold font size 15 and horizontal center alignment.
     * The function sets the header cells A2 and B2 with the values 'No' and
     * 'Nama Kelompok Pembinaan' respectively. The header cells are styled with
     * bold font size 12 and a solid background color. The data is populated by
     * iterating over the 'kelompok_pembinaan' array and setting the cell
     * values in the A column and B column respectively. The cells are styled
     * with thin borders. The function sets the auto size for all columns A to
     * B. The function generates a filename with the current date and time in
     * the format YYYYMMDD_HHMMSS and sets the headers for download with the
     * appropriate content type and filename. Finally, the function saves the
     * Spreadsheet object to the output stream and exits.
     *
     * @return void
     */
    public function master_kelompok_pembinaan_excel()
    {
        $this->db->order_by('id', 'DESC');
        $data['kelompok_pembinaan'] = $this->db->get('kelompok_pembinaan')->result_array();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Report Kelompok Pembinaan');

        // Set title header
        $sheet->mergeCells('A1:B1');
        $sheet->setCellValue('A1', 'Report Kelompok Pembinaan');
        $sheet->getStyle('A1:B1')->getFont()->setBold(true)->setSize(15);;
        $sheet->getStyle('A1:B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Set header
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Nama Kelompok Pembinaan');

        // Apply bold style and background color to header
        $sheet->getStyle('A2:B2')->getFont()->setBold(true)->setSize(12);;
        $sheet->getStyle('A2:B2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A2:B2')->getFill()->getStartColor()->setARGB('FFB0B0B0'); // Warna abu-abu

        // Populate data
        $baris = 3;
        $no = 1;
        foreach ($data['kelompok_pembinaan'] as $item) {
            $sheet->setCellValue('A' . $baris, $no++);
            $sheet->setCellValue('B' . $baris, $item['kelompok_pembinaan']);
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
        $sheet->getStyle('A2:B' . ($baris - 1))->applyFromArray($styleArray);

        // Set auto size for all columns
        foreach (range('A', 'B') as $columnID) {
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

    /**
     * Generate an Excel report of training data.
     *
     * This function retrieves training data from the database, formats it into an Excel spreadsheet,
     * and provides it for download. The report includes a title, headers, and data.
     *
     * @return void
     */
    public function data_training_excel()
    {
        $this->db->order_by('id', 'DESC');
        $data['training'] = $this->db->get('training')->result_array();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Report Data Training');
        // Set title header
        $sheet->mergeCells('A1:B1');
        $sheet->setCellValue('A1', 'Report Data Training');
        $sheet->getStyle('A1:B1')->getFont()->setBold(true)->setSize(15);;
        $sheet->getStyle('A1:B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Set header
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Nama Training');

        // Apply bold style and background color to header
        $sheet->getStyle('A2:B2')->getFont()->setBold(true)->setSize(12);;
        $sheet->getStyle('A2:B2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A2:B2')->getFill()->getStartColor()->setARGB('FFB0B0B0'); // Warna abu-abu

        // Populate data
        $baris = 3;
        $no = 1;
        foreach ($data['training'] as $item) {
            $sheet->setCellValue('A' . $baris, $no++);
            $sheet->setCellValue('B' . $baris, $item['Training']);
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
        $sheet->getStyle('A2:B' . ($baris - 1))->applyFromArray($styleArray);

        // Set auto size for all columns
        foreach (range('A', 'B') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Generate filename with current date and time
        $currentDateTime = date('Ymd_His'); // Format: YYYYMMDD_HHMMSS
        $filename = "Report_Data_Training_{$currentDateTime}.xlsx";

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    /**
     * Generates an Excel file containing a report of the "jenis_alat" table.
     *
     * @return void
     */
    public function jenis_alat_excel()
    {
        $this->db->order_by('id', 'DESC');
        $data['jenis_alat'] = $this->db->get('jenis_alat')->result_array();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Report Jenis Alat');
        // Set title header
        $sheet->mergeCells('A1:B1');
        $sheet->setCellValue('A1', 'Report Jenis Alat');
        $sheet->getStyle('A1:B1')->getFont()->setBold(true)->setSize(15);;
        $sheet->getStyle('A1:B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Set header
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Nama Jenis Alat');

        // Apply bold style and background color to header
        $sheet->getStyle('A2:B2')->getFont()->setBold(true)->setSize(12);;
        $sheet->getStyle('A2:B2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A2:B2')->getFill()->getStartColor()->setARGB('FFB0B0B0'); // Warna abu-abu

        // Populate data
        $baris = 3;
        $no = 1;
        foreach ($data['jenis_alat'] as $item) {
            $sheet->setCellValue('A' . $baris, $no++);
            $sheet->setCellValue('B' . $baris, $item['jenis_alat']);
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
        $sheet->getStyle('A2:B' . ($baris - 1))->applyFromArray($styleArray);

        // Set auto size for all columns
        foreach (range('A', 'B') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Generate filename with current date and time
        $currentDateTime = date('Ymd_His'); // Format: YYYYMMDD_HHMMSS
        $filename = "Report_Jenis_Alat_{$currentDateTime}.xlsx";

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    /**
     * Generates an Excel file containing a report of the types of personnel.
     *
     * This function retrieves the personnel types from the database, creates a
     * Spreadsheet object, and populates it with the personnel types. It then
     * applies formatting to the header and data cells, sets the column widths,
     * generates a filename based on the current date and time, and sets the
     * headers for downloading the file. Finally, it saves the Spreadsheet to
     * the output buffer and exits the script.
     *
     * @return void
     */
    public function jenis_personil_excel()
    {
        $this->db->order_by('id', 'DESC');
        $data['personil'] = $this->db->get('jenis_personil')->result_array();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Report Jenis Personil');
        // Set title header
        $sheet->mergeCells('A1:B1');
        $sheet->setCellValue('A1', 'Report Jenis Personil');
        $sheet->getStyle('A1:B1')->getFont()->setBold(true)->setSize(15);;
        $sheet->getStyle('A1:B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Set header
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Nama Jenis Personil');

        // Apply bold style and background color to header
        $sheet->getStyle('A2:B2')->getFont()->setBold(true)->setSize(12);;
        $sheet->getStyle('A2:B2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A2:B2')->getFill()->getStartColor()->setARGB('FFB0B0B0'); // Warna abu-abu

        // Populate data
        $baris = 3;
        $no = 1;
        foreach ($data['personil'] as $item) {
            $sheet->setCellValue('A' . $baris, $no++);
            $sheet->setCellValue('B' . $baris, $item['jenis_personil']);
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
        $sheet->getStyle('A2:B' . ($baris - 1))->applyFromArray($styleArray);

        // Set auto size for all columns
        foreach (range('A', 'B') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Generate filename with current date and time
        $currentDateTime = date('Ymd_His'); // Format: YYYYMMDD_HHMMSS
        $filename = "Report_Jenis_Personil_{$currentDateTime}.xlsx";

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    /**
     * Generates an Excel file containing a report of the "pendidikan" table.
     */
    public function jenis_pendidikan_excel()
    {
        $this->db->order_by('id', 'DESC');
        $data['pendidikan'] = $this->db->get('pendidikan')->result_array();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Report Jenis Pendidikan');
        // Set title header
        $sheet->mergeCells('A1:B1');
        $sheet->setCellValue('A1', 'Report Jenis Pendidikan');
        $sheet->getStyle('A1:B1')->getFont()->setBold(true)->setSize(15);;
        $sheet->getStyle('A1:B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Set header
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Nama Jenis Pendidikan');

        // Apply bold style and background color to header
        $sheet->getStyle('A2:B2')->getFont()->setBold(true)->setSize(12);;
        $sheet->getStyle('A2:B2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A2:B2')->getFill()->getStartColor()->setARGB('FFB0B0B0'); // Warna abu-abu

        // Populate data
        $baris = 3;
        $no = 1;
        foreach ($data['pendidikan'] as $item) {
            $sheet->setCellValue('A' . $baris, $no++);
            $sheet->setCellValue('B' . $baris, $item['pendidikan']);
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
        $sheet->getStyle('A2:B' . ($baris - 1))->applyFromArray($styleArray);

        // Set auto size for all columns
        foreach (range('A', 'B') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Generate filename with current date and time
        $currentDateTime = date('Ymd_His'); // Format: YYYYMMDD_HHMMSS
        $filename = "Report_Jenis_Pendidikan_{$currentDateTime}.xlsx";

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    /**
     * Generates an Excel file containing the report for Alat Kelompok Pembinaan.
     *
     */
    public function alat_kelompok_pembinaan_excel()
    {
        $this->db->select('tb_jenis_alat.id,jenis_alat.jenis_alat, kelompok_pembinaan.kelompok_pembinaan');
        $this->db->from('tb_jenis_alat');
        $this->db->join('jenis_alat', 'jenis_alat.id = tb_jenis_alat.Jenis_alat');
        $this->db->join('kelompok_pembinaan', 'kelompok_pembinaan.id = tb_jenis_alat.id_kelompok_pembinaan');
        $this->db->order_by('tb_jenis_alat.id', 'DESC');
        $data['alat_kelompok'] = $this->db->get()->result_array();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Report Alat Kelompok Pembinaan');
        // Set title header
        $sheet->mergeCells('A1:C1');
        $sheet->setCellValue('A1', 'Report Alat Kelompok Pembinaan');
        $sheet->getStyle('A1:C1')->getFont()->setBold(true)->setSize(15);;
        $sheet->getStyle('A1:C1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Set header
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Nama Kelompok Pembinaan');
        $sheet->setCellValue('C2', 'Nama Jenis Alat');

        // Apply bold style and background color to header
        $sheet->getStyle('A2:C2')->getFont()->setBold(true)->setSize(12);;
        $sheet->getStyle('A2:C2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A2:C2')->getFill()->getStartColor()->setARGB('FFB0B0B0'); // Warna abu-abu

        // Populate data
        $baris = 3;
        $no = 1;
        foreach ($data['alat_kelompok'] as $item) {
            $sheet->setCellValue('A' . $baris, $no++);
            $sheet->setCellValue('B' . $baris, $item['kelompok_pembinaan']);
            $sheet->setCellValue('C' . $baris, $item['jenis_alat']);
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
        $sheet->getStyle('A2:C' . ($baris - 1))->applyFromArray($styleArray);

        // Set auto size for all columns
        foreach (range('A', 'C') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Generate filename with current date and time
        $currentDateTime = date('Ymd_His'); // Format: YYYYMMDD_HHMMSS
        $filename = "Report_Alat_Kelompok_Pembinaan_{$currentDateTime}.xlsx";

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    /**
     * Generates an Excel file containing a report of Bidang Personil data.
     *
     */
    public function bidang_personil_excel()
    {
        $this->db->select('tb_personil.id, jenis_personil.jenis_personil, bidang.bidang');
        $this->db->from('tb_personil');
        $this->db->join('jenis_personil', 'tb_personil.id_jenis_personil = jenis_personil.id');
        $this->db->join('bidang', 'tb_personil.id_bidang = bidang.id');
        $this->db->order_by('tb_personil.id', 'DESC');
        $data['bidang_personil'] = $this->db->get()->result_array();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Report Bidang Personil');
        // Set title header
        $sheet->mergeCells('A1:C1');
        $sheet->setCellValue('A1', 'Report Bidang Personil');
        $sheet->getStyle('A1:C1')->getFont()->setBold(true)->setSize(15);;
        $sheet->getStyle('A1:C1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Set header
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Nama Bidang');
        $sheet->setCellValue('C2', 'Jenis Personil');

        // Apply bold style and background color to header
        $sheet->getStyle('A2:C2')->getFont()->setBold(true)->setSize(12);;
        $sheet->getStyle('A2:C2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A2:C2')->getFill()->getStartColor()->setARGB('FFB0B0B0'); // Warna abu-abu

        // Populate data
        $baris = 3;
        $no = 1;
        foreach ($data['bidang_personil'] as $item) {
            $sheet->setCellValue('A' . $baris, $no++);
            $sheet->setCellValue('B' . $baris, $item['bidang']);
            $sheet->setCellValue('C' . $baris, $item['jenis_personil']);
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
        $sheet->getStyle('A2:C' . ($baris - 1))->applyFromArray($styleArray);

        // Set auto size for all columns
        foreach (range('A', 'C') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Generate filename with current date and time
        $currentDateTime = date('Ymd_His'); // Format: YYYYMMDD_HHMMSS
        $filename = "Report_Bidang_Personil_{$currentDateTime}.xlsx";

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    /**
     * Generates an Excel file for the report of the latest education.
     *
     */
    public function pendidikan_terakhir_excel()
    {
        $this->db->select('pendidikan_terakhir.id, kelas.kelas, pendidikan.pendidikan');
        $this->db->from('pendidikan_terakhir');
        $this->db->join('kelas', 'pendidikan_terakhir.id_kelas = kelas.id');
        $this->db->join('pendidikan', 'pendidikan_terakhir.id_pendidikan = pendidikan.id');
        $this->db->order_by('pendidikan_terakhir.id', 'DESC');
        $data['pendidikan_terakhir'] = $this->db->get()->result_array();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Report Pendidikan Terakhir');
        // Set title header
        $sheet->mergeCells('A1:C1');
        $sheet->setCellValue('A1', 'Report Pendidikan Terakhir');
        $sheet->getStyle('A1:C1')->getFont()->setBold(true)->setSize(15);;
        $sheet->getStyle('A1:C1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Set header
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Nama Kelas');
        $sheet->setCellValue('C2', 'Pendidikan Terakhir');

        // Apply bold style and background color to header
        $sheet->getStyle('A2:C2')->getFont()->setBold(true)->setSize(12);;
        $sheet->getStyle('A2:C2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A2:C2')->getFill()->getStartColor()->setARGB('FFB0B0B0'); // Warna abu-abu

        // Populate data
        $baris = 3;
        $no = 1;
        foreach ($data['pendidikan_terakhir'] as $item) {
            $sheet->setCellValue('A' . $baris, $no++);
            $sheet->setCellValue('B' . $baris, $item['kelas']);
            $sheet->setCellValue('C' . $baris, $item['pendidikan']);
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
        $sheet->getStyle('A2:C' . ($baris - 1))->applyFromArray($styleArray);

        // Set auto size for all columns
        foreach (range('A', 'C') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Generate filename with current date and time
        $currentDateTime = date('Ymd_His'); // Format: YYYYMMDD_HHMMSS
        $filename = "Report_Pendidikan_Terakhir_{$currentDateTime}.xlsx";

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    /**
     * Generates an Excel report of the sertifikat_indonesia data in descending order of id.
     *
     * @return void
     */
    public function sertifikat_indonesia_excel()
    {
        $this->db->order_by('id', 'DESC');
        $data['sertifikat_indonesia'] = $this->db->get('sertifikat_indonesia')->result_array();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Report Sertifikat Indonesia');
        // Set title header
        $sheet->mergeCells('A1:B1');
        $sheet->setCellValue('A1', 'Report Sertifikat Bahasa Indonesia');
        $sheet->getStyle('A1:B1')->getFont()->setBold(true)->setSize(15);;
        $sheet->getStyle('A1:B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Set header
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Sertifikat Bahasa Indonesia');

        // Apply bold style and background color to header
        $sheet->getStyle('A2:B2')->getFont()->setBold(true)->setSize(12);;
        $sheet->getStyle('A2:B2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A2:B2')->getFill()->getStartColor()->setARGB('FFB0B0B0'); // Warna abu-abu

        // Populate data
        $baris = 3;
        $no = 1;
        foreach ($data['sertifikat_indonesia'] as $item) {
            $sheet->setCellValue('A' . $baris, $no++);
            $sheet->setCellValue('B' . $baris, $item['sertifikat_indonesia']);
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
        $sheet->getStyle('A2:B' . ($baris - 1))->applyFromArray($styleArray);

        // Set auto size for all columns
        foreach (range('A', 'B') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Generate filename with current date and time
        $currentDateTime = date('Ymd_His'); // Format: YYYYMMDD_HHMMSS
        $filename = "Report_Sertifikat_Indonesia_{$currentDateTime}.xlsx";

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    /**
     * Generates an Excel report of the list of certificates in Indonesian and English.
     *
     * This function retrieves data from the database using a SELECT query with a JOIN operation.
     * It then creates a new Spreadsheet object and sets the title of the active sheet to "Report Daftar Sertifikat".
     * The function sets the header title and applies bold and background color styles to the header cells.
     * It populates the data from the database into the sheet, starting from row 3.
     * The function applies border styles and auto-sizes the columns.
     * Finally, it generates a filename with the current date and time, sets the headers for download,
     * and saves the Spreadsheet object as an Excel file.
     *
     * @return void
     */
    public function sertifikat_excel()
    {
        $this->db->select('sertifikat_ing.id as id_ing,sertifikat_indonesia.sertifikat_indonesia, sertifikat_indonesia.id, sertifikat_ing.sertifikat_ing');
        $this->db->from('sertifikat_indonesia');
        $this->db->join('sertifikat_ing', 'sertifikat_ing.id_ser = sertifikat_indonesia.id');
        $data['sertifikat'] = $this->db->get()->result_array();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Report Daftar Sertifikat');
        // Set title header
        $sheet->mergeCells('A1:C1');
        $sheet->setCellValue('A1', 'Report Daftar Sertifikat');
        $sheet->getStyle('A1:C1')->getFont()->setBold(true)->setSize(15);;
        $sheet->getStyle('A1:C1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Set header
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Sertifikat Bahasa Indonesia');
        $sheet->setCellValue('C2', 'Sertifikat Bahasa Inggris');

        // Apply bold style and background color to header
        $sheet->getStyle('A2:C2')->getFont()->setBold(true)->setSize(12);;
        $sheet->getStyle('A2:C2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A2:C2')->getFill()->getStartColor()->setARGB('FFB0B0B0'); // Warna abu-abu

        // Populate data
        $baris = 3;
        $no = 1;
        foreach ($data['sertifikat'] as $item) {
            $sheet->setCellValue('A' . $baris, $no++);
            $sheet->setCellValue('B' . $baris, $item['sertifikat_indonesia']);
            $sheet->setCellValue('C' . $baris, $item['sertifikat_ing']);
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
        $sheet->getStyle('A2:C' . ($baris - 1))->applyFromArray($styleArray);

        // Set auto size for all columns
        foreach (range('A', 'C') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Generate filename with current date and time
        $currentDateTime = date('Ymd_His'); // Format: YYYYMMDD_HHMMSS
        $filename = "Report_Daftar_Sertifikat_{$currentDateTime}.xlsx";

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
