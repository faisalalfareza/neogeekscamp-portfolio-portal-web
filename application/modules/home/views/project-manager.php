<?php
    $UserId = $this->session->userdata('sc_sess')['UserId']; 
    $this->load->view('general/ekstern/head'); 
?>     
       
      <!-- Main Content -->
      <div class="content-box">
         <!-- Destinations Section -->
         <section class="section section-destination">
            <!-- Title -->
            <div class="section-title">
               <div class="container">
                  <h2 class="title"><img src="<?=base_img()."icon/briefcase.png"?>"> &nbsp; <?=$title?></h2>
                  <p class="sub-title">Confirmation of any project that comes in, before entering into the list of projects that will be done</p>
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
                            <li><a href="<?=site_url('home/usermanage')?>"><img src="<?=base_img()."icon/pie-chart.png"?>"> &nbsp; User Manager</a></li>                          
                            <li><a href="<?=site_url('forum')?>"><img src="<?=base_img()."icon/telemarketer.png"?>"> &nbsp; Forum Discussion</a></li>   
                            <li><a href="<?=site_url('home/artikel')?>"><img src="<?=base_img()."icon/list-project.png"?>"> &nbsp; Collection Articles</a></li>                         
                            <li><a href="<?=site_url('home/news')?>"><img src="<?=base_img()."icon/megaphone.png"?>"> &nbsp; Latest News</a></li>                     
                        </ul>
                    </div>  
                   </div>
                   <div class="col-lg-14">
                    <?=$this->session->flashdata('pesan')?>                                               
                       
                    <div class="tab-content usermanager">
                        <div role="tabpanel" class="tab-pane active" id="activate">
                            <?=form_open('home/projectmanage/activate_group')?>
                            <div class="list-group">
                                    <a class="list-group-item">
                                        <div class="checkbox pull-left">
                                            <label>
                                                <input type="checkbox" type="checkbox" id="allWaiting"> 		
                                            </label>   
                                        </div>
                                        <div class="pull-left form-control-inline">
                                            <h4 class="list-group-item-heading title">
                                                <span class="label label-success checkAll">Check all waiting projects</span>
                                            </h4>			
                                        </div>   
                                        <div class="clearfix"></div>
                                    </a>                            
                                <?php
                                    foreach($nonactive as $getProjectNonActive){
                                      $ProDesc = strip_tags($getProjectNonActive->ProDesc);
                                      if (strlen($ProDesc) > 90) {
                                        // truncate string
                                        $stringCut = substr($ProDesc, 0, 90);
                                        $ProDesc = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
                                      }
                                ?>
                                    <!--Start User Data-->
                                    <div class="waiting-list">
                                      <div class="list-group-item">
                                          <div class="checkbox pull-left">
                                              <label>
                                                  <input type="checkbox" class="waiting" name="item[]" value="<?=$getProjectNonActive->ProId?>">
                                              </label>   
                                          </div>
                                          <div class="pull-left form-control-inline">
                                              <a href="#popup" class="list-group-item-heading title"><?=$getProjectNonActive->ProName?></a>
                                              <p class="list-group-item-text sub-title"><?=$ProDesc?></p>
                                            
                                              <!--<p class="list-group-item-text sub-title">accept</p>	-->		
                                          </div>
                                          <div class="pull-right">
                                             <span onclick="window.location='<?=site_url('home/projectmanage/activate/'.$getProjectNonActive->ProId)?>';" class="label label-info" class="label label-info">Accept</span>                                
                                              <span onclick="window.location='<?=site_url('home/projectmanage/delete/'.$getProjectNonActive->ProId)?>';" class="label label-danger">Delete</span>    
                                          </div>    
                                          <div class="clearfix"></div>
                                      </div>
                                    </div>
                                    <!--End User Data-->
                                <?php
                                    }
                                ?>  
                                <ul class="pagination pagination-sm mark" id="paging-waiting"></ul>                         
                            </div>
                            <button type="submit" class="btn"><i class="fa fa-check-circle-o"></i> &nbsp; Accept</button>
                            <?=form_close()?>                         
                        </div>
                        <div role="tabpanel" class="tab-pane" id="deactive">
                            <?=form_open('home/projectmanage/deactivate_group')?>
                            <div class="list-group">
                                    <a class="list-group-item">
                                        <div class="checkbox pull-left">
                                            <label>
                                                <input type="checkbox" type="checkbox" id="allAccepted"> 		
                                            </label>   
                                        </div>
                                        <div class="pull-left form-control-inline">
                                            <h4 class="list-group-item-heading title">
                                                <span class="label label-success checkAll">Check all accepted projects</span>
                                            </h4>			
                                        </div>   
                                        <div class="clearfix"></div>
                                    </a>                            
                                <?php
                                    foreach($active as $getProjectActive){
                                      $ActiveDesc = strip_tags($getProjectActive->ProDesc);
                                      if (strlen($ActiveDesc) > 90) {
                                        // truncate string
                                        $stringCut = substr($ActiveDesc, 0, 90);
                                        $ActiveDesc = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
                                      }
                                ?>
                                    <!--Start User Data-->
                                    <div class="accepted-list">
                                      <div class="list-group-item">
                                          <div class="checkbox pull-left">
                                              <label>
                                                  <input type="checkbox" class="accepted" name="item[]" value="<?=$getProjectActive->ProId?>">		
                                              </label>   
                                          </div>
                                          <div class="pull-left form-control-inline">
                                              <h1 href="#popup" class="list-group-item-heading title"><?=$getProjectActive->ProName?></h1>
                                              <p class="list-group-item-text sub-title"><?=$ActiveDesc?></p>			
                                          </div>
                                          <div class="pull-right">
                                              <span onclick="window.location='<?=site_url('home/projectmanage/deactivate/'.$getProjectActive->ProId)?>';" class="label label-warning">Disscard</span>                       
                                              <span onclick="window.location='<?=site_url('home/projectmanage/delete/'.$getProjectActive->ProId)?>';" class="label label-danger">Delete</span>    
                                          </div>    
                                          <div class="clearfix"></div>
                                      </div>
                                    </div>
                                    <!--End User Data-->
                                <?php
                                    }
                                ?> 
                                <ul class="pagination pagination-sm mark" id="paging-accepted"></ul>                          
                            </div>
                            <button type="submit" class="btn"><i class="fa fa-check-circle-o"></i> &nbsp; Disscard</button>
                            <?=form_close()?>
                        </div>
                        </div>                                             
                   </div>
                   <div class="col-lg-4">
                    <div class="sidebar content-box left-box" style="display: block;">
                        <ul class="nav">
                            <!-- Main menu -->              
                            <li><a href="#activate" aria-controls="activate" role="tab" data-toggle="tab">Waiting projects</a></li>
                            <li><a href="#deactive" aria-controls="deactive" role="tab" data-toggle="tab">Accepted projects</a></li>                       
                        </ul>
                    </div>                     
                   </div>
               </div>
            </div>
         </section>           
      </div> 
       
      <?php $this->load->view('form/fauth'); ?>
      <?php $this->load->view('form/fpost'); ?> 
      <?php $this->load->view('general/ekstern/foot'); ?>    

        <!-- Custom Javascript -->
        <script type="text/javascript" src="<?=base_js()."page/home.js"?>" ></script>
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
                $('#allWaiting').change(function () {
                    $("input:checkbox.waiting").prop('checked', $(this).prop("checked"));
                });
                $('#allAccepted').change(function () {
                    $("input:checkbox.accepted").prop('checked', $(this).prop("checked"));
                });     
                $('.accepted-list')
                    .pageMe({pagerSelector:'#paging-accepted',showPrevNext:true,hidePageNumbers:false,perPage:3});
                $('.waiting-list')
                    .pageMe({pagerSelector:'#paging-waiting',showPrevNext:true,hidePageNumbers:false,perPage:3});                            
              });
          });
             
        </script>       
   </body>
</html>
