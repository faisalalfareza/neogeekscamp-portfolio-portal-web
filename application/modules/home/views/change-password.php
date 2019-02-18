<!DOCTYPE html>
<html>
   <head>
      <title><?=$title?> | Innovation Center</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Traveling HTML5 Template" />
      <meta name="author" content="Design Hooks" />
      <link rel="shortcut icon" type="image/x-icon" href="<?=base_img()."logo2.png"?>" >
       
        <!-- URL Theme Color untuk Chrome, Firefox OS, Opera dan Vivaldi -->
        <meta name="theme-color" content="#fff" />
        <!-- URL Theme Color untuk Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#fff" />
        <!-- URL Theme Color untuk iOS Safari -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="#fff" />        
       
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Raleway:400,700" rel="stylesheet" />
      <link href="<?=base_css()."bootstrap.min.css"?>" rel="stylesheet" />
      <link href="<?=base_css()."bootstrap-select.min.css"?>" rel="stylesheet">
      <link href="<?=base_css()."bootstrap-datetimepicker.min.css"?>" rel="stylesheet"> 
      <link href="<?=base_css()."font-awesome.min.css"?>" rel="stylesheet">        
      <link href="<?=base_css()."screen.css"?>" rel="stylesheet" />
      <link href="<?=base_css()."main.css"?>" rel="stylesheet" />   
      <link href="<?=base_css()."jquery.dropdown.css"?>" rel="stylesheet" />  
      <link href="<?=base_css()."ripples.min.css"?>" rel="stylesheet">
      <link href="<?=base_css()."snackbar.min.css"?>" rel="stylesheet"> 
	  <link href="<?=base_css()."main.css"?>" rel="stylesheet">
	  <link href="<?=base_css()."responsive.css"?>" rel="stylesheet">
      <link href="<?=base_css()."owl.carousel/owl.transitions.css"?>" rel="stylesheet">
      <link href="<?=base_css()."owl.carousel/owl.carousel.css"?>" rel="stylesheet">
      <link href="<?=base_css()."owl.carousel/owl.theme.css"?>" rel="stylesheet">       
       
   </head>
   <body class="home" id="page">
      <!-- Main Content -->
      <div class="content-box">
         <!-- Hero Section -->
         <section class="section section-hero"></section>

         <!-- Destinations Section -->
         <section class="section section-destination">
            <!-- Title -->
            <div class="section-title">
               <div class="container">
                  <h2 class="title"><img src="<?=base_img()."icon/pie-chart.png"?>"> &nbsp; <?=$title?></h2>
                  <p class="sub-title">Berikan akses masuk kepada user dengan mengaktivasinya. Atau jadikan user sebagai admin</p>
               </div>
            </div>

            <!-- Content -->
            <div class="container">    
               <div class="row">
                   <div class="col-lg-6">
                    <ul class="breadcrumb">
                      <li><a href="<?=site_url('home')?>">Home</a></li>
                      <li><?=$title?></li>
                    </ul>   
                    <div class="sidebar content-box left-box" style="display: block;">
                        <ul class="nav">
                            <!-- Main menu -->
                            <li><a href="<?=site_url('home')?>">Home</a></li>                            
                            <?php
                              if(isset($this->session->userdata('sc_sess')['UserId'])) {   
                            ?>
                            
                            <li><a href="<?=site_url('home/resume')?>">Curriculum Vitae</a></li>    
                            <li><a href="<?=site_url('home/project')?>">Collection Projects</a></li>  
                            
                            <?php
                              }        
                            ?>                       
                            
                            <li><a href="<?=site_url('home/artikel')?>">Articles</a></li>
                            <li><a href="<?=site_url('home/news')?>">News</a></li>                                              
                        </ul>
                    </div> 
                   </div>
                   <div class="col-lg-18">
                    <?=$this->session->flashdata('pesan')?>                                               
                    <!-- Reister form -->
                    <form action="<?php echo base_url()."home/changepassword/password" ?>" method="post" id="formRegister" onsubmit="return false">
                     <div class="form-group">
                       <label class="control-label" for="inputDefault">Email</label>
                       <input id="RegUser" type="email" name="UserEmail" class="form-control" value="<?=$email?>" autofocus>
                     </div>
                     <div class="form-group">
                        <label class="control-label" for="inputDefault">New Password</label>
                        <div class="input-group date form_datetime">
                            <input type="text" id="RegPass" name="UserPass" class="form-control">
                            <a onclick="randomString()" style="cursor:pointer" class="input-group-addon RegPass">
                                <i class="fa fa-plus-square-o"></i>
                            </a>
                        </div>
                    </div>    
                     <div class="form-group">
                       <label class="control-label" for="inputDefault">Confirm Password</label>
                       <input id="RegPassConf" type="password" class="form-control">
                     </div>    
                     <div class="action_btns">
                       <div class="last"><button type="submit" class="btn btn-success finishRegist" disabled>Change Password</button></div>     
                     </div>
                   </form>
                 </div>    
               </div>
            </div>
         </section>           
      </div>
       
      <!-- Footer -->
      <footer class="main-footer">
         <div class="container">
            <div class="row">
               <div class="col-md-5">
                  <div class="widget widget_links">
                     <h5 class="widget-title">Populer Project</h5>
                     <ul>
                        <?php 
                            foreach($project as $getPro){
                        ?>   
                            <li><a href="<?=site_url('home/project/projectDetails/'.$getPro->ProId)?>"><?=$getPro->ProName?></a></li>
                        <?php 
                            }
                        ?>                            
                     </ul>
                  </div>
               </div>

               <div class="col-md-5">
                  <div class="widget widget_links">
                     <h5 class="widget-title">Halaman Terkait</h5>
                     <ul>
                        <li><a href="<?=site_url('home/resume')?>">Curriculum Vitae</a></li>
                        <li><a href="<?=site_url('home/project')?>">Collection Project</a></li>
                        <li><a href="#">Blogpost</a></li>
                        <li><a href="#">News</a></li>
                     </ul>
                  </div>
               </div>

               <div class="col-md-9">
                  <div class="widget widget_social">
                     <h5 class="widget-title">Berlangganan</h5>
                     <form class="subscribe-form">
                        <div class="input-line">
                           <input type="text" name="subscribe-email" value="" placeholder="Your email address" />
                        </div>
                        <button type="button" name="subscribe-submit" class="btn btn-special no-icon">Langganan</button>
                     </form>

                     <ul class="clean-list social-block">
                        <li>
                           <a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                           <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                           <a href="#"><i class="fa fa-instagram"></i></a>
                        </li>
                     </ul>
                  </div>
               </div>

               <div class="col-md-5">
                  <div class="widget widget_links">
                      <p>Neogekscamp merupakan sebuah sebutan dari inovation center dari Visionet Data Internasional. Memberikan ide dan karya inovatif dan lebih fresh tentunya</p>
                      <p>MIS Visionet &copy; 2016</p>
                  </div>
               </div>
            </div>
         </div>
      </footer>       
       
      <?php $this->load->view('form/fauth.php'); ?>
      <?php $this->load->view('form/fpost.php'); ?>     
       
      <!-- Scripts -->
      <script src="<?=base_js()."jquery.js"?>" ></script>     
      <script src="<?=base_js()."functions.js"?>" ></script>
      <script src="<?=base_js()."bootstrap.min.js"?>"></script>
        <!-- Custom Javascript -->
        <script type="text/javascript" src="<?=base_js()."page/home.js"?>" ></script>
        <!-- End Custom Javascript -->       
      <script type="text/javascript" src="<?=base_js()."owl.carousel/owl.carousel.min.js"?>" ></script>
      <script type="text/javascript" src="<?=base_js()."bootstrap-datetimepicker.id.js"?>"></script>
      <script type="text/javascript" src="<?=base_js()."bootstrap-datetimepicker.min.js"?>"></script> 
      <script type="text/javascript" src="<?=base_js()."bootstrap-select.min.js"?>" ></script>
      <script type="text/javascript" src="<?=base_js()."jquery.isotope.min.js"?>" ></script>   
      <script type="text/javascript" src="<?=base_js()."wow.min.js"?>" ></script>
      <script type="text/javascript" src="<?=base_js()."main.js"?>" ></script>        
      <script type="text/javascript" src="<?=base_js()."material.min.js"?>"></script>
      <script type="text/javascript" src="<?=base_js()."ripples.min.js"?>"></script>
      <script type="text/javascript" src="<?=base_js()."snackbar.min.js"?>"></script>        
      <script type="text/javascript" src="<?=base_js()."jquery.dropdown.js"?>" ></script>
      <script type="text/javascript" src="<?=base_js()."jquery-ui.min.js"?>" ></script>   
        <script type="text/javascript">
          $(document).ready(function () {    
              $(function(){
                $.material.init();
                $(".form-group select").dropdown();
                $('.modal-dialog').draggable();
                $('.popup-container').draggable();
                $('#checkAll').change(function () {
                    $("input:checkbox").prop('checked', $(this).prop("checked"));
                });
              });
          });
             
        </script>       
   </body>
</html>
