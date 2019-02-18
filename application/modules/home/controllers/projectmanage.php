<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projectmanage extends MX_Controller {

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
        $this->load->model('mprojectmanage');
    }
    
	public function index()
	{
        if(isset($this->session->userdata('sc_sess')['UserId'])) { 
            $userid                  =  $this->session->userdata('sc_sess')['UserId'];
            $data['role']            =  $this->mprojectmanage->getRole($userid);
            $ProId = $this->input->post('ProId');
            
            if($data['role']->RoleId == 1) {
                $data['title']       =  "Project Manager";	
                $data['nonactive']   =  $this->mprojectmanage->getProjectNonActive();
                $data['active']      =  $this->mprojectmanage->getProjectActive();
                $data['project']     =  $this->mprojectmanage->getProject();
                $data['news']        =  $this->mprojectmanage->getNews();
                $this->load->view('home/project-manager', $data);
            }
            else {
                $this->session->set_flashdata("regMsg", "<div class=\"alert alert-danger fade in\" id=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&#9679;</a>&nbsp; Can't access. Must be admin &nbsp;</div>");              
                redirect(base_url());                
            }
        }
        else {
            $this->session->set_flashdata("regMsg", "<div class=\"alert alert-danger fade in\" id=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&#9679;</a>&nbsp; Can't access. Please login &nbsp;</div>");              
            redirect(base_url());
        }          
    }

    function activate($ProId) {
        $this->mprojectmanage->activate($ProId);          
        redirect('home/projectmanage');
    }	

    function activate_group() {
        $this->mprojectmanage->activate_group();          
        redirect('home/projectmanage');
    }
    
    function deactivate($ProId) {
        $this->mprojectmanage->deactivate($ProId);          
        redirect('home/projectmanage');
    }	

    function deactivate_group() {
        $this->mprojectmanage->deactivate_group();          
        redirect('home/projectmanage');
    }    
   
    function delete($ProId) {
        $this->mprojectmanage->delete($ProId);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-warning\" id=\"alert\">Deleting Project Success</div>");        
        redirect("home/projectmanage");
    }      
    
}
