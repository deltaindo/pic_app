<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use SebastianBergmann\Environment\Console;

class Sertifikat extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
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

    public function cetak($id)
    {
        
        $user = $this->db->get_where('sertifikat',['id_pendaftaran' => $id])->row_array();
        if(!$user) {
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
}
