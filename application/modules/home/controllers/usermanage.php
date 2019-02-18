<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermanage extends MX_Controller {

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
        $this->load->model('muser');
    }

    public function enc($data) {    
        $library =& get_instance();
        $library->load->library('encrypt');    
        $enc = $library->encrypt->encode($data);
        $enc = str_replace(array('+', '/', '='), array('-', '_', '~'), $enc);
        return $enc;
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
        if(isset($this->session->userdata('sc_sess')['UserId'])) {
            $userid                  =  $this->session->userdata('sc_sess')['UserId'];
            $data['role']            =  $this->muser->getRole($userid);
            
            if($data['role']->RoleId == 1) {
                $data['title']       =  "User Manager";	
                $data['nonactive']   =  $this->muser->getUserNonActive();
                $data['active']      =  $this->muser->getUserActive();

                $data['result'] = array();

                foreach($data['active'] as $active) {
                    $id = $active->UserId;
            $getRole = "SELECT * from tbrole WHERE RoleId in (SELECT RoleId FROM tbuser_role WHERE UserId=?)";
            $query = $this->db->query($getRole, array($id));
                    $result  =  $query->result();
                    
                    array_push($data['result'], array(
                        'RoleId'  => $result[0]->RoleId, 
                        'RoleName'=> $result[0]->RoleName
                        )
                    );
                }
                
                $data['project']     =  $this->muser->getProject();
                $data['news']        =  $this->muser->getNews();
                $this->load->view('home/user-manager', $data);
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

    function activate( $id , $email ) {
        $useremail = $this->uri->segment(5);
        $unique = $this->muser->checking_unique($email);
        if ($email = $unique) {   

            $config = array(
                'charset'       => 'utf-8',
                'useragent'     => 'Codeigniter',
                'protocol'      => "smtp",
                'mailtype'      => "html",
                'smtp_host'     => "ssl://smtp.gmail.com", //pengaturan smtp
                'smtp_port'     => 465,
                'smtp_timeout'  => 400,
                'smtp_user'     => "mumiichaell@gmail.com", // isi dengan email kamu
                'smtp_pass'     => "muhammad16111997", // isi dengan password kamu
                'crlf'          => "\r\n",  
                'wordwrap'      => TRUE            
            );
        
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");

            //memanggil library email dan set konfigurasi untuk pengiriman email
            $this->email->initialize($config);

            //konfigurasi pengiriman
            $this->email->from($config['smtp_user']);
            $this->email->to($this->uri->segment(5));
            $this->email->subject("[Neogeeks] New Account");
            $this->email->message("Your Email is activated , you can Login now <br>").
            site_url("home");

            if (!$this->email->send())
            {
                $this->session->set_flashdata("regMsg", "<div class=\"alert alert-danger fade in\" id=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&#9679;</a>&nbsp; Send link failed &nbsp;</div>");
                    
            }else { 
                $this->session->set_flashdata("regMsg", "<div class=\"alert alert-success fade in\" id=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&#9679;</a>&nbsp; Send Link Succsess &nbsp;</div>");
                $this->muser->activate($id);
                $this->load->library('user_agent');
                redirect($this->agent->referrer());
            }              
        }else{
             $this->session->set_flashdata("regMsg", "<div class=\"alert alert-warning fade in\" id=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&#9679;</a>&nbsp; Incorrect email &nbsp;</div>");
             redirect(base_url());
            }
    }	

    function activate_group() {
        $this->muser->activate_group();          
        redirect('home/usermanage');
    }
    
    function deactivate( $id , $email ) {
        $useremail = $this->uri->segment(5);
        $unique = $this->muser->checking_unique($email);
        if ($email = $unique) {

            $config = array(
                'charset'       => 'utf-8',
                'useragent'     => 'Codeigniter',
                'protocol'      => "smtp",
                'mailtype'      => "html",
                'smtp_host'     => "ssl://smtp.gmail.com", //pengaturan smtp
                'smtp_port'     => 465,
                'smtp_timeout'  => 400,
                'smtp_user'     => "mumiichaell@gmail.com", // isi dengan email kamu
                'smtp_pass'     => "muhammad16111997", // isi dengan password kamu
                'crlf'          => "\r\n",  
                'wordwrap'      => TRUE            
            );
        
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");

            //memanggil library email dan set konfigurasi untuk pengiriman email
            $this->email->initialize($config);

            //konfigurasi pengiriman
            $this->email->from($config['smtp_user']);
            $this->email->to($useremail);
            $this->email->subject("[Neogeeks] New Account");
            $this->email->message("Your Email is deactivated <br>").
            site_url("home");

            if (!$this->email->send())
            {
                $this->session->set_flashdata("regMsg", "<div class=\"alert alert-danger fade in\" id=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&#9679;</a>&nbsp; Send link failed &nbsp;</div>");
                    
            }else { 
                $this->session->set_flashdata("regMsg", "<div class=\"alert alert-success fade in\" id=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&#9679;</a>&nbsp; Send Link Succsess &nbsp;</div>");
                $this->muser->deactivate($id);
                $this->load->library('user_agent');
                redirect($this->agent->referrer());
            }              
        }else{
             $this->session->set_flashdata("regMsg", "<div class=\"alert alert-warning fade in\" id=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&#9679;</a>&nbsp; Incorrect email &nbsp;</div>");
             redirect(base_url());
            }
    }	

    function deactivate_group() {
        $this->muser->deactivate_group();          
        redirect('home/usermanage');
    }    
    
    function grant_as_admin( $id , $email ) {
        $useremail = $this->uri->segment(5);
        $unique = $this->muser->checking_unique($email);
        if ($email = $unique) {

            $config = array(
                'charset'       => 'utf-8',
                'useragent'     => 'Codeigniter',
                'protocol'      => "smtp",
                'mailtype'      => "html",
                'smtp_host'     => "ssl://smtp.gmail.com", //pengaturan smtp
                'smtp_port'     => 465,
                'smtp_timeout'  => 400,
                'smtp_user'     => "mumiichaell@gmail.com", // isi dengan email kamu
                'smtp_pass'     => "muhammad16111997", // isi dengan password kamu
                'crlf'          => "\r\n",  
                'wordwrap'      => TRUE            
            );
        
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");

            //memanggil library email dan set konfigurasi untuk pengiriman email
            $this->email->initialize($config);

            //konfigurasi pengiriman
            $this->email->from($config['smtp_user']);
            $this->email->to($useremail);
            $this->email->subject("[Neogeeks] New Account");
            $this->email->message("Your Email is granted to admin access <br>").
            site_url("home");

            if (!$this->email->send())
            {
                $this->session->set_flashdata("regMsg", "<div class=\"alert alert-danger fade in\" id=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&#9679;</a>&nbsp; Send link failed &nbsp;</div>");
                    
            }else { 
                $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\">Granting admin access succees</div>");
                $this->muser->grant_as_admin($id); 
                $this->load->library('user_agent');
                redirect($this->agent->referrer());
            }              
        }else{
             $this->session->set_flashdata("regMsg", "<div class=\"alert alert-warning fade in\" id=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&#9679;</a>&nbsp; Incorrect email &nbsp;</div>");
            redirect(base_url());
            }
    }    
    
    function revoke_as_admin( $id , $email ) {
        $useremail = $this->uri->segment(5);
        $unique = $this->muser->checking_unique($email);
        if ($email = $unique) {

            $config = array(
                'charset'       => 'utf-8',
                'useragent'     => 'Codeigniter',
                'protocol'      => "smtp",
                'mailtype'      => "html",
                'smtp_host'     => "ssl://smtp.gmail.com", //pengaturan smtp
                'smtp_port'     => 465,
                'smtp_timeout'  => 400,
                'smtp_user'     => "mumiichaell@gmail.com", // isi dengan email kamu
                'smtp_pass'     => "muhammad16111997", // isi dengan password kamu
                'crlf'          => "\r\n",  
                'wordwrap'      => TRUE            
            );
        
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");

            //memanggil library email dan set konfigurasi untuk pengiriman email
            $this->email->initialize($config);

            //konfigurasi pengiriman
            $this->email->from($config['smtp_user']);
            $this->email->to($useremail);
            $this->email->subject("[Neogeeks] New Account");
            $this->email->message("Admin access on your account has been revoked. Now you are back to being a regular user <br>").
            site_url("home");

            if (!$this->email->send())
            {
                $this->session->set_flashdata("regMsg", "<div class=\"alert alert-danger fade in\" id=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&#9679;</a>&nbsp; Send link failed &nbsp;</div>");
                    
            }else { 
                $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\">Revoke admin access succees</div>");
                $this->muser->revoke_as_admin($id); 
                $this->load->library('user_agent');
                redirect($this->agent->referrer());
            }              
        }else{
             $this->session->set_flashdata("regMsg", "<div class=\"alert alert-warning fade in\" id=\"alert\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&#9679;</a>&nbsp; Incorrect email &nbsp;</div>");
            redirect(base_url());
            }
    }    

    function delete($id) {
        $this->muser->delete($id);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-warning\" id=\"alert\">Deleting User Success</div>");        
        redirect("home/usermanage");
    }      
    
}
