<?php

class Mhome extends CI_Model {
    
    function __construct() {
        parent::__construct();  
    }
    
    function getResume() {
        $this->db->order_by('RsumId', 'DESC');
        return $this->db->get('tbresume')->result();
    }

    function getJob() {
        $this->db->distinct();
        $this->db->select('RsumJob');
        $this->db->order_by('RsumId', 'DESC');
        return $this->db->get('tbresume')->result();
    }

    function getSkill() {
        $this->db->distinct();
        $this->db->select('RsumSkill1');
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
    
    function findNews() {
		$find = $this->input->GET('destination', TRUE);
        $this->db->like('NewsTitle', $find);        
        $this->db->or_like('NewsContent', $find);      
        return $this->db->get('tbnews')->result();        
	}  

    function findArticle() {
		$find = $this->input->GET('destination', TRUE);
        $this->db->like('ArtclTitle', $find);        
        $this->db->or_like('ArtclContent', $find);      
        return $this->db->get('tbarticle')->result();        
	} 
    
    function findResume() {
		$find = $this->input->GET('destination', TRUE);
        $this->db->like('RsumName', $find);        
        $this->db->or_like('RsumJob', $find);
        $this->db->or_like('RsumSkill1', $find);
        $this->db->or_like('RsumSkill2', $find);
        $this->db->or_like('RsumSkill3', $find);
        $this->db->or_like('RsumSkill4', $find);
        $this->db->or_like('RsumSkill5', $find);
        $this->db->or_like('LastEducation1', $find);
        $this->db->or_like('LastEducation2', $find);
        $this->db->or_like('LastEducation3', $find);
        return $this->db->get('tbresume')->result();        
	}  
    
    function findProject() {
		$find = $this->input->GET('destination', TRUE);
        $this->db->like('ProName', $find);        
        $this->db->or_like('ProSites', $find);
        $this->db->or_like('ProDesc', $find);
        $this->db->or_like('ProStatus', $find);
        return $this->db->get('tbproject')->result();        	
    }      
    
}