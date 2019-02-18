<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel extends MX_Controller {

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
        $this->load->model('martikel');
        $this->load->helper(array('url','form','log'));
    }
    
	public function index()
	{   
        if(isset($this->session->userdata('sc_sess')['UserId'])) {
            $userid = $this->session->userdata('sc_sess')['UserId'];
            $data['role']  = $this->martikel->getRole($userid);
        }        
        
        $data['title']     =  "Collection Article";
        $data['project']   =  $this->martikel->getProject();
        $data['artikel']   =  $this->martikel->getArtikel();
        $data['artcl']     =  $this->martikel->getArtclAndComment();
        $data['listtype']  =  $this->martikel->getListType();
        $data['news']      =  $this->martikel->getNews();
        $data['category']  =  $this->martikel->getCategory();     
        $this->load->view('home/portfolio-artikel', $data);
    } 
    
    public function detailarticle($id)
	{   
        if(isset($this->session->userdata('sc_sess')['UserId'])) {
            $userid = $this->session->userdata('sc_sess')['UserId'];
            $data['role']  =  $this->martikel->getRole($userid);
        }   
        
        $id =  $this->encrypt->decode($id);

        $head['ArtclTitle'] =  $this->martikel->ArticleTitle($id)->row();
        $data['title']      =  $head['ArtclTitle']->ArtclTitle;
        $data['project']    =  $this->martikel->getProject();
        $data['dettitle']   =  $this->martikel->getByTitle($id);
        $data['artikel']    =  $this->martikel->detailarticle($id);
        $data['artcl']      =  $this->martikel->getArtclAndCommentDetail($id);   
        $data['news']       =  $this->martikel->getNews();   
        $data['category']   =  $this->martikel->getCategory();     
        $this->load->view('home/portfolio-artikel', $data); 
    }      

    function create()
    {      
        //upload
        $config['upload_path']          = 'assets/images/article/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2400;
        $config['max_width']            = 1200;
        $config['max_height']           = 1200;
        $config['min_width']            = 165;
        $config['min_height']           = 114;
        $config['file_name']            = 'article-'.trim(str_replace(" ","",date('dmYHisu')));

        $this->load->library('upload', $config);
        $upload_img = $this->upload->do_upload('ArticleImage');    

        if(!$upload_img){

            $photo = $this->upload->data();
            $data = array(
                'ArtclTitle'   =>  $this->input->post('ArtclTitle'),
                'ArtclContent' =>  $this->input->post('ArtclContent'),
                'ArtclType'    =>  serialize($this->input->post('ArtclType')),
                'ArtclImage'   =>  null,          
                'CreatedOn'    =>  date("Y-m-d H:i:s"),
                'CreatedBy'    =>  $this->input->post('CreatedBy')
            );
        }
        elseif($upload_img){

            $photo = $this->upload->data();
            $data = array(
                'ArtclTitle'   =>  $this->input->post('ArtclTitle'),
                'ArtclContent' =>  $this->input->post('ArtclContent'),
                'ArtclType'    =>  serialize($this->input->post('ArtclType')),
                'ArtclImage'   =>  base_img().'article/'.$photo['file_name'],          
                'CreatedOn'    =>  date("l, d M Y"),
                'CreatedBy'    =>  $this->input->post('CreatedBy')
            );
        }    
        $data = $this->security->xss_clean($data);
        $this->martikel->add_record($data);

        helper_log("add", "adding '".$this->input->post('ArtclTitle')."' to collection article");
        redirect('home/artikel');
    }         

    function category()
    { 
        $data = array(
            'CategoryName'   =>  $this->input->post('CategoryName')
        );
        $data = $this->security->xss_clean($data);
        $this->martikel->add_category($data);

        helper_log("add", "adding '".$this->input->post('CategoryName')."' to list category of article"); 
        $this->load->view('home', $data); 
        redirect('home/artikel');        
    }

    function comment_artcl()
    {   
        $artclid = $this->input->post('ArtclId');  
        $artclid = $this->encrypt->encode($artclid);               

        $data['title'] = "Comment Article";
        $data = array(
            'CreatedBy'                  => $this->input->post('CreatedBy'),
            'ArtclId'                    => $this->input->post('ArtclId'),
            'CommentArticle'             => $this->input->post('CommentArticle'),
            'CommentArticleCreateDate'   => date("Y-m-d H:i:s")
        );
  
        $this->martikel->addCommentArtcl($data);
        
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\">Deliver Comment</div>");
     
        redirect('home/artikel/detailarticle/'.$artclid);
    }

    function deleteCommentArtcl() {
        $id = $this->input->post('CommentArticleId');
        $this->martikel->deleteCommentArtcl($id);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-warning\" id=\"alert\">Deleting Comment Success</div>");         
        $this->load->library('user_agent');
        redirect($this->agent->referrer());
    }             

    function updatearticle()
    {
        //upload
        $config['upload_path']          = 'assets/images/article/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2400;
        $config['max_width']            = 1200;
        $config['max_height']           = 1200;
        $config['min_width']            = 165;
        $config['min_height']           = 114;
        $config['file_name']            = 'article-'.trim(str_replace(" ","",date('dmYHisu')));

        $this->load->library('upload', $config);
        $upload_img = $this->upload->do_upload('uArticleImage');    
    
        if(!$upload_img){
            
            $photo = $this->upload->data();
            $data = array(
                'ArtclTitle'   =>  $this->input->post('ArtclTitle'),
                'ArtclContent' =>  $this->input->post('ArtclContent'),
            );
        }elseif($upload_img){
              $photo = $this->upload->data();
              $data = array(
                'ArtclTitle'   =>  $this->input->post('ArtclTitle'),
                'ArtclContent' =>  $this->input->post('ArtclContent'),
                'ArtclImage'   =>  base_img().'article/'.$photo['file_name']
            );
        }  
        
        $data = $this->security->xss_clean($data);
        $this->martikel->updatearticle($data);

        helper_log("update", "updating article '".$this->input->post('uArtclTitle')."'");
        $this->load->library('user_agent');
        redirect($this->agent->referrer());
    }    
    
    function delete($id) 
    {
        $artcltitle = $this->martikel->ArticleTitle($id)->result();
        helper_log("delete", "deleting article '".$ArticleTitle[0]->ArtclTitle."'");

        $this->martikel->delete($id);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-warning\" id=\"alert\">Deleting Article Success</div>");     
        redirect('home/artikel');
    }      
    
}
