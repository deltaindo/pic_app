<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['tittle'] ='Login Page';
            $this->load->view('auth/login', $data);
        } else {
            
            $this->_login();
            
        }
		
	}

    public function _login(){
        $email = $this->input->post('email');   
        $password = $this->input->post('password');
            
        $user = $this->db->where('email', $email)
                     ->or_where('nama', $email)
                     ->get('user')
                     ->row_array();
       
            
        if($user) {
            if(md5($password) === $user['password']){
               if($user['level'] == 1) {
                $data = [
                    'id' => $user['id'],
                    'email' => $user['email'],
                ];
                    
                $this->session->set_userdata($data);
                redirect('dashboard/admin');
               }else{
                $data = [
                    'id' => $user['id'],
                    'email' => $user['email']
                   
                ];
                    
                $this->session->set_userdata($data);
                redirect('dashboard'); 
               }
            }else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                redirect('auth');
            }
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User belum terdaftar.</div>');
            redirect('auth');
        }
    }
    
    public function register()
    {
        $data['tittle'] = 'Register';
        $this->load->library('form_validation');
        // $this->form_validation->set_rules('nama', 'Username', 'required|is_unique[user.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'required|matches[password]');
        
        if ($this->form_validation->run() == FALSE) {
            
           
            $this->load->view('auth/register', $data);
           
        } else {
            

            $data = array(
                'nama' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'phone_number' => $this->input->post('telepon'),
                'password' => md5($this->input->post('password')),     
                'level' => 2
                
            );
            
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun Berhasil di Buat</div>');
            redirect('auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        redirect('auth');
    }
	
}
