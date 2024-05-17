<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

	public function cekForm($id, $key)
    {
        $token = $this->db->get_where('form',['token' => $key])->row_array();

        if($token) {
            if($token['id_user'] == $id) { 
                if($token['status'] === 'Aktif')
                {
                   if($token['program'] === "Inhouse") {
                    $data = [
                        'token' => $key,
                        'id_form' => $token['id'],
                        'id_program' => $token['program'],
                        'form' => $token['form']
                    ];
                    $this->session->set_userdata($data);
                    redirect('form/inhouse');
                   }else {
                    $data = [
                        'token' => $key,
                        'id_form' => $token['id'],
                        'id_program' => $token['program'],
                        'form' => $token['form']
                    ];
                    $this->session->set_userdata($data);
                    redirect('form');
                   }
                }else {
                    echo 'Link Sudah Expired';
                }
            }else {
                echo 'tidak terdaftar';    
            } 
        }else{
            echo 'tidak terdaftar';
        }
    }
}
