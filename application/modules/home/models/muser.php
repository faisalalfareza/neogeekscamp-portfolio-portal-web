<?php

class Muser extends CI_Model {
    
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('encrypt', 'email'));
    }
    
    function checking_unique( $email ) {
        $this->db->where('UserEmail', $email);
        return $this->db->get('tbuser');
    }    
    
    function getUserActive() {
        $this->db->where('UserStatus', 1);
        $this->db->order_by('UserId', 'DESC');
        return $this->db->get('tbuser')->result();
    }

    function getUserNonActive() {
        $this->db->where('UserStatus', 0);
        $this->db->order_by('UserId', 'DESC');
        return $this->db->get('tbuser')->result();
    }

    function getResume() {
        $this->db->order_by('RsumId', 'DESC');
        return $this->db->get('tbresume')->result();
    }
    
    function getProject() {
        $this->db->order_by('ProId', 'DESC');
        return $this->db->get('tbproject')->result();
    }

    function getNews() {
        $this->db->order_by('NewsId', 'DESC');
        return $this->db->get('tbnews')->result();
    }

    function getArtikel() {
        $this->db->order_by('ArtclId', 'DESC');
        return $this->db->get('tbarticle')->result();
    } 

    function getRole( $userid ) {
        $getRole = "SELECT * from tbrole WHERE RoleId in (SELECT RoleId FROM tbuser_role WHERE UserId=?)";
        $query = $this->db->query($getRole, array($userid));
        return $query->row();
    }   
    
    function activate( $id ) {
        $data = array('UserStatus' => "1");      
        
        $this->db->where('UserId', $id);
        if($this->db->update('tbuser', $data)){
            $this->session->set_flashdata("pesan", "<div class=\"alert alert-success fade in\" id=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&#9679;</a>&nbsp; User activated &nbsp;</div>");      
            
        }        
    }      

    function activate_group() {
        $email = $this->input->post('UserEmail');
        $UserStatus = $this->input->post('item');
        $data = array('UserStatus' => "1");
        
        $config = array(
            'charset'       => 'utf-8',
            'useragent'     => 'Codeigniter',
            'protocol'      => "smtp",
            'mailtype'      => "html",
            'smtp_host'     => "ssl://smtp.gmail.com", //pengaturan smtp
            'smtp_port'     => 465,
            'smtp_timeout'  => 400,
            'smtp_user'     => "mumiichaell@gmail.com", // isi dengan email kamu
            'smtp_pass'     => "muhammad16111997", // isi dengan password kamu
            'crlf'          => "\r\n",  
            'wordwrap'      => TRUE            
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n"); 
        $this->email->initialize($config);        
                
        foreach($UserStatus as $item){
            $this->db->where('UserId', $item);
            if($this->db->update('tbuser', $data)){     
                
                //konfigurasi pengiriman
                $this->email->from($config['smtp_user']);
                $this->email->to($email);
                $this->email->subject("[Neogeeks] Verify Account");
                $this->email->message(
                 "Your account has been activated. Please login to get more experience you <br>".
                 site_url("home")
                );          
                
                $result = $this->email->send();
                $this->email->print_debugger();                
                
                $this->session->set_flashdata("pesan", "<div class=\"alert alert-success fade in\" id=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&#9679;</a>&nbsp; User activated &nbsp;</div>");                 
            }
        }      
    }
    
     function deactivate( $id ) {
        $data = array('UserStatus' => "0");  

        $this->db->where('UserId', $id);
        $this->db->update('tbuser', $data);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-warning\" id=\"alert\">User deactivated</div>");  
    }   

    function deactivate_group() {
        $email = $this->input->post('dUserEmail');
        $UserStatus = $this->input->post('item');
        $data = array('UserStatus' => "0");

        $config = array(
            'charset'       => 'utf-8',
            'useragent'     => 'Codeigniter',
            'protocol'      => "smtp",
            'mailtype'      => "html",
            'smtp_host'     => "ssl://smtp.gmail.com", //pengaturan smtp
            'smtp_port'     => 465,
            'smtp_timeout'  => 400,
            'smtp_user'     => "mumiichaell@gmail.com", // isi dengan email kamu
            'smtp_pass'     => "muhammad16111997", // isi dengan password kamu
            'crlf'          => "\r\n",  
            'wordwrap'      => TRUE            
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n"); 
        $this->email->initialize($config);                   
                
        foreach($UserStatus as $item){
            $this->db->where('UserId', $item);
            if($this->db->update('tbuser', $data)){

                //konfigurasi pengiriman
                $this->email->from($config['smtp_user']);
                $this->email->to($email);
                $this->email->subject("[Neogeeks] Verify Account");
                $this->email->message(
                 "Your account has been deactivated.<br>".
                 site_url("home")
                );          
                
                $result = $this->email->send();
                $this->email->print_debugger();  
                
                $this->session->set_flashdata("pesan", "<div class=\"alert alert-warning fade in\" id=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&#9679;</a>&nbsp; Deaktivasi Success &nbsp;</div>");                 
            }
        }      
    }    
    

    function grant_as_admin( $id ) {   
        $data = array('RoleId' => "1");        
        $this->db->where('UserId', $id);
        $this->db->update('tbuser_role', $data);
    }

    function revoke_as_admin( $id ) {   
        $data = array('RoleId' => "2");        
        $this->db->where('UserId', $id);
        $this->db->update('tbuser_role', $data);
    }     
    
    function delete($id) {  
        return $this->db->delete('tbuser', array('UserId'=>$id));
    }        
    
}