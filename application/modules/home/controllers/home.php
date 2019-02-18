<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

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
        $this->load->model('mhome');
        $this->load->library(array('encrypt', 'email', 'session', 'Bcrypt'));
    }
    
	public function index()
	{
        if(isset($this->session->userdata('sc_sess')['UserId'])) {
            $userid = $this->session->userdata('sc_sess')['UserId'];
            $data['role'] = $this->mhome->getRole($userid);
        }   

        /*
        $pass = 'januarsalman124578';
        $hash = $this->bcrypt->hash_password($pass);
        echo $hash;
        */

		$data['title']        =  "Neogeeks";	
        $data['resume']       =  $this->mhome->getResume(); 
        $data['project']      =  $this->mhome->getProject();
        $data['news']         =  $this->mhome->getNews();
        $data['artikel']      =  $this->mhome->getArtikel();
		$this->load->view('home/home', $data);
    }
    
    public function search()
    {
        $find                 = $this->input->GET('destination', TRUE);
        $check_news           = $this->mhome->findNews();
        $check_artikel        = $this->mhome->findArticle();
        $check_resume         = $this->mhome->findResume();
        $check_project        = $this->mhome->findProject();
        
        if($check_news != null){
            $data['title']    = "Detail News";
            $data['news']     = $this->mhome->findNews();
            $data['artikel']  = $this->mhome->getArtikel();
            $data['project']  = $this->mhome->getProject();
            
            $this->session->set_flashdata('pesan', '<div class=\'alert alert-info\' id=\'alert\'>Found featured snippets matching "'.$find.'"</div>'); 
            $this->load->view('portfolio-news', $data);
        }
        elseif($check_artikel != null) {
            $data['title']    = "Detail Article";
            $data['artikel']  = $this->mhome->findArticle();
            $data['project']  = $this->mhome->getProject();
            
            $this->session->set_flashdata('pesan', '<div class=\'alert alert-info\' id=\'alert\'>Found featured snippets matching "'.$find.'"</div>');
            $this->load->view('portfolio-artikel', $data);
        }
        elseif($check_resume != null) {
            if(isset($this->session->userdata('sc_sess')['UserId'])) {
                $userid = $this->session->userdata('sc_sess')['UserId'];

                $data['title']    = "Find Resume";
                $data['resume']   = $this->mhome->findResume();
                $data['project']  = $this->mhome->getProject();
                $data['job']      = $this->mhome->getJob();
                $data['skill']    = $this->mhome->getSkill();
                $data['artikel']  = $this->mhome->getArtikel();
                $data['news']     = $this->mhome->getNews();
                $data['role']     = $this->mhome->getRole($userid);

                $this->session->set_flashdata('pesan', '<div class=\'alert alert-info\' id=\'alert\'>Found featured snippets matching "'.$find.'"</div>');
                $this->load->view('portfolio-cv', $data);
            }
            else {
                $this->session->set_flashdata("regMsg", "<div class=\"alert alert-danger fade in\" id=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&#9679;</a>&nbsp; Can't access. Please login &nbsp;</div>");             
                redirect(base_url());
            }
        }
        elseif($check_project != null) {
            if(isset($this->session->userdata('sc_sess')['UserId'])) {
                $userid = $this->session->userdata('sc_sess')['UserId'];
                
                $data['title']    = "Find Project";
                $data['project']  = $this->mhome->findProject();
                $data['resume']   = $this->mhome->getResume();
                $data['artikel']  = $this->mhome->getArtikel();
                $data['news']     = $this->mhome->getNews();
                $data['role']     = $this->mhome->getRole($userid);

                $this->session->set_flashdata('pesan', '<div class=\'alert alert-info\' id=\'alert\'>Found featured snippets matching "'.$find.'"</div>');
                $this->load->view('portfolio-project', $data);
            }
            else {
                $this->session->set_flashdata("regMsg", "<div class=\"alert alert-danger fade in\" id=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&#9679;</a>&nbsp; Can't access. Please login &nbsp;</div>");             
                redirect(base_url());
            }
        }        
        else {
            $this->session->set_flashdata("regMsg", "<div class=\"alert alert-warning fade in\" id=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&#9679;</a>&nbsp; Data not found &nbsp;</div>");             
            redirect(base_url());
        }
		
    }
    
}
