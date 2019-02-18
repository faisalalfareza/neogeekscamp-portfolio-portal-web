<?php 
    error_reporting(0);
    $UserId = $this->session->userdata('sc_sess')['UserId'];
    $UserEmail = $this->session->userdata('sc_sess')['UserEmail'];
    $UserEmailTrim = substr($UserEmail, strpos($UserEmail,"<")+0, strrpos($UserEmail, "@")-strpos($UserEmail,"<")-0);  
?>

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
      <header id="header">      
        <div class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand">
                    <h1><img src="<?= base_img()."neogeeks-ekstern.png" ?>" width="190px" height="160px"></h1>
                    </a>
                    
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        
                        <li><a href="<?=site_url('home')?>">Home</a></li>
                        <?php
                          if(isset($this->session->userdata('sc_sess')['UserId'])) {
                            $UserEmail = $this->session->userdata('sc_sess')['UserEmail'];
                            $UserId = $this->session->userdata('sc_sess')['UserId'];
                            
                            if($role->RoleId == 1){  
                            ?>
                            <li class="dropdown"><a href="">Admin Manager <i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="<?=site_url('home/usermanage')?>">User Manager</a></li>
                                    <li><a href="<?=site_url('home/projectmanage')?>">Project Manager</a></li>
                                </ul>
                            </li> 
                            <?php } ?>
                            <li class="dropdown"><a href="<?=site_url('home/resume')?>">Portfolio <i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="<?=site_url('home/resume')?>">Curriculum Vitae</a></li>
                                    <li><a href="<?=site_url('home/project')?>">Collection Project</a></li>
                                    <li><hr></li>
                                    <li><a href="<?=site_url('forum')?>">Forum Discussion</a></li>
                                    <li><hr></li>
                                    <li><a href="<?=site_url('home/artikel')?>">Articles</a></li>
                                    <li><a href="<?=site_url('home/news')?>">News</a></li>
                                </ul>
                            </li>                     
                            <li class="dropdown"><a class="btn" href="javascript:void(0)"><?=$UserEmail?> <i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="<?=site_url('auth/logout')?>">Logut</a></li>
                                </ul>
                            </li>                        
                            <?php
                          } else {
                            ?>
                            <li><a class="btn openLogin" id="modal_trigger" href="javascript:void(0)">Login</a></li>
                            <?php
                          }         
                        ?>
                        
                    </ul>
                </div>
                <div class="search">
                    <form action="search" method="get" role="form">
                        <i class="fa fa-search"></i>
                        <div class="field-toggle">
                            <input type="text" name="destination" class="form-control search-form" autocomplete="on" placeholder="Find Resume, Project, or Article.">
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </header>
      <!--/#header-->        
       
      <!-- Main Content -->
      <div class="content-box">
         <!-- Destinations Section -->
         <section class="section section-destination">


            <!-- Content -->
            <div class="container">    
               <div class="row">
                   <div class="col-lg-6">
                    <?php
                        if(isset($this->session->userdata('sc_sess')['UserId'])) {   
                    ?>   
                    <div class="start-discussion">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#createForum" class="btn btn-success" style="background-color: #dfedf3; color: #5C97BF">Start a Discussion</a> 
                    </div>   
                    <?php
                        }
                    ?>

                    <ul class="breadcrumb">
                      <li><a href="<?=site_url('home')?>">Home</a></li>
                      <li><?=$title?></li>
                    </ul>     

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
                            <li><a href="<?=site_url('home/artikel')?>"><img src="<?=base_img()."icon/list-project.png"?>"> &nbsp; Collection Article</a></li>
                            <li><a href="<?=site_url('home/news')?>"><img src="<?=base_img()."icon/megaphone.png"?>"> &nbsp; Latest News</a></li>                         
                        </ul>
                    </div>                           
                   </div>
                   <div class="col-lg-12">
                    <?=$this->session->flashdata('pesan')?>                      
                       
                    <?php
                        $i = 0; $d = 0; 
                        foreach($hasil as $getForumAndComment){
                        $initial = substr($getForumAndComment['CreatedBy'], 0,1);
                    ?>                            
                    <div class="well forum"> 
                      <span class="forum-author"><?=$initial?></span>
                      <div class="forum-content">

                        <div class="judul"><?=$getForumAndComment['ForumTitle']?></div>
                        <div class="author"><?=$getForumAndComment['CreatedBy']?></div>
                        <div class="author"><?=time_elapsed_string($getForumAndComment['ForumCreateDate'])?></div> 
                        <div class="isi"><?=$getForumAndComment['ForumDesc']?>.</div>
                        <div class="input-group">
                          <span class="label label-default">Blog</span>
                          <span class="label label-info">Code</span>
                        </div>

                         <?php
                            for($x=0; $x<=(count($getForumAndComment['comment'])-1); $x++) {
                              $timestamp = strtotime($getForumAndComment['comment'][$x]['CommentCreateDate']);
                         ?>
                         
                            <h5 class="comment"><hitungini><?=$getForumAndComment['comment'][$x]['Comment']?></hitungini>
                            <?php
                              if($getForumAndComment['comment'][$x]['CreatedBy'] == $UserEmailTrim || $role->RoleId == 1){ 
                            ?>
                              <a href="javascript:void(0)" class="delete-comment" data-toggle="modal" data-target="#delcomment" data-id-comment="<?=$getForumAndComment['comment'][$x]['CommentId']?>" data-comment="<?=$getForumAndComment['comment'][$x]['Comment']?>">&nbsp;&nbsp;&nbsp;&nbsp;<i class="col-sm-12 fa fa-trash-o pull-right"></i></a>
                            <?php
                              }   
                            ?> 

                            <h6><?=$getForumAndComment['comment'][$x]['CreatedBy']?>&nbsp;<?=time_elapsed_string($getForumAndComment['comment'][$x]['CommentCreateDate']);?>
                            </h6>
                            </h5>
                                      
                        <?php
                         
                            }
                         
                        

                        ?>                        

                        <?php
                            if(isset($this->session->userdata('sc_sess')['UserId'])) {   
                        ?>
                            <div class="modal-footer" style="border:0">
                            <table>                                                                  
                                <tr>
                                <td width="60%" align="left">  
                                    <form action="forum/comment" method="post" id="formComment" class="formComment">
                                      <input type="hidden" name="CreatedByComment" value="<?=$UserEmailTrim?>">
                                      <input type="hidden" name="ForumComment" value="<?=$getForumAndComment['ForumId']?>">

                                      <div class="input-group">
                                        <span class="input-group-addon" style="background: none">
                                              <i class="fa fa-comments-o"></i>
                                        </span>
                                        <input id="Comment" type="text" name="CommentC" class="form-control input-form" placeholder="Reply comment .." required>
                                      </div>
                                    </form>
                                </td>
                                <?php 
                                  if($getForumAndComment['CreatedBy'] == $UserEmailTrim || $role->RoleId == 1){ 
                                ?>
                                <td width="30%" align="left"></td>
                                <td width="5%" align="right">                                                  
                                    <a href="javascript:void(0)" data-toggle="modal" data-id="<?=$getForumAndComment['ForumId']?>" data-title="<?=$getForumAndComment['ForumTitle']?>" data-desc="<?=$getForumAndComment['ForumDesc']?>"  data-target="#updateForum" class="btn updateForum">
                                    <i class="btn fa fa-pencil"></i>
                                    </a> 
                                </td>
                                <td width="5%" align="right">
                                   <a href="javascript:void(0)" class="btn delete-forum" data-toggle="modal" data-target="#delforum" data-id="<?=$getForumAndComment['ForumId']?>" data-title="<?=$getForumAndComment['ForumTitle']?>"> 
                                   <i class="btn fa fa-trash-o"></i>
                                   </a>
                                </td>
                                <?php
                                  }
                                ?>
                                </tr>
                            </table>
                            </div> 
                        <?php
                            }   
                        ?> 
                      </div>                                   
                    </div>
                    <?php
                        if (++$i == 5) break;
                        }
                    ?>                                     
                   </div>
                   <div class="col-lg-6">
                        <div class="list-group portofolio">                           
                            <?php
                                $i = 0;
                                foreach($artikel as $getArtikel){
                                    $type = unserialize($getArtikel->ArtclType);    
                            ?>
                                <!--Start User Data-->
                                <a href="<?=site_url('home/artikel/detailarticle/'.$this->encrypt->encode($getArtikel->ArtclId))?>" class="list-group-item">
                                    <div class="pull-left form-control-inline">
                                        <h4 class="list-group-item-heading title"><?=$getArtikel->ArtclTitle?></h4>
                                        <h6 class="list-group-item-heading type">Posted on <?=$getArtikel->CreatedOn?></h6>         
                                    </div> 
                                    <div class="pull-right">
                                    <?php 
                                        for($x=0; $x<=(count($type)-1); $x++) { 
                                        $x == 1  ? $span='success' : ($x == 2 ? $span='danger' : $span='info');   
                                    ?>
                                        <span class="label label-<?=$span?>"><?=$type[$x]?></span>
                                    <?php if($x == 3) break; } ?>    
                                    </div>
                                    <div class="clearfix"></div>
                                </a>
                                <!--End User Data-->
                            <?php
                                if (++$i == 5) break;
                                }
                            ?>                           
                        </div>                    
                   </div>
               </div>
            </div>
         </section>           
      </div>
       
      <!-- Footer -->
      <footer class="main-footer">
         <div class="container">
            <div class="row">
               <div class="col-md-4">
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

               <div class="col-md-4">
                  <div class="widget widget_links">
                     <h5 class="widget-title">Related Pages</h5>
                     <ul>
                        <li><a href="<?=site_url('home/resume')?>">Curriculum Vitae</a></li>
                        <li><a href="<?=site_url('home/project')?>">Collection Project</a></li>
                        <li><a href="<?=site_url('forum')?>">Forum Discussion</a></li> 
                        <li><a href="<?=site_url('home/artikel')?>">Blogpost</a></li>
                        <li><a href="<?=site_url('home/news')?>">News</a></li>
                     </ul>
                  </div>
               </div>
                
               <div class="col-md-4">
                  <div class="widget widget_links">
                     <h5 class="widget-title">Latest News</h5>
                     <ul>
                        <?php 
                            $i = 0;
                            foreach($news as $getNews){
                        ?>   
                            <li><a href="<?=site_url('home/news/detailnews/'.$getNews->NewsId)?>"><?=$getNews->NewsTitle?></a></li>
                        <?php 
                            if (++$i == 5) break;
                            }
                        ?>                            
                     </ul> 
                  </div>
               </div> 

               <div class="col-md-4">
                  <div class="widget widget_links">
                     <h5 class="widget-title">Learning Resources</h5>
                     <ul>
                        <li><a href="https://mva.microsoft.com/">Microsoft Virtual Academy</a></li>
                        <li><a href="https://www.visualstudio.com/team-services/">Visual Studio Team Services</a></li>
                        <li><a href="https://ilearning.oracle.com/ilearn/en/learner/jsp/login.jsp?site=OracleAcad">Oracle Academy</a></li>
                        <li><a href="http://www.androidhive.info/">Androidhive</a></li>
                        <li><a href="https://asana.com/">Asana</a></li>
                     </ul>
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="widget widget_links">
                     <h5 class="widget-title">Products & Services</h5>
                     <ul>
                        <li><a href="http://www.visionet.co.id/en/products-services/branch-it-managed-services/">Branch IT Managed Services</a></li>
                        <li><a href="http://www.visionet.co.id/en/products-services/merchants-it-services/">Merchant IT Services</a></li>
                        <li><a href="http://www.visionet.co.id/en/products-services/field-operation-managed-services/">Field Operation Managed Services</a></li>
                        <li><a href="http://www.visionet.co.id/en/products-services/it-managed-services/">IT Managed Services</a></li>
                        <li><a href="http://www.visionet.co.id/en/products-services/it-application-managed-services/">IT Application Managed Services</a></li>
                        <li><a href="http://www.visionet.co.id/en/contact-center/">Contact Center Services</a></li> 
                     </ul>
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="widget widget_links">
                     <h5 class="widget-title">Company</h5>
                     <ul>
                        <li><a href="http://www.visionet.co.id/en/job-lists/">Careers</a></li>
                        <li><a href="http://www.visionet.co.id/en/">About Visionet</a></li>
                        <li><a href="http://www.visionet.co.id/en/alliances-clienteles/">Alliances & Clienteles</a></li> 
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </footer>
       
      <!--Create Forum-->
       <div class="modal fade in" id="createForum" role="dialog" aria-hidden="false" >
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="forum/create" method="post" id="formForum" class="formProject">

                <input type="hidden" name="CreatedBy" value="<?=$UserEmailTrim?>">
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet portlet-bordered">
                    <div class="portlet-container">
                        <div class="portlet-title">
                            <div class="caption caption-red">
                                <span class="caption-subject"> Forum </span>
                            </div>
                        </div>
                        <div class="modal-body">
                        <div class="form-group">
                                   <label class="control-label" for="inputDefault">Title</label>
                                   <div>
                                        <input class="form-control" rows="10" id="ForumTitle" name="ForumTitle" value=""></input>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            <div class="form-group">
                               <label class="control-label" for="inputDefault">Description</label>
                               <div>
                                    <textarea class="form-control" rows="10" id="ForumDesc" name="ForumDesc" ></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                  <button class="btn" data-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-raised btn-success">Create</button>
                            </div>
                        </div>
                    </div>
                </div> 
                <!-- END Portlet PORTLET-->
                </form>
            </div>
        </div>
    </div>
    
    <!--Update Resume-->
    <div class="modal fade in" id="updateForum" role="dialog" aria-hidden="false" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="forum/updateFor" method="post" id="formUpdate" class="formProject">

                    <input type="hidden" name="CreatedBy" value="<?=$UserEmailTrim?>">
                    <!-- BEGIN Portlet PORTLET-->
                    <div class="portlet portlet-bordered">
                        <div class="portlet-container">
                            <div class="portlet-title">
                                <div class="caption caption-red">
                                    <button type="button" class="close" id="exit_artcl" ><i class="fa fa-times-circle"></i></button>
                                    <span class="caption-subject"> Forum </span>
                                    <span class="caption-helper"> Update Forum </span>
                                </div>
                            </div>
                            <div class="modal-body">
                                <input id="uForumId" type="hidden" name="ForumId" class="form-control" value="">
                                <div class="form-group">
                                   <label class="control-label" for="inputDefault">Title</label>
                                   <div>
                                        <input class="form-control" rows="10" id="uForumTitle" name="ForumTitle" value=""></input>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                   <label class="control-label" for="inputDefault">Description</label>
                                   <div>
                                        <textarea class="form-control" rows="10" id="uForumDesc" name="ForumDesc" value=""></textarea>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                      <button class="btn" data-dismiss="modal">Cancel</button>
                                      <button type="submit" class="btn btn-raised btn-success">Update</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <!-- END Portlet PORTLET-->
                    </form>
                </div>
            </div>
        </div>
    
     <!--Delete Modal-->
     <div class="modal fade" id="delforum">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Delete Forum</h4>
            </div>
            <div class="modal-body">
                <br>
              <p class="modal-title">Are you sure delete this forum ?</p>
                <br>
              <form method="post" action="forum/deletefrm" id="formDeleteForum">
                <input type="hidden" name="frmid" id="ForumId" value="">
                <button type="submit" class="btn btn-raised btn-success ">Sure</button>
                <button class="btn" data-dismiss="modal">Cancel</button>
              </form>   
            </div>
          </div>
        </div>
     </div>
     <!--end-->
    
     <!--Delete Modal Comment-->
     <div class="modal fade" id="delcomment">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Delete Forum</h4>
            </div>
            <div class="modal-body">
                <br>
              <p class="modal-title">Are you sure delete this comment ?</p>
                <br>
              <form method="post" action="forum/deleteCom" id="formDeleteComment">
                <input type="hidden" name="CommentId" id="CommentId" value="">
                <button type="submit" class="btn btn-raised btn-success ">Sure</button>
                <button class="btn" data-dismiss="modal">Cancel</button>
              </form>   
            </div>
          </div>
        </div>
      </div>
      <!--end-->  
    
     <!--Delete Modal Comment-->
     <div class="modal fade" id="delcomment">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Delete Comment</h4>
            </div>
            <div class="modal-body">
                <br>
              <p class="modal-title">Are you sure delete this comment?</p>
                <br>
              <form method="post" action="<?=base_url()."forum/deleteCom"?>" id="formDeleteComment">
                <input type="hidden" name="CommentId" id="CommentId" value="">
                <button type="submit" class="btn btn-success ">Sure</button>
                <button class="btn" data-dismiss="modal">Cancel</button>
              </form>   
            </div>
          </div>
        </div>
      </div>
      <!--end-->       
       
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
            
          //delete forum 
          $(".delete-forum").click(function(){       
            var idforum = $(this).attr("data-id");
            $("#ForumId").prop("value", idforum);
          });
          //delete comment 
          $(".delete-comment").click(function(){       
            var CommentId = $(this).attr("data-id-comment");
            $("#CommentId").prop("value", CommentId);
          });
          //updateforum
          $(".updateForum").click(function(){       

            var ForumId = $(this).attr("data-id");
            $("#uForumId").prop("value", ForumId);

            var ForumTitle = $(this).attr("data-title");
            $("#uForumTitle").prop("value", ForumTitle);

            var ForumDesc = $(this).attr("data-desc");
            $("#uForumDesc").prop("value", ForumDesc);  

          });            
        </script>       
   </body>
</html>
