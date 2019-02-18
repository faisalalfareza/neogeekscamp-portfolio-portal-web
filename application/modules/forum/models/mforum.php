<?php

class Mforum extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function getForum() {   
        $this->db->order_by('ForumId', 'DESC');
        return $this->db->get('tbforum')->result();
    }
    
    function getUser() {
        $this->db->where('UserStatus', 0);
        $this->db->order_by('UserId', 'DESC');
        return $this->db->get('tbuser')->result();
    }
    
    function getProject() {
        $this->db->order_by('ProId', 'DESC');
        return $this->db->get('tbproject')->result();
    }    
    
    function getRole( $id ) {
        $query = $this->db->query("SELECT * from tbrole WHERE RoleId in (SELECT RoleId from tbuser_role where UserId=".$id.")");
        return $query->row();
    }   
    
    function getArtikel() {
        $this->db->order_by('ArtclId', 'DESC');
        return $this->db->get('tbarticle')->result();
    }     

    function getNews() {
        $this->db->order_by('NewsId', 'DESC');
        return $this->db->get('tbnews')->result();
    }        
    
    function record_count() {
        return $this->db->count_all("tbforum");
    }
    
    function fetch_forum( $limit, $start ) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("tbforum");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
    
   function getById( $forumid ) {
        $query =  $this->db->get_where('tbforum', array('ForumId'=>$forumid));
       
        $forum = array();
        foreach ($query->result_array() as $row){

            //$this->db->order_by('CommentCreateDate', 'DESC');
            $comment =  $this->db->get_where('tbcomment', array('ForumId'=>$row['ForumId']));

            $commentarray = array();
            if($this->db->affected_rows()>0){
                
                foreach($comment->result_array() as $subrow){
                    $subtemp = array('CommentId' => $subrow['CommentId'],'CreatedBy' => $subrow['CreatedBy'],'ForumId' => $subrow['ForumId'],'Comment' => $subrow['Comment'],'CommentCreateDate' => $subrow['CommentCreateDate']);
                    array_push($commentarray, $subtemp);
                }
            }

            $temp = array('ForumId' => $row['ForumId'] ,'CreatedBy' => $row['CreatedBy'],'ForumTitle' => $row['ForumTitle'],'ForumDesc' => $row['ForumDesc'],'ForumViewer' => $row['ForumViewer'],'ForumCreateDate' => $row['ForumCreateDate'], 'comment' => $commentarray);
            array_push($forum, $temp);
        }

        return $forum;
    }
    
   function getForumAndComment() {
        $this->db->order_by('ForumId', 'DESC');
        $query =  $this->db->get('tbforum');
            
        $forum = array();
        foreach ($query->result_array() as $row){

            //$this->db->order_by('CommentCreateDate', 'DESC');
            $comment =  $this->db->get_where('tbcomment', array('ForumId'=>$row['ForumId']));

            $commentarray = array();
            if($this->db->affected_rows()>0){
                
                foreach($comment->result_array() as $subrow){
                    $subtemp = array('CommentId' => $subrow['CommentId'],'CreatedBy' => $subrow['CreatedBy'],'ForumId' => $subrow['ForumId'],'Comment' => $subrow['Comment'],'CommentCreateDate' => $subrow['CommentCreateDate']);
                    array_push($commentarray, $subtemp);
                }
            }

            $temp = array('ForumId' => $row['ForumId'] ,'CreatedBy' => $row['CreatedBy'],'ForumTitle' => $row['ForumTitle'],'ForumDesc' => $row['ForumDesc'],'ForumViewer' => $row['ForumViewer'],'ForumCreateDate' => $row['ForumCreateDate'], 'comment' => $commentarray);
            array_push($forum, $temp);
        }

        return $forum;
    }
    
    function addForum( $data )  {
        return $this->db->insert('tbforum', $data);
    }
    
    function updateForum( $data ) {
         $data = array(
            'ForumTitle'    => $this->input->post('ForumTitle'),
            'ForumDesc'     => $this->input->post('ForumDesc')
        );
        
        $this->db->where('ForumId', $this->input->post('ForumId'));
        $this->db->update('tbforum', $data);
    }
    
    function addComment( $data ) {
        return $this->db->insert('tbcomment', $data);
    }
    
    function deleteForum( $id ) {
        return $this->db->delete('tbforum', array('ForumId'=>$id));
    }  
    
    function deleteComment( $id ) {
        return $this->db->delete('tbcomment', array('CommentId'=>$id));
    }
    
    function deleteCommentDetails( $idcomment ) {
        return $this->db->delete('tbcomment', array('CommentId'=>$idcomment));
    }
    
        
    
}