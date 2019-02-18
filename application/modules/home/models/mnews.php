<?php

class Mnews extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    public function checking( $data ) {
        return $this->db->get_where('tbnews', $data);
    }
    
    function get_records() {
        return $this->db->get('tbnews')->result();
    }

    function detailnews( $id ) {
        $this->db->where('NewsId', $id);
        return $this->db->get('tbnews')->result();
    }    

    function add_record( $data ) {
        return $this->db->insert('tbnews', $data);        
    } 

    function updatenews( $data ) {
        $this->db->where('NewsId', $this->input->post('NewsId'));
        $this->db->update('tbnews', $data);
    }

    function delete( $id ) {
        return $this->db->delete('tbnews', array('NewsId'=>$id));
    }      

    function getNews() {
        $this->db->order_by('NewsId', 'DESC');
        return $this->db->get('tbnews')->result();
    }

    function getNewsRows() {
        $this->db->order_by('NewsId', 'DESC');
        return $this->db->get('tbnews')->num_rows();
    }   

    function NewsTitle( $id ) {
        $this->db->select('NewsTitle');
        return $this->db->get_where('tbnews', array('NewsId'=>$id));
    }     

    function getArtikel() {
        $this->db->order_by('ArtclId', 'DESC');
        return $this->db->get('tbarticle')->result();
    }

    function getProject() {
        $this->db->order_by('ProId', 'DESC');
        return $this->db->get('tbproject')->result();
    }    

    function getRole( $userid ) {
        $getRole = "SELECT * from tbrole WHERE RoleId in (SELECT RoleId FROM tbuser_role WHERE UserId=?)";
        $query = $this->db->query($getRole, array($userid));
        return $query->row();
    }  

    function getByTitle( $id ) {
        return $this->db->get_where('tbnews', array('NewsId' => $id))->row();
    }     

}