<?php
    $UserId = $this->session->userdata('sc_sess')['UserId']; 
    $UserEmail = $this->session->userdata('sc_sess')['UserEmail'];
    $UserEmailTrim = substr($UserEmail, strpos($UserEmail,"<")+0, strrpos($UserEmail, "@")-strpos($UserEmail,"<")-0);  
    $this->load->view('general/ekstern/head'); 
?>   

      <!-- Main Content -->
      <div class="content-box">
         <!-- Destinations Section -->
         <section class="section section-destination">
            <!-- Content -->
            <div class="container">    
               <div class="row">
                   <div class="col-lg-6">
                    <?php
                        if($role->RoleId == 1) {   
                    ?>   
                    <div class="start-discussion">
                        <a class="btn btn-success openNews" id="modal_trigger " data-backdrop="false">Add News</a> 
                    </div>   
                    <?php
                        }
                    ?>      

                    <ul class="breadcrumb">
                      <li><a href="<?=site_url('home')?>">Home</a></li>
                      <li><?=$title?></li>
                    </ul>  

                    <div class="sidebar content-box left-box" style="display: block; background: none; border: 0;">
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
                            <li><a href="<?=site_url('forum')?>"><img src="<?=base_img()."icon/telemarketer.png"?>"> &nbsp; Forum Discussion</a></li>                            
                        </ul>
                    </div>                           
                   </div>
                   <div class="col-lg-12">
                    <?=$this->session->flashdata('pesan')?>  
                         
                        <div class="list-group portofolio">                           
                            <?php
                                foreach($news as $getNews){                              
                            ?>
                            <!--Start User Data-->
                            <div class="group-list">
                                <div class="list-group-item">
                                    <a href="<?=site_url('home/news/detailnews/'.$this->encrypt->encode($getNews->NewsId))?>" class="pull-left form-control-inline">

                                        <h4 class="list-group-item-heading title content"><?=$getNews->NewsTitle?></h4>
                                        <h6 class="list-group-item-heading type content"><b><?=$getNews->CreatedBy?></b> / <?=time_elapsed_string($getNews->CreatedOn)?></h6>       
                                        <p class="list-group-item-text sub-title"><?=$getNews->NewsContent?>

                                          <?php 
                                            if ($getNews->NewsImage != null) { ?>
                                            <br><br>
                                            <img class="media-object" src="<?=$getNews->NewsImage?>"> 
                                            <br><br> 
                                         <?php } ?>
                                        </p>            
                                    </a>
                                    <div class="pull-right">
                                        <?php if($role->RoleId == 1) { ?>
                                        
                                        <span class="label label-default"><a href="javascript:void(0)" class="updateNews" data-toggle="modal" data-id="<?=$getNews->NewsId?>" data-title="<?=$getNews->NewsTitle?>" data-content="<?=$getNews->NewsContent?>" data-target="#updateNews" ><i class="fa fa-edit"></i></a></span>
                                        <span onclick="window.location='<?=site_url('home/news/delete/'.$getNews->NewsId)?>';" class="label label-default"><i class="fa fa-trash"></i> </span>
                                        
                                        <?php
                                            } 
                                        ?>
                                    </div>    
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <!--End User Data-->
                            <?php
                                }
                            ?>  
                             <ul class="pagination pagination-sm mark" id="paging"></ul>
                        </div>                                                 
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
                                        <h6 class="list-group-item-heading type"><?=time_elapsed_string($getArtikel->CreatedOn)?></h6>         
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
       
      <?php $this->load->view('form/fauth'); ?>
      <?php $this->load->view('form/fpost'); ?>
      <?php $this->load->view('general/ekstern/foot'); ?> 
       
      <!--UpdateNews-->
      <div class="modal fade" id="updateNews" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="news/updatenews" method="post" id="uFormNews" enctype="multipart/form-data" onsubmit="return false">
                    <input id="uNewsId" type="hidden" name="NewsId" value="">  
                    
                    <!-- BEGIN Portlet PORTLET-->
                    <div class="portlet portlet-bordered">
                        <div class="portlet-container">
                            <div class="portlet-title">
                                <div class="caption caption-red">
                                    <span class="caption-subject"> Update News </span>
                                </div>
                                <button type="button" class="btn fileUpload pull-right">
                                       <i class="fa fa-picture-o"></i> &nbsp; Change Picture
                                       <input class="upload" type="file" name="uNewsImage" title="(optional)" accept="image/*"/>
                                </button>
                            </div>
                            <div class="portlet-body">
                                <div class="form-group">
                                   <label class="control-label" for="inputDefault">Title</label>
                                   <input id="uNewsTitle" type="text" name="NewsTitle" class="form-control input-form" value="">
                                </div>
                                 <div class="form-group">
                                   <label class="control-label" for="inputDefault">Content</label>
                                   <textarea id="uNewsContent" name="NewsContent" rows="4" class="form-control"><?=$getNews->NewsContent?></textarea>
                                </div> 
                                <div class="action_btns">
                                    <div class="one_half"><button type="button" class="btn" data-dismiss="modal">Cancel</button></div> 
                                    <div class="one_half last"><button type="submit" class="btn btn-success uFinishNews">Change</button></div>
                                </div>
                            </div>    
                        </div> 
                    </div>
                    <!-- END Portlet PORTLET-->
                </form>
            </div>
        </div>
      </div>
      <!--/End Modal-->       
       
        <!-- Custom Javascript -->
        <script type="text/javascript" src="<?=base_js()."page/news.js"?>" ></script>
        <!-- End Custom Javascript -->       

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
                $('#checkAll').change(function () {
                    $("input:checkbox").prop('checked', $(this).prop("checked"));
                }); 
                $('.group-list')
                    .pageMe({pagerSelector:'#paging',showPrevNext:true,hidePageNumbers:false,perPage:5});                                                                                 
              });
          });

          //update-news
          $(".updateNews").click(function(){
            var NewsId = $(this).attr("data-id");
            $("#uNewsId").attr("value", NewsId);
            var NewsTitle = $(this).attr("data-title");
            $("#uNewsTitle").attr("value", NewsTitle);
            var NewsContent = $(this).attr("data-content");
            tinyMCE.get('uNewsContent').setContent(NewsContent);
          });  

        </script>  
   </body>
</html>
