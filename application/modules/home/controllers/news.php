<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MX_Controller {

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
        $this->load->model('mnews');
        $this->load->helper(array('url','form','log'));
    }
    
	public function index()
	{
        if(isset($this->session->userdata('sc_sess')['UserId'])) {
            $userid = $this->session->userdata('sc_sess')['UserId'];
            $data['role'] = $this->mnews->getRole($userid);
        } 
            
        $data['title']        =  "Latest News";
        $data['news']         =  $this->mnews->getNews();
        $data['project']      =  $this->mnews->getProject();
        $data['artikel']      =  $this->mnews->getArtikel();
        $this->load->view('home/portfolio-news', $data);           
    } 

    public function detailnews($id)
    {
        if(isset($this->session->userdata('sc_sess')['UserId'])) {
            $userid = $this->session->userdata('sc_sess')['UserId'];
            $data['role'] = $this->mnews->getRole($userid);
        }      

        $id =  $this->encrypt->decode($id);
        
        $head['NewsTitle']    =  $this->mnews->NewsTitle($id)->row();
        $data['title']        =  $head['NewsTitle']->NewsTitle;
        $data['news']         =  $this->mnews->detailnews($id);
        $data['project']      =  $this->mnews->getProject();
        $data['dettitle']     =  $this->mnews->getByTitle($id);
        $data['artikel']      =  $this->mnews->getArtikel();
        $this->load->view('home/portfolio-news', $data); 
    }   

    function create()
    {               
        //upload
        $config['upload_path']          = 'assets/images/news/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2400;
        $config['max_width']            = 1200;
        $config['max_height']           = 1200;
        $config['min_width']            = 165;
        $config['min_height']           = 114;
        $config['file_name']            = 'news-'.trim(str_replace(" ","",date('dmYHisu')));

        $this->load->library('upload', $config);
        $upload_img = $this->upload->do_upload('NewsImage');    
    
        if(!$upload_img){
            
            $photo = $this->upload->data();
            $data = array(
                'NewsTitle'       => $this->input->post('NewsTitle'),
                'NewsContent'     => $this->input->post('NewsContent'),
                'NewsImage'       => null,
                'CreatedOn'       =>  date("Y-m-d H:i:s"),  
                'CreatedBy'       => $this->input->post('CreatedBy')
            );
        }elseif($upload_img){

            $photo = $this->upload->data();
            $data = array(
                'NewsTitle'       => $this->input->post('NewsTitle'),
                'NewsContent'     => $this->input->post('NewsContent'),
                'NewsImage'       => base_img().'news/'.$photo['file_name'],
                'CreatedOn'       =>  date("Y-m-d H:i:s"),
                'CreatedBy'       => $this->input->post('CreatedBy')
            );
        }
         
        $data = $this->security->xss_clean($data);
        $this->mnews->add_record($data);

        helper_log("add", "add '".$this->input->post('NewsTitle')."' to news");
        redirect('home/news');
    }    
  
    function updatenews()
    {
        //upload
        $config['upload_path']          = 'assets/images/news/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2400;
        $config['max_width']            = 1200;
        $config['max_height']           = 1200;
        $config['min_width']            = 165;
        $config['min_height']           = 114;
        $config['file_name']            = 'news-'.trim(str_replace(" ","",date('dmYHisu')));

        $this->load->library('upload', $config);
        $upload_img = $this->upload->do_upload('uNewsImage');
        $img = $this->input->post('uNewsImage');        

        var_dump($upload_img);
        var_dump($img);
        var_dump($config);

        if(!$upload_img){
            $photo = $this->upload->data();
            $data = array(
                'NewsTitle'   =>  $this->input->post('NewsTitle'),
                'NewsContent' =>  $this->input->post('NewsContent'),
            );
        }elseif($upload_img){
              $photo = $this->upload->data();
              $data = array(
                'NewsTitle'   =>  $this->input->post('NewsTitle'),
                'NewsContent' =>  $this->input->post('NewsContent'),
                'NewsImage'   =>  base_img().'news/'.$photo['file_name']
            );

        }

        $data = $this->security->xss_clean($data);
        $this->mnews->updatenews($data);
        helper_log("update", "updating news '".$this->input->post('NewsTitle')."'");

        $this->load->library('user_agent');
        redirect($this->agent->referrer());
    }  

    function delete($id) {
        $newstitle = $this->mnews->NewsTitle($id)->result();
        helper_log("delete", "deleting news '".$newstitle[0]->NewsTitle."'");

        $this->mnews->delete($id);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-warning\" id=\"alert\">Deleting News Success</div>");     
        redirect('home/news');
    }  

}
