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
                    <?php if(isset($this->session->userdata('sc_sess')['UserId'])) {  ?>   
                    <div class="start-discussion">
                        <a class="btn btn-success openArticle" id="modal_trigger add" data-backdrop="false">Add Article</a> 
                    </div>   
                    <?php } ?>   

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
                            
                            <li><a href="<?=site_url('forum')?>"><img src="<?=base_img()."icon/telemarketer.png"?>"> &nbsp; Forum Discussion</a></li>
                            <li><a href="<?=site_url('home/news')?>"><img src="<?=base_img()."icon/megaphone.png"?>"> &nbsp; Latest News</a></li>
                        </ul>
                    </div>                       
                   </div>               
                   <div class="col-lg-12">
                    <?=$this->session->flashdata('pesan')?> 

                        <div class="list-group portofolio">                           
                            <?php
                                foreach($artcl as $getArtclAndComment){
                            ?>
                            <!--Start User Data-->
                            <div class="group-list">
                                <div class="list-group-item">
                                    <a href="<?=site_url('home/artikel/detailarticle/'.$this->encrypt->encode($getArtclAndComment['ArtclId']))?>" class="pull-left form-control-inline">

                                        <h4 class="list-group-item-heading title content"><?=$getArtclAndComment['ArtclTitle']?></h4>
                                        <h6 class="list-group-item-heading type content"><b><?=$getArtclAndComment['CreatedBy']?></b> / <?=time_elapsed_string($getArtclAndComment['CreatedOn'])?></h6> 
                                        <p class="list-group-item-text sub-title">
                                         <?=$getArtclAndComment['ArtclContent']?> 
                                         <?php 
                                         if ($getArtclAndComment['ArtclImage'] != null) { ?>
                                            <br><br>
                                            <img class="media-object" src="<?=$getArtclAndComment['ArtclImage']?>"> 
                                            <br><br> 
                                         <?php } ?>
                                         </p>                                    
                                    </a>
                                    
                                    <div class="list-group-item-text sub-title"> 
                                         <?php
                                              if(isset($this->session->userdata('sc_sess')['UserId'])) {   
                                          ?>
                                            <h6 class="list-group-item-text sub-title">   
                                                 <form action="<?php echo base_url()."home\artikel\comment_artcl"?>" method="post" id="formComment" class="formComment">
                                                  <input type="hidden" name="CreatedBy" value="<?=$UserEmailTrim?>">
                                                  <input type="hidden" name="ArtclId" value="<?=$getArtclAndComment['ArtclId']?>">

                                                  <div class="input-group">
                                                    <span class="input-group-addon" style="background: none">
                                                          <i class="fa fa-comments-o"></i>
                                                    </span>
                                                    <input type="text" name="CommentArticle" class="form-control input-form" placeholder="Reply comment .." required>
                                                    </div>
                                                    </form>
                                            </h6>
                                          <?php
                                              }

                                            for($x=0; $x<=(count($getArtclAndComment['comment'])-1); $x++) {
                                              $timestamparticle = strtotime($getArtclAndComment['comment'][$x]['CommentArticleCreateDate']);
                                          ?>
                                         
                                            <h5 class="sub-title"><hitungini><?=$getArtclAndComment['comment'][$x]['CommentArticle']?></hitungini>
                                                <?php 
                                                if($getArtclAndComment['comment'][$x]['CreatedBy'] == $UserEmailTrim || $role->RoleId == 1){ 
                                                ?>
                                                  <a href="javascript:void(0)" class="delete-comment" data-toggle="modal" data-target="#delcomment" data-id-comment="<?=$getArtclAndComment['comment'][$x]['CommentArticleId']?>" data-comment="<?=$getArtclAndComment['comment'][$x]['CommentArticle']?>"> 
                                                  &nbsp;&nbsp;&nbsp;&nbsp;<i class="col-sm-12 fa fa-trash-o pull-right"></i>
                                                  </a>
                                                <?php
                                                }
                                                ?>              
                                            <h6><?=$getArtclAndComment['comment'][$x]['CreatedBy']?>&nbsp;<?=time_elapsed_string($getArtclAndComment['comment'][$x]['CommentArticleCreateDate']);?></h6>
                                                
                                            </h5>
                                        <?php
                                         }
                                        ?>
                                        
                                        <haha><h6><a class="comment lihatkomentar" href="<?=site_url('home/artikel/detailarticle/'.$this->encrypt->encode($getArtclAndComment['ArtclId']))?>">lihat komentar lain ..</a></h6></haha>
                                        

                                    </div>
                                    
                                    <!-- //end -->
                                    <div class="pull-right">
                                        <?php 
                                        $type = unserialize($getArtclAndComment['ArtclType']);
                                        if($role->RoleId == 1) {
                                        for($x=0; $x<=(count($type)-1); $x++) {
                                            $x == 1  ? $span='success' : ($x == 2 ? $span='danger' : $span='info');  
                                        ?>
                                        <span class="label label-<?=$span?>"><?=$type[$x]?></span> <?php if($x==3) break; } ?>
                                        
                                        <span class="label" style="color:#D2D7D3"> | </span>
                                        
                                        <span class="label label-default">
                                          <a href="javascript:void(0)" class="updateArtikel" data-toggle="modal" data-id="<?=$getArtclAndComment['ArtclId']?>" data-title="<?=$getArtclAndComment['ArtclTitle']?>" data-content="<?=$getArtclAndComment['ArtclContent']?>" data-type="<?=$getArtclAndComment['ArtclType']?>" data-target="#updateArtikel">

                                          <i class="fa fa-edit"></i></a>
                                        </span>
                                        
                                        <span onclick="window.location='<?=site_url('home/artikel/delete/'.$getArtclAndComment['ArtclId'])?>';" class="label label-default"><i class="fa fa-trash"></i> </span>
                                        
                                        <?php 
                                        } else { 
                                          for($x=0; $x<=(count($type)-1); $x++) { 
                                            $x == 1  ? $span='success' : ($x == 2 ? $span='danger' : $span='info');
                                        ?>
                                        
                                        <span class="label label-<?=$span?>"><?=$type[$x]?></span> <?php if($x==3) break; } ?> 
                                        <?php if($getArtclAndComment['CreatedBy'] == $UserEmailTrim) { ?>
                                        <span class="label" style="color:#D2D7D3"> | </span>
                                        <span class="label label-default"><a href="javascript:void(0)" class="updateArtikel" data-toggle="modal" data-id="<?=$getArtclAndComment['ArtclId']?>" data-title="<?=$getArtclAndComment['ArtclTitle']?>" data-content="<?=$getArtclAndComment['ArtclContent']?>"  data-type="<?=$getArtclAndComment['ArtclType']?>" data-target="#updateArtikel"><i class="fa fa-edit"></i></a></span>
                                        <span onclick="window.location='<?=site_url('home/artikel/delete/'.$getArtclAndComment['ArtclId'])?>';" class="label label-default"><i class="fa fa-trash"></i> </span>                                        
                                        <?php
                                              }
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
                   </div>
               </div>
            </div>
         </section>           
      </div>
       
      <?php $this->load->view('form/fauth'); ?>
      <?php $this->load->view('form/fpost'); ?>
      <?php $this->load->view('general/ekstern/foot'); ?>
    
      <!--UpdateArtikel-->
      <div class="modal fade" id="updateArtikel" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="artikel/updateArticle" method="post" id="uFormArticle" enctype="multipart/form-data" onsubmit="return false">
                    <input id="uArtclId" type="hidden" name="ArtclId" value="">  
                    
                    <!-- BEGIN Portlet PORTLET-->
                    <div class="portlet portlet-bordered">
                        <div class="portlet-container startStepone">
                            <div class="portlet-title">
                                <div class="caption caption-red">
                                    <span class="caption-subject"> Update Article </span>
                                </div>
                                <button type="button" class="btn fileUpload pull-right">
                                       <i class="fa fa-picture-o"></i> &nbsp; Change Picture
                                       <input class="upload" type="file" name="uArtclImage" title="(optional)" accept="image/*"/>
                                </button>
                               </div> 
                            </div>
                            <div class="portlet-body">
                                <div class="form-group">
                                   <label class="control-label" for="inputDefault">Title</label>
                                   <input id="uArtclTitle" type="text" name="ArtclTitle" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                   <label class="control-label" for="inputDefault">Content</label>
                                   <textarea id="uArtclContent" name="ArtclContent" rows="4" class="form-control"></textarea>
                                </div> 
                                <!-- <div class="form-group">
                                   <label class="control-label" for="inputDefault">Category</label>
                                    <select id="uArtclType" name="ArtclType" data-style="btn" class="form-control selectpicker show-menu-arrow show-tick">
                                        <?php 
                                        foreach($listtype as $getList) {
                                        $type = unserialize($getList->ArtclType);
                                        for($x=0; $x<=(count($type)-1); $x++) { 
                                        ?>
                                        
                                        <option value="<?=$type[$x]?>"><?=$type[$x]?></option>
                                        
                                        <?php if($x==5) break; } }  ?>
                                    </select>

                                </div>  -->
                                <div class="action_btns">
                                <div class="one_half">
                                    <div class="one_half"><button type="button" class="btn" data-dismiss="modal">Cancel</button></div> 
                                    <div class="one_half last"><button type="submit" class="btn btn-success uFinishArticle" disabled>Finish</button></div>
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
              <form method="post" action="<?=base_url()."home/artikel/deleteCommentArtcl"?>" id="formDeleteComment">
                <input type="hidden" name="CommentArticleId" id="CommentArticleId" value="">
                <button type="submit" class="btn btn-success ">Sure</button>
                <button class="btn" data-dismiss="modal">Cancel</button>
              </form>   
            </div>
          </div>
        </div>
      </div>
      <!--end-->    
       
        <!-- Custom Javascript -->
        <script type="text/javascript" src="<?=base_js()."page/article.js"?>" ></script>
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
                $(".chosen-select").chosen({
                  width: "100%", 
                  max_selected_options: 5,
                  no_results_text: "Category not found."
                });
                $('#checkAll').change(function () {
                    $("input:checkbox").prop('checked', $(this).prop("checked"));
                }); 
                $('.group-list') .pageMe({pagerSelector:'#paging',showPrevNext:true,hidePageNumbers:false,perPage:5});
                });
          });

          //updateartikel
          $(".updateArtikel").click(function(){
            var ArtclId = $(this).attr("data-id");
            $("#uArtclId").attr("value", ArtclId);
            var ArtclTitle = $(this).attr("data-title");
            $("#uArtclTitle").attr("value", ArtclTitle);
            var ArtclContent = $(this).attr("data-content");
            tinyMCE.get('uArtclContent').setContent(ArtclContent);
            var ArtclType = $(this).attr("data-type");
            $("#uArtclType").attr("value", ArtclType);
          });  

          //delete comment 
          $(".delete-comment").click(function(){       
            var CommentArticleId = $(this).attr("data-id-comment");
            $("#CommentArticleId").prop("value", CommentArticleId);
          });

        </script>
   </body>
</html>
