<?php $UserId = $this->session->userdata('sc_sess')['UserId'];  ?>   

<!DOCTYPE html>
<?php error_reporting(0); ?>

<html lang="en">
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
      <link href="<?=base_css()."chosen.min.css"?>" rel="stylesheet" />    
      <link href="<?=base_css()."ripples.min.css"?>" rel="stylesheet">
      <link href="<?=base_css()."snackbar.min.css"?>" rel="stylesheet"> 
      <link href="<?=base_css()."main.css"?>" rel="stylesheet">
      <link href="<?=base_css()."responsive.css"?>" rel="stylesheet">
      <link href="<?=base_css()."owl.carousel/owl.transitions.css"?>" rel="stylesheet">
      <link href="<?=base_css()."owl.carousel/owl.carousel.css"?>" rel="stylesheet">
      <link href="<?=base_css()."owl.carousel/owl.theme.css"?>" rel="stylesheet">
            
   </head>
   <body class="home" id="page" style="background-color: #fff">
      <!-- Main Content -->
      <div class="content-box">
         <section class="section section-hero"></section>

         <!-- Destinations Section -->
         <section class="section section-destination">
            <!-- Content -->
            <div class="container">    
               <div class="row">
                   <div class="col-lg-6">
                    <ul class="breadcrumb">
                      <li><a href="<?=site_url('home')?>">Home</a></li>
                      <li><?=$title?></li>
                    </ul>   
                    <div class="sidebar content-box left-box" style="display: block; border:0">
                        <ul class="nav">
                            <!-- Main menu -->              
                            <li><a href="#activate" aria-controls="activate" role="tab" data-toggle="tab">User History</a></li>                      
                        </ul>
                    </div>                     
                    <div class="sidebar content-box left-box" style="display: block; border:0">
                        <ul class="nav">
                            <!-- Main menu -->        
                            <?php if($role->RoleId == 1) { ?>
                            <li><a href="<?=site_url('home/usermanage')?>">User Manager</a></li>
                            <li><a href="<?=site_url('home/projectmanage')?>">Project Manager</a></li>
                            <?php } else { ?>
                            <li><a href="<?=site_url('home/news')?>">Latest News</a></li>
                            <li><a href="<?=site_url('home/artikel')?>">Collection Article</a></li>
                            <?php } ?>

                            <li><a href="<?=site_url('home/resume')?>">Curriculum Vitae</a></li>
                            <li><a href="<?=site_url('home/project')?>">Collection Project</a></li> 
                            <li><a href="">Settings</a></li>                       
                        </ul>
                    </div> 
                   </div>
                   <div class="col-lg-14">
                    <?=$this->session->flashdata('pesan')?>                                               
                       
                    <div class="tab-content usermanager">
                        <div role="tabpanel" class="tab-pane active" id="activate">
                            <?=form_open('home/history/delete')?>
                            <button type="button" class="btn" data-toggle="modal" data-target="#clear_log">Clear browsing data</button>
                            <button type="submit" class="btn remove_items" disabled>Remove selected items</button>
                            <hr class="divider separator">
                            <div class="list-group">                            
                                <?php 
                                  foreach($history as $getHistory){
                                    if($getHistory->log_userid == $UserId) {
                                      $timestamp = strtotime($getHistory->log_time);
                                ?>
                                    <!--Start User Data-->
                                    <div class="waiting-list">
                                      <div class="list-group-item">
                                          <div class="checkbox pull-left">
                                              <label>
                                                  <input type="checkbox" onchange="validateLog();" class="log" name="item[]" value="<?=$getHistory->log_id?>">		
                                              </label>   
                                          </div>
                                          <div class="pull-left form-control-inline">
                                              <p class="list-group-item-text sub-title time">
                                              <?=date('h:m', $timestamp)?></p>     
                                          </div>
                                          <div class="pull-left form-control-inline">
                                              <a class="list-group-item-heading title"><?=$getHistory->log_desc?></a>
                                              <p class="list-group-item-text sub-title">
                                              <?=date('l, d M Y', $timestamp)?></p>			
                                          </div>
                                          <div class="clearfix"></div>
                                      </div>
                                    </div>
                                    <!--End User Data-->
                                <?php
                                    }
                                  }
                                ?>  
                                <ul class="pagination pagination-sm mark" id="paging-log"></ul>          
                            </div>
                            <?=form_close()?>               
                        </div>
                        </div>                                           
                   </div>
               </div>
            </div>
         </section>           
      </div>               
       
      <?php $this->load->view('form/fauth'); ?>
      <?php $this->load->view('form/fpost'); ?>
      <?php $this->load->view('form/_clearBrowsingData'); ?>

      <!-- Scripts -->
      <script src="<?=base_js()."jquery.js"?>" ></script>     
      <script src="<?=base_js()."functions.js"?>" ></script>
      <script src="<?=base_js()."bootstrap.min.js"?>"></script> 

        <!-- Custom Javascript -->
        <script type="text/javascript" src="<?=base_js()."page/home.js"?>" ></script>
        <!-- End Custom Javascript -->        

      <script type="text/javascript" src="<?=base_js()."owl.carousel/owl.carousel.min.js"?>" ></script>
      <script type="text/javascript" src="<?=base_js()."bootstrap-select.min.js"?>" ></script>
      <script type="text/javascript" src="<?=base_js()."jquery.isotope.min.js"?>" ></script>   
      <script type="text/javascript" src="<?=base_js()."wow.min.js"?>" ></script>
      <script type="text/javascript" src="<?=base_js()."main.js"?>" ></script> 
      <script type="text/javascript" src="<?=base_js()."chosen.jquery.min.js"?>" ></script>        
      <script type="text/javascript" src="<?=base_js()."material.min.js"?>"></script>
      <script type="text/javascript" src="<?=base_js()."ripples.min.js"?>"></script>
      <script type="text/javascript" src="<?=base_js()."snackbar.min.js"?>"></script>        
      <script type="text/javascript" src="<?=base_js()."jquery-ui.min.js"?>" ></script>      

        <script type="text/javascript">
            var $ = jQuery.noConflict(); 
            $.fn.pageMe = function(opts){
                var $this = this,
                    defaults = {
                        perPage: 2,
                        showPrevNext: true,
                        hidePageNumbers: false
                    },
                    settings = $.extend(defaults, opts);

                var listElement = $this;
                var perPage = settings.perPage; 
                var children = listElement.children();
                var pager = $('.mark');

                if (typeof settings.childSelector!="undefined") {
                    children = listElement.find(settings.childSelector);
                }

                if (typeof settings.pagerSelector!="undefined") {
                    pager = $(settings.pagerSelector);
                }

                var numItems = children.size();
                var numPages = Math.ceil(numItems/perPage);

                pager.data("curr",0);

                if (settings.showPrevNext){
                    $('<li><a href="#" class="prev_link"><i class="fa fa-chevron-circle-left"></i></a></li>').appendTo(pager);
                }

                var curr = 0;
                while(numPages > curr && (settings.hidePageNumbers==false)){
                    $('<li><a href="#" class="page_link">'+(curr+1)+'</a></li>').appendTo(pager);
                    curr++;
                }

                if (settings.showPrevNext){
                    $('<li><a href="#" class="next_link"><i class="fa fa-chevron-circle-right"></i></a></li>').appendTo(pager);
                }

                pager.find('.page_link:first').addClass('active');
                pager.find('.prev_link').hide();
                if (numPages<=1) {
                    pager.find('.next_link').hide();
                }
                  pager.children().eq(1).addClass("active");

                children.hide();
                children.slice(0, perPage).show();

                pager.find('li .page_link').click(function(){
                    var clickedPage = $(this).html().valueOf()-1;
                    goTo(clickedPage,perPage);
                    return false;
                });
                pager.find('li .prev_link').click(function(){
                    previous();
                    return false;
                });
                pager.find('li .next_link').click(function(){
                    next();
                    return false;
                });

                function previous(){
                    var goToPage = parseInt(pager.data("curr")) - 1;
                    goTo(goToPage);
                }

                function next(){
                    goToPage = parseInt(pager.data("curr")) + 1;
                    goTo(goToPage);
                }

                function goTo(page){
                    var startAt = page * perPage,
                        endOn = startAt + perPage;

                    children.css('display','none').slice(startAt, endOn).show();

                    if (page>=1) {
                        pager.find('.prev_link').show();
                    }
                    else {
                        pager.find('.prev_link').hide();
                    }

                    if (page<(numPages-1)) {
                        pager.find('.next_link').show();
                    }
                    else {
                        pager.find('.next_link').hide();
                    }

                    pager.data("curr",page);
                    pager.children().removeClass("active");
                    pager.children().eq(page+1).addClass("active");

                }
            };

          $(document).ready(function () {    
              $(function(){
                $.material.init();
                $('.modal-dialog').draggable();
                $('.popup-container').draggable();
                $('#allLog').change(function () {
                    $("input:checkbox.log").prop('checked', $(this).prop("checked"));
                });
                $('.waiting-list')
                    .pageMe({pagerSelector:'#paging-log',showPrevNext:true,hidePageNumbers:false,perPage:5});
                $('input:checkbox.log').onchange = function () { validateLog() };                    
              });
          });

          function validateLog() {
            if ($('input:checkbox.log').value != "") {
                $('button:submit.remove_items').prop('disabled', false);
            }
            else {
                $('button:submit.remove_items').prop('disabled', true);
            }
          }          
        </script>       
   </body>
</html>
