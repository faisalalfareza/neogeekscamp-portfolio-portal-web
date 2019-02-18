<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Changepassword extends MX_Controller {

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
        $this->load->model('mchangepassword');
    }
    
    public function dec($data) {
        $library =& get_instance();             
        $library->load->library('encrypt');    
        $dec = str_replace(array('-', '_', '~'), array('+', '/', '='), $data);
        $dec = $library->encrypt->decode($dec);
        return $dec;
    }  
    
	public function index()
	{
        $uriemail = $this->input->get('email');
        $email = $this->dec($uriemail);
        
        $data['title'] = "Change Password";	        
        $data['project'] = $this->mchangepassword->getProject();
        $data['email'] = $email;
        $this->load->view('home/change-password', $data);
    }

    public function password()
    {            
        $uriemail = $this->input->get('email');
        $email = $this->dec($uriemail);
        $pass = $this->input->post('UserPass');
        $data['email'] = $email;

		$data = array('UserPass' => $pass);        
        
        $data = $this->security->xss_clean($data);
        $this->mchangepassword->changePassword($data,$email);
        $this->session->set_flashdata("regMsg", "<div class=\"alert alert-success fade in\" id=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&#9679;</a>&nbsp; Success update password &nbsp;</div>");
        redirect("home");		
        
    }
}
