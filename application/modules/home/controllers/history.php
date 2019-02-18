<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends MX_Controller {

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
        $this->load->model('mlog');
        $this->load->library(array('encrypt', 'email', 'session', 'Bcrypt'));
    }
    
	public function index()
	{
        if(isset($this->session->userdata('sc_sess')['UserId'])) {
            $userid = $this->session->userdata('sc_sess')['UserId'];
            $data['role']     =  $this->mlog->getRole($userid);
			$data['title']    =  "History";	
	        $data['history']  =  $this->mlog->getLog(); 
			$this->load->view('home/user-history', $data);
		}
		else {
            $this->session->set_flashdata("regMsg", "<div class=\"alert alert-danger fade in\" id=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&#9679;</a>&nbsp; Can't access. Please login &nbsp;</div>");             
            redirect(base_url()); 			
		}
    }

    function clearBrowsingData() {
        $this->mlog->clearBrowsingData();          
        redirect('home/history');
    } 

    function delete() {
        $this->mlog->delete();          
        redirect('home/history');
    }    
    
}
