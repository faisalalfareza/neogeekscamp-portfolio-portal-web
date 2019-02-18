<?php

class Mlog extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    public function save_log( $param )
    {
        $sql        = $this->db->insert_string('tblog', $param);
        $ex         = $this->db->query($sql);
        return $this->db->affected_rows($sql);
    }  

    function getLog() {
        $this->db->distinct();
        $this->db->order_by('log_id', 'DESC');
        return $this->db->get('tblog')->result();
    }    

    function getRole( $userid ) {
        $getRole = "SELECT * from tbrole WHERE RoleId in (SELECT RoleId FROM tbuser_role WHERE UserId=?)";
        $query = $this->db->query($getRole, array($userid));
        return $query->row();
    }   

    function clearBrowsingData() {
        $UserId = $this->input->post('UserId');

        $login="";$logout="";
        $create="";$update="";$delete="";
        $asign="";$confirm="";
        
        /* Check Clear Option */
        if($this->input->post('authenticate') != null) { $login=1;  $logout=0; }
        if($this->input->post('transaction') != null) { $create=2; $update=3; $delete=4; }
        if($this->input->post('asign') != null) { $asign=5; }
        if($this->input->post('confirm') != null) { $confirm=6; } 

        $this->db->delete('tblog', array('log_userid'=>$UserId,'log_tipe'=>$login,'log_tipe'=>$logout,'log_tipe'=>$create,'log_tipe'=>$update,'log_tipe'=>$delete,'log_tipe'=>$asign,'log_tipe'=>$confirm));  
    }  

    function delete() {
        $log = $this->input->post('item');
                
        foreach($log as $item){
            $this->db->delete('tblog', array('log_id'=>$item));
        }      
    }  



}