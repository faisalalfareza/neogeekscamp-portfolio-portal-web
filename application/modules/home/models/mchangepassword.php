<?php

class Mchangepassword extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function changePassword( $data ) {
        $this->db->where('UserEmail', $this->input->post('UserEmail'));
        $this->db->update('tbuser', $data);
    }   
}