<?php

class Martikel extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    public function checking( $data ) {
        return $this->db->get_where('tbarticle', $data); 
    }
    
    function get_records() {
        return $this->db->get('tbarticle')->result();
    }

    function detailarticle( $id ) {
        $this->db->where('ArtclId', $id);
        return $this->db->get('tbarticle')->result();
    }    

    function add_record( $data ) {
        return $this->db->insert('tbarticle', $data);
    }    

    function add_category( $data ) {
        return $this->db->insert('tbcategory', $data);
    }            

    function updatearticle( $data ) {
        $this->db->where('ArtclId', $this->input->post('ArtclId'));
        $this->db->update('tbarticle', $data);
    }   

    function add_to_category() {
        $artcltype = $this->input->post('ArtclType');
        $artclid = $this->db->insert_id();
        foreach($artcltype as $item){                
            $category = array(
                'ArtclId'        => $artclid,
                'CategoryName'   => $item
            );    
             $this->db->insert('tbcategory', $category);
        }             
    } 

    function getArtikel() {
        $this->db->order_by('ArtclId', 'DESC');
        return $this->db->get('tbarticle')->result();
    }

    function ArticleTitle( $id ) {
        $this->db->select('ArtclTitle');
        return $this->db->get_where('tbarticle', array('ArtclId'=>$id));
    }     

    function getListType() {
        $this->db->distinct();
        $this->db->select('ArtclType');
        $this->db->order_by('ArtclId', 'DESC');
        return $this->db->get('tbarticle')->result();
    }            

    function getNews() {
        $this->db->order_by('NewsId', 'DESC');
        return $this->db->get('tbnews')->result();
    }        

    function getProject() {
        $this->db->order_by('ProId', 'DESC');
        return $this->db->get('tbproject')->result();
    }  

    function getCategory() {        
        $this->db->distinct();
        $this->db->select('CategoryName');
        $this->db->order_by('CategoryId', 'DESC');
        return $this->db->get('tbcategory')->result();
    }            

    function getRole( $userid ) {
        $getRole = "SELECT * from tbrole WHERE RoleId in (SELECT RoleId FROM tbuser_role WHERE UserId=?)";
        $query = $this->db->query($getRole, array($userid));
        return $query->row();
    }      

    function getByTitle( $id ) {
        return $this->db->get_where('tbarticle', array('ArtclId' => $id))->row();
    }   

    function delete( $id ) {
        return $this->db->delete('tbarticle', array('ArtclId'=>$id));
    }

     function getArtclAndComment() {
        $this->db->order_by('ArtclId', 'DESC');
        $query =  $this->db->get('tbarticle'); 

        $article = array();
        foreach ($query->result_array() as $row){

            $this->db->where('ArtclId', $row['ArtclId']);
            $this->db->order_by('CommentArticleCreateDate', 'DESC');
            $this->db->limit(3);

            $comment =  $this->db->get('tbcomment_article');

            $commentarray = array();
            if($this->db->affected_rows()>0){
                
                foreach($comment->result_array() as $subrow){
                    $subtemp = array('CommentArticleId' => $subrow['CommentArticleId'],'CreatedBy' => $subrow['CreatedBy'],'ArtclId' => $subrow['ArtclId'],'CommentArticle' => $subrow['CommentArticle'],'CommentArticleCreateDate' => $subrow['CommentArticleCreateDate']);
                    array_push($commentarray, $subtemp);
                }
            }

            $temp = array('ArtclId' => $row['ArtclId'] ,'CreatedBy' => $row['CreatedBy'],'ArtclTitle' => $row['ArtclTitle'],'ArtclContent' => $row['ArtclContent'],'ArtclType' => $row['ArtclType'],'ArtclImage' => $row['ArtclImage'],'CreatedOn' => $row['CreatedOn'], 'comment' => $commentarray);
            array_push($article, $temp);
        }

        return $article;
    }

    function getArtclAndCommentDetail($id) {
        $this->db->order_by('ArtclId', 'DESC');
        $this->db->where('ArtclId', $id);
        $query =  $this->db->get('tbarticle');
            
        $article = array();
        foreach ($query->result_array() as $row){

            $this->db->where('ArtclId', $row['ArtclId']);
            $this->db->order_by('CommentArticleCreateDate', 'DESC');
            $comment =  $this->db->get('tbcomment_article');

            $commentarray = array();
            if($this->db->affected_rows()>0){
                
                foreach($comment->result_array() as $subrow){
                    $subtemp = array('CommentArticleId' => $subrow['CommentArticleId'],'CreatedBy' => $subrow['CreatedBy'],'ArtclId' => $subrow['ArtclId'],'CommentArticle' => $subrow['CommentArticle'],'CommentArticleCreateDate' => $subrow['CommentArticleCreateDate']);
                    array_push($commentarray, $subtemp);
                }
            }

            $temp = array('ArtclId' => $row['ArtclId'] ,'CreatedBy' => $row['CreatedBy'],'ArtclTitle' => $row['ArtclTitle'],'ArtclContent' => $row['ArtclContent'],'ArtclType' => $row['ArtclType'],'ArtclImage' => $row['ArtclImage'],'CreatedOn' => $row['CreatedOn'], 'comment' => $commentarray);
            array_push($article, $temp);
        }

        return $article;
    }

    function addCommentArtcl( $data ) {
        return $this->db->insert('tbcomment_article', $data);
    }

    function deleteCommentArtcl( $id ) {
        return $this->db->delete('tbcomment_article', array('CommentArticleId'=>$id));
    }        
    
}