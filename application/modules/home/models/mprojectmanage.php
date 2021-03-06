<?php

class Mprojectmanage extends CI_Model {
    
    function __construct() {
        parent::__construct();   
    }
    
    function getProjectActive() {
        $this->db->where('Privilage', 1);
        $this->db->order_by('ProId', 'DESC');
        return $this->db->get('tbproject')->result();
    }

    function getProjectNonActive() {
        $this->db->where('Privilage', 0);
        $this->db->order_by('ProId', 'DESC');
        return $this->db->get('tbproject')->result();
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
        $data = array('Privilage' => "1");      

        $this->db->where('ProId', $id);
        $this->db->update('tbproject', $data);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-warning\" id=\"alert\">Project Accepted</div>");          
    }  
    
    function activate_group() {
        $privilage = $this->input->post('item');
        $data = array('Privilage' => "1");
                
        foreach($privilage as $item){
            $this->db->where('ProId', $item);
            if($this->db->update('tbproject', $data)){
                $this->session->set_flashdata("pesan", "<div class=\"alert alert-success fade in\" id=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&#9679;</a>&nbsp; Project accepted &nbsp;</div>");                 
            }
        }      
    }
    
    function deactivate( $id ) {
        $data = array('Privilage' => "0");  

        $this->db->where('ProId', $id);
        $this->db->update('tbproject', $data);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-warning\" id=\"alert\">Project disscard</div>");  
    }     
 

    function deactivate_group() {
        $privilage = $this->input->post('item');
        $data = array('Privilage' => "0");
                
        foreach($privilage as $item){
            $this->db->where('Privilage', $item);
            if($this->db->update('tbproject', $data)){
                $this->session->set_flashdata("pesan", "<div class=\"alert alert-warning fade in\" id=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&#9679;</a>&nbsp; Disscard success &nbsp;</div>");                 
            }
        }      
    }    
     
    function delete( $id ) {
        return $this->db->delete('tbproject', array('ProId'=>$id));
    }        
    
}