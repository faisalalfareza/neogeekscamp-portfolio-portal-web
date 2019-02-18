<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum extends MX_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    
	public function __construct() {
        parent::__construct(); 
        $this->load->database();
        $this->load->model('mforum');

    }

	public function index()
	{
        if(isset($this->session->userdata('sc_sess')['UserId'])) {
            $Id = $this->session->userdata('sc_sess')['UserId'];
            $data['role'] = $this->mforum->getRole($Id);
        }

        $data['title'] = "Forum Discussion";	
        $data['user'] = $this->mforum->getUser();
        $data['project'] = $this->mforum->getProject();
        $data['artikel'] = $this->mforum->getArtikel();
        $data['news'] = $this->mforum->getNews();
        $data['forum'] = $this->mforum->getForumAndComment();
        $this->load->view('forum/forum-discus', $data);
    }
    
    function create()
	{          		
        $data['title'] = "Forum Discussion";
		$data = array(
            'CreatedBy'            => $this->input->post('CreatedBy'),
            'ForumTitle'         => $this->input->post('ForumTitle'),
            'ForumDesc'         => $this->input->post('ForumDesc'),
            'ForumCreateDate'   => date("Y-m-d H:i:s")
		);
        $data = $this->security->xss_clean($data);
		$this->mforum->addForum($data);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\">Adding Forum Success</div>");
		$this->load->library('user_agent');
  		redirect($this->agent->referrer());
	}
    
    function comment()
	{          		
        $forumid = $this->input->post('ForumComment');  
        $forumid = $this->encrypt->encode($forumid);

        $data['title'] = "Comment";
		$data = array(
        	'CreatedBy'              => $this->input->post('CreatedByComment'),
            'ForumId'             => $this->input->post('ForumComment'),
            'Comment'             => $this->input->post('CommentC'),
            'CommentCreateDate'   => date("Y-m-d H:i:s")
		);
        $data = $this->security->xss_clean($data);
		$this->mforum->addComment($data);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\">Deliver Comment</div>");
		$this->load->view('forum/forum-discus', $data); 
        redirect('forum/forumDetails/'.$forumid);
	} 
    
    function deletefrm() {
        $id = $this->input->post('frmid');
        $this->mforum->deleteForum($id);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-warning\" id=\"alert\">Deleting Forum Success</div>");         
       redirect("forum");
    }
    
    function deleteCom() {
        $id = $this->input->post('CommentId');
        $this->mforum->deleteComment($id);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-warning\" id=\"alert\">Deleting Comment Success</div>");         
       redirect("forum");
    }
    
    public function updateFor(){
  		$data['title'] = "Update Forum";
		$data = array(
            'ForumTitle'         => $this->input->post('ForumTitle'),
            'ForumDesc'         => $this->input->post('ForumDesc'),
            'ForumCreateDate'   => date("Y-m-d H:i:s")
		);
        $data = $this->security->xss_clean($data);
		$this->mforum->updateForum($data);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\">Updateing Forum Success</div>");
		$this->load->library('user_agent');
  		redirect($this->agent->referrer());
    }
    
    public function forumDetails($forumid)
	{
        $forumid = $this->uri->segment(3);
        if(isset($this->session->userdata('sc_sess')['UserId'])) {
            $id = $this->session->userdata('sc_sess')['UserId'];
        }

        $forumid =  $this->encrypt->decode($forumid);
        
        $data['title'] = "Forum Details";
        $data['project'] = $this->mforum->getProject();
        $data['artikel'] = $this->mforum->getArtikel();
        $data['news'] = $this->mforum->getNews();        
        $data['hasil'] = $this->mforum->getById($forumid);
        $data['forum'] = $this->mforum->getForumAndComment();
        
        $this->load->view('forum/forum-details', $data);
    }

    
    function deleteComDetails() {
        $idcomment = $this->input->post('CommentId');
        $this->mforum->deleteCommentDetails($idcomment);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-warning\" id=\"alert\">Deleting Comment Success</div>");         
        $this->load->library('user_agent');
  		redirect($this->agent->referrer());
    }
    
    public function updateForDetails(){
  		$data['title'] = "Update Forum";
		$data = array(
        	'ForumTitle'        => $this->input->post('ForumTitle'),
            'ForumDesc'         => $this->input->post('ForumDesc'),
            'ForumCreateDate'   => date("Y-m-d H:i:s")
		);
        $data = $this->security->xss_clean($data);
		$this->mforum->updateForum($data);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\">Updateing Forum Success</div>");
        $this->load->library('user_agent');
  		redirect($this->agent->referrer());
}
    function commentDetails()
	{          		
        $data['title'] = "Comment";
		$data = array(
        	'CreatedBy'        => $this->input->post('CreatedByComment'),
            'ForumId'         => $this->input->post('ForumComment'),
            'Comment'   => $this->input->post('CommentC'),
            'CommentCreateDate'   => date("Y-m-d H:i:s")
		);
        $data = $this->security->xss_clean($data);
		$this->mforum->addComment($data);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\">Deliver Comment</div>");
		$this->load->library('user_agent');
  		redirect($this->agent->referrer());
	} 
}