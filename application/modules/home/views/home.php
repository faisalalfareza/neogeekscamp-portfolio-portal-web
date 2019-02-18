<!DOCTYPE html>
<html>
   <head>
      <title><?=$title?> | Innovation Center</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <meta name="description" content="Neogeeks Portofolio" />
      <meta name="author" content="MIS Visionet" />
      <link rel="shortcut icon" type="image/x-icon" href="<?=base_img()."logo2.png"?>" >
       
        <!-- URL Theme Color untuk Chrome, Firefox OS, Opera dan Vivaldi -->
        <meta name="theme-color" content="#fff" />
        <!-- URL Theme Color untuk Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#fff" />
        <!-- URL Theme Color untuk iOS Safari -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="#fff" />        
       
      <link href="<?=base_css()."bootstrap.min.css"?>" rel="stylesheet" />
      <link href="<?=base_css()."bootstrap-select.min.css"?>" rel="stylesheet">
      <link href="<?=base_css()."font-awesome.min.css"?>" rel="stylesheet">        
      <link href="<?=base_css()."screen.css"?>" rel="stylesheet" />
      <link href="<?=base_css()."main.css"?>" rel="stylesheet" />    
      <link href="<?=base_css()."ripples.min.css"?>" rel="stylesheet">
      <link href="<?=base_css()."snackbar.min.css"?>" rel="stylesheet"> 
	    <link href="<?=base_css()."main.css"?>" rel="stylesheet">
	    <link href="<?=base_css()."responsive.css"?>" rel="stylesheet">
      <link href="<?=base_css()."owl.carousel/owl.transitions.css"?>" rel="stylesheet">
      <link href="<?=base_css()."owl.carousel/owl.carousel.css"?>" rel="stylesheet">
      <link href="<?=base_css()."owl.carousel/owl.theme.css"?>" rel="stylesheet">       
       
   </head>
   <body class="home" id="page">
      <!-- Header -->
      <header class="main-header">
         <div class="container">
            <div class="header-content">
               <a>
                   <img src="<?= base_img()."neogeeks.png" ?>" width="160px" height="180px">
               </a>                
                
               <nav class="site-nav">
                  <ul class="clean-list site-links">
                      <?php
                      if(isset($this->session->userdata('sc_sess')['UserId'])) {
                        $UserEmail = $this->session->userdata('sc_sess')['UserEmail'];
                        $UserEmail = substr($UserEmail, strpos($UserEmail,"<")+0, strrpos($UserEmail, "@")-strpos($UserEmail,"<")-0);  
                        $UserId = $this->session->userdata('sc_sess')['UserId'];
                        $Remember = $this->session->userdata('sc_sess')['Remember'];  
                      ?>                   
                      <div class="btn-group">
                      <a href="<?=site_url('home/history')?>" class="btn btn-white"><?=$UserEmail?></a>
                      <a href="<?=site_url('auth/logout')?>" class="btn btn-grey"><i class="fa fa-power-off"></i></a>
                      </div>      
                      <?php
                      } else {
                      ?>                      
                      <a id="modal_trigger" href="javascript:void(0)" data-backdrop="false" class="btn btn-green openLogin">Masuk</a>   
                      <a id="modal_trigger" href="javascript:void(0)" class="btn btn-white openRegister">Gabung Disini</a>  
                      <div class="alert-top">
                          <?=$this->session->flashdata('regMsg')?>
                      </div>
                      <?php
                      }         
                      ?>
                  </ul>     
               </nav>
                
                
            </div>
         </div>
      </header>
       
      <!-- Main Content -->
      <div class="content-box">
         <!-- Hero Section -->
         <section class="section section-hero">
            <div class="hero-box">
               <div class="container">
                  <div class="hero-text align-center">
                     <h1>Showcase Your Experience & Discover Creative Work</h1>
                     <p>The safest and easiest way for people to connect and collaborate with members, students, and each other</p>      
                  </div>
                   
                  <form action="home/search" method="get" class="destinations-form">
                     <div class="input-line">
                        <input type="text" name="destination" class="form-input check-value" placeholder="Find resume, project, or the latest news articles .." />
                        <button type="submit" name="destination-submit" class="form-submit btn btn-special">Find</button>
                     </div>
                  </form>            
               </div>
            </div>
         </section>

         <!-- Destinations Section -->
         <section class="section section-destination">
            <!-- Title -->
            <div class="section-title">
               <div class="container">
                  <h2 class="title">Collection Resume</h2>
                  <p class="sub-title">Jelajahi daftar terpilih untuk riwayat pendidikan terbaik, kemampuan & pengalaman di sekitar anda, berdasarkan tren</p>
               </div>
            </div>

            <!-- Content -->
            <div class="container">    
               <div class="row">            
                <?php
                   $i = 0;
                   foreach($resume as $getResume) {
                ?>
                  <div class="col-md-8 col-sm-12 col-xs-24">
                     <div class="destination-box">
                        <div class="box-cover">
                           <a href="<?=site_url('home/resume/cvDetails/'.$this->encrypt->encode($getResume->RsumId))?>">
                            <?php if ($getResume->RsumImage != null) {?>
                                <img src="<?=$getResume->RsumImage?>" class="img-responsive" alt="">
                            <?php } else { ?>
                                <img src="<?= base_img()."4.jpg" ?>" class="img-responsive" alt="">
                            <?php } ?>
                           </a>
                        </div>

                        <span class="boats-qty"><?=$getResume->RsumJob?></span>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="city"><?=$getResume->RsumName?></h4>
                              <p class="country">Focus on <?=$getResume->RsumSkill1?> <?=$getResume->RsumSkill2?> <?=$getResume->RsumSkill3?> <?=$getResume->RsumSkill4?> <?=$getResume->RsumSkill5?> and i'm graduate from <?=$getResume->LastEducation1?></p>
                           </div>
                        </div>
                     </div>
                  </div> 
                <?php
                    if (++$i == 2) break;
                   }
                ?>
                   
                  <div class="col-md-8 col-sm-12 col-xs-24">
                    <?php
                      if(isset($this->session->userdata('sc_sess')['UserId'])) {
                        if($role->RoleId == 1) {
                    ?>                  
                    <div class="sidebar content-box left-box" style="display: block;">
                        <ul class="nav">
                            <!-- Main menu -->
                            <li><a href="<?=site_url('home/usermanage')?>"><img src="<?=base_img()."icon/pie-chart.png"?>"> &nbsp; Users Manager</a></li>    
                            <li><a href="<?=site_url('home/projectmanage')?>"><img src="<?=base_img()."icon/briefcase.png"?>"> &nbsp; Projects Manager</a></li>                        
                        </ul>
                    </div>       
                    <?php
                        }
                      }        
                    ?>   

                    <div class="sidebar content-box left-box" style="display: block;">
                        <ul class="nav">
                            <!-- Main menu -->
                            <?php
                              if(isset($this->session->userdata('sc_sess')['UserId'])) {
                            ?>

                            <li><a href="<?=site_url('home/resume')?>"><img src="<?=base_img()."icon/file-1.png"?>"> &nbsp; Curriculum Vitae</a></li>    
                            
                            <li><a href="<?=site_url('home/project')?>"><img src="<?=base_img()."icon/briefcase-1.png"?>"> &nbsp; Collection Projects</a></li>    

                            <?php
                              }        
                            ?>                       
                            
                            <li><a href="<?=site_url('forum')?>"><img src="<?=base_img()."icon/telemarketer.png"?>"> &nbsp; Forum Discussion</a></li>   
                            <li><a href="<?=site_url('home/artikel')?>"><img src="<?=base_img()."icon/list-project.png"?>"> &nbsp; Collection Articles</a></li>                              
                            <li><a href="<?=site_url('home/news')?>"><img src="<?=base_img()."icon/megaphone.png"?>"> &nbsp; Latest News</a></li>
                            
                        </ul>
                    </div>
                  </div>                                     
               </div>
            </div>
         </section>                     
      </div>

     <!-- Parallax Box -->
     <div class="parallax-box">
         <div class="container-list">

                <div class="col-lg-12 padding-none"> 
                     <div class="slide-text news">
                      <h3>Highlight News</h3>
                        <div class="slide-news">
                            <?php
                                $i = 0;
                                foreach($news as $getNews){
                                $getContent = strip_tags($getNews->NewsContent);
                                if (strlen($getContent) > 250) {
                                    // truncate string
                                    $stringCut = substr($getContent, 0, 250);
                                    $getContent = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
                                }
                            ?>
                            <a href="<?=site_url('home/news/detailnews/'.$this->encrypt->encode($getNews->NewsId))?>" class="single-news first">
                                <h1><?=$getNews->NewsTitle?></h1>
                                <p><?=$getContent?></p>
                            </a> 
                            <?php
                                if (++$i == 5) break;
                                }
                            ?>                                
                        </div>
                    </div>                                  
                </div>
                <div class="col-lg-12 padding-none">
                     <div class="slide-text artikel">
                     <h3>Collection Articles</h3>
                        <div class="slide-news">
                            <?php
                                $i = 0;
                                foreach($artikel as $getArtikel){
                                $getContent = strip_tags($getArtikel->ArtclContent);
                                if (strlen($getContent) > 250) {
                                    // truncate string
                                    $stringCut = substr($getContent, 0, 250);
                                    $getContent = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
                                }
                            ?>
                            <a href="<?=site_url('home/artikel/detailarticle/'.$this->encrypt->encode($getArtikel->ArtclId))?>" class="single-news first">
                                <h1><?=$getArtikel->ArtclTitle?></h1>
                                <p><?=$getContent?></p>
                            </a> 
                            <?php
                                if (++$i == 5) break;
                                }
                            ?>                                
                        </div>
                    </div>                                  
                </div>              
    
        </div>
      </div>      
       
      <?php $this->load->view('form/fauth'); ?>
      <?php $this->load->view('form/fpost'); ?>
      <?php $this->load->view('general/ekstern/foot'); ?> 
       
        <!-- Custom Javascript -->
        <script type="text/javascript" src="<?=base_js()."page/home.js"?>" ></script>
        <!-- End Custom Javascript -->       
  
        <script type="text/javascript">
          $(document).ready(function () {    
              $(function(){
                $.material.init();
                $('.modal-dialog').draggable(); 
                $('input[data-toggle="popover"]').popover({
                    placement: 'top', trigger: 'focus'
                });
              });   

              //minimum 8 characters
              var bad = /(?=.{8,}).*/;
              //Alpha Numeric plus minimum 8
              var good = /^(?=\S*?[a-z])(?=\S*?[0-9])\S{8,}$/;
              //Must contain at least one upper case letter, one lower case letter and (one number OR one special char).
              var better = /^(?=\S*?[A-Z])(?=\S*?[a-z])((?=\S*?[0-9])|(?=\S*?[^\w\*]))\S{8,}$/;
              //Must contain at least one upper case letter, one lower case letter and (one number AND one special char).
              var best = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])(?=\S*?[^\w\*])\S{8,}$/;

              $('#RegPass').on('keyup', function () {
                  var password = $(this);
                  var pass = password.val();
                  var passLabel = $('[for="password"]');
                  var stength = 'Weak';
                  var pclass = 'danger';
                  if (best.test(pass) == true) {
                      stength = 'Very Strong';
                      pclass = 'success';
                  } else if (better.test(pass) == true) {
                      stength = 'Strong';
                      pclass = 'warning';
                  } else if (good.test(pass) == true) {
                      stength = 'Almost Strong';
                      pclass = 'warning';
                  } else if (bad.test(pass) == true) {
                      stength = 'Weak';
                  } else {
                      stength = 'Very Weak';
                  }

                  var popover = password.attr('data-content', stength).data('bs.popover');
                  popover.setContent();
                  popover.$tip.addClass(popover.options.placement).removeClass('danger success info warning primary').addClass(pclass);

              });

          });
        </script>       
   </body>
</html>
