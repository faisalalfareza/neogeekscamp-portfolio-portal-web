<?php
    $UserId = $this->session->userdata('sc_sess')['UserId']; 
    $this->load->view('general/intern/head'); 
?>  
    
    <section id="projects">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-8">
                    <div class="row">
                        <div class="col-sm-12">
                            <nav class="navbar navbar-info navbar-static resume">
                                <div class="col-sm-12">
                                    <div class="navbar-header resume">
                                        <button class="btn btn-submit navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
                                            Collection Resume &nbsp; <i class="fa fa-th-large"></i>
                                        </button>
                                    </div>
                                </div>    

                                <div class="collapse navbar-collapse js-navbar-collapse">
                                    <ul class="nav navbar-nav resume">
                                        <li>
                                                                                      
                                            <a class="menu" href="javascript:void(0)" data-backdrop="false" data-toggle="modal" data-target="#createResume"><img src="<?=base_img()."icon/file-2.png"?>" class="icon-menu"> &nbsp; Add Resume </a> 
                                            
                                        </li>
                                        <li class="dropdown dropdown-large"> 
                                            <a href="#" class="dropdown-toggle menu" data-toggle="dropdown"><img src="<?=base_img()."icon/menu-7.png"?>" class="icon-menu"> &nbsp; Filter By</a>

                                            <ul class="dropdown-menu dropdown-menu-large row">
                                                <li class="col-sm-4">
                                                    <ul class="portfolio-filter resume">
                                                        <li class="dropdown-header">Job Desk</li>
                                                        <li><a class="active" href="#" data-filter="*">All</a></li>
                                                        <?php 
                                                            foreach($job as $getJob){
                                                        ?>
                                                        <li><a href="#" data-filter=".<?=$getJob->RsumJob?>"><?=$getJob->RsumJob?></a></li>
                                                        <?php 
                                                            } 
                                                        ?>
                                                    </ul><!--/#portfolio-filter-->
                                                </li>
                                                <li class="col-sm-4">
                                                    <ul class="portfolio-filter resume">
                                                        <li class="dropdown-header">Skill or Ability</li>
                                                        <li><a class="active" href="#" data-filter="*">All</a></li>
                                                        <?php 
                                                            foreach($skill as $getSkill){
                                                        ?>
                                                        <li><a href="#" data-filter=".<?=$getSkill->RsumSkill1?>"><?=$getSkill->RsumSkill1?></a></li>                                                    
                                                        <?php 
                                                            } 
                                                        ?>
                                                    </ul><!--/#portfolio-filter-->
                                                </li>     
                                                <li class="col-sm-4">
                                                    <ul>
                                                        <li class="dropdown-header">Position</li>
                                                        <li><a class="asc" href="javascript:void(0);">Ascending</a></li>
                                                        <li><a class="desc" href="javascript:void(0);">Descending</a></li>
                                                        <li class="divider"></li> 
                                                        <li class="dropdown-header">Alphabetical</li>
                                                        <li><a class="alph" href="javascript:void(0);" data-sort-value="name">In alphabetical order</a></li>  
                                                    </ul>
                                                </li>    
                                            </ul>

                                        </li>
                                    </ul>

                                </div><!-- /.nav-collapse -->
                            </nav>   
                        
                    <?=$this->session->flashdata('pesan')?>    
                            
                        <div class="portfolio-items">
                            <?php 
                                foreach($resume as $getResume){
                                    if(!(empty($resume))){
                            ?>
                                        <div class="col-xs-6 col-sm-6 col-md-4 portfolio-item <?=$getResume->RsumJob?> <?=$getResume->RsumSkill1?> <?=$getResume->RsumSkill2?> <?=$getResume->RsumSkill3?> <?=$getResume->RsumSkill4?> <?=$getResume->RsumSkill5?>">
                                            <div class="portfolio-wrapper">
                                                <div class="portfolio-single">
                                                    <div class="portfolio-thumb">
                                                        <?php if ($getResume->RsumImage != null) {?>
                                                        <img src="<?=$getResume->RsumImage?>" class="img-responsive" alt="">
                                                        <?php } else { ?>
                                                        <img src="<?= base_img()."4.jpg" ?>" class="img-responsive" alt="">
                                                        <?php } ?>
                                                        
                                                        <div class="thumb-caption">
                                                            <h4 class="name"><?=$getResume->RsumName?></h4>
                                                            <div class="check pull-right"><i class="fa fa-check-circle"></i></div>                                                
                                                            <h6 class="sites">As <?=$getResume->RsumJob?></h6>
                                                            <p>Focus on <?=$getResume->RsumSkill1?> <?=$getResume->RsumSkill2?> <?=$getResume->RsumSkill3?> <?=$getResume->RsumSkill4?> <?=$getResume->RsumSkill5?> and i'm graduate from <?=$getResume->LastEducation1?></p>
                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-success six-sec-ease-in-out" role="progressbar"  data-transition="<?=$getResume->SkillPercent?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="portfolio-view">
                                                        <ul class="nav nav-pills">
                                                        <?php
                                                        if($role->RoleId == 1) {
                                                        ?>
                                                        <li><a href="<?=site_url('home/resume/cvDetails/'.$this->encrypt->encode($getResume->RsumId))?>">
                                                            <i class="fa fa-link"></i></a>
                                                        </li>                                                   
                                                         <li>
                                                             <a href="javascript:void(0)" class="updateResume" data-backdrop="false" data-toggle="modal" data-target="#updateResume" 
                                                                 data-id="<?=$getResume->RsumId?>"
                                                                 data-name="<?=$getResume->RsumName?>" 
                                                                 data-telp="<?=$getResume->RsumTelp?>"  
                                                                 data-job="<?=$getResume->RsumJob?>" 
                                                                 data-skill1="<?=$getResume->RsumSkill1?>" 
                                                                 data-skill2="<?=$getResume->RsumSkill2?>" 
                                                                 data-skill3="<?=$getResume->RsumSkill3?>" 
                                                                 data-skill4="<?=$getResume->RsumSkill4?>" 
                                                                 data-skill5="<?=$getResume->RsumSkill5?>" 
                                                                 data-percent="<?=$getResume->SkillPercent?>"
                                                                 data-lasteducation1="<?=$getResume->LastEducation1?>"
                                                                 data-lasteducation2="<?=$getResume->LastEducation2?>"
                                                                 data-lasteducation3="<?=$getResume->lasteducation3?>"
                                                                 data-achieve1="<?=$getResume->Achieve1?>" 
                                                                 data-achieve2="<?=$getResume->Achieve2?>" 
                                                                 data-achieve3="<?=$getResume->Achieve3?>" 
                                                                 data-birthdate="<?=$getResume->BirthDate?>" 
                                                                 data-gender="<?=$getResume->Gender?>" 
                                                                 data-religion="<?=$getResume->Religion?>">
                                                            <i class="fa fa-edit"></i></a>
                                                        </li>                                                              
                                                        <li>
                                                            <a class="delete delete-resume" href="javascript:void(0)" data-toggle="modal" data-target="#delresume" data-id="<?=$getResume->RsumId?>" data-image="<?=$getResume->RsumImage?>"><i class="btn fa fa-trash-o"></i></a>
                                                        </li> 
                                                        <?php
                                                        } else {
                                                        ?>
                                                        <li><a href="<?=site_url('home/resume/cvDetails/'.$this->encrypt->encode($getResume->RsumId))?>">
                                                            <i class="fa fa-link"></i></a>
                                                        </li>                
                                                        <?php
                                                            if($getResume->UserId == $UserId){
                                                        ?>
                                                         <li>
                                                             <a href="javascript:void(0)" class="edit updateResume" data-backdrop="false" data-toggle="modal" data-target="#updateResume" 
                                                                 data-id="<?=$getResume->RsumId?>"
                                                                 data-name="<?=$getResume->RsumName?>" 
                                                                 data-telp="<?=$getResume->RsumTelp?>"  
                                                                 data-job="<?=$getResume->RsumJob?>" 
                                                                 data-skill1="<?=$getResume->RsumSkill1?>" 
                                                                 data-skill2="<?=$getResume->RsumSkill2?>" 
                                                                 data-skill3="<?=$getResume->RsumSkill3?>" 
                                                                 data-skill4="<?=$getResume->RsumSkill4?>" 
                                                                 data-skill5="<?=$getResume->RsumSkill5?>" 
                                                                 data-percent="<?=$getResume->SkillPercent?>"
                                                                 data-lasteducation1="<?=$getResume->LastEducation1?>"
                                                                 data-lasteducation2="<?=$getResume->LastEducation2?>"
                                                                 data-lasteducation3="<?=$getResume->lasteducation3?>"
                                                                 data-achieve1="<?=$getResume->Achieve1?>" 
                                                                 data-achieve2="<?=$getResume->Achieve2?>" 
                                                                 data-achieve3="<?=$getResume->Achieve3?>" 
                                                                 data-birthdate="<?=$getResume->BirthDate?>" 
                                                                 data-gender="<?=$getResume->Gender?>" 
                                                                 data-religion="<?=$getResume->Religion?>">
                                                            <i class="fa fa-edit"></i></a>
                                                        </li>                                                        
                                                        <li><a class="delete delete-resume" href="javascript:void(0)" data-toggle="modal" data-target="#delresume" data-id="<?=$getResume->RsumId?>" data-image="<?=$getResume->RsumImage?>"> 
                                                            <i class="btn fa fa-trash-o"></i></a>
                                                        </li>                                                             
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="portfolio-info "></div>
                                            </div>
                                        </div>   
                            <?php
                                    }
                                    else {
                            ?>        
                                        <div class='alert alert-warning'> Belum ada resume </div>
                            <?php
                                    }
                                }
                            ?>                            
                        </div>
                        </div>    
                    </div>
                </div>
                <div class="col-md-3 col-sm-4">
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
    <!--/#projects-->

    <?php $this->load->view('form/fresume.php'); ?>
    <?php $this->load->view('general/intern/foot'); ?>

    <!-- Custom Javascript -->
    <script type="text/javascript" src="<?=base_js()."page/portfolio.js"?>" ></script>
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
            $(".form-group select").dropdown();
            $('.modal-dialog').draggable();
            $('.popup-container').draggable();
            $('#checkAll').change(function () {
                $("input:checkbox").prop('checked', $(this).prop("checked"));
            }); 
            $('.pro-list').pageMe({pagerSelector:'#paging-pro',showPrevNext:true,hidePageNumbers:false,perPage:2});
            $('.addpro-list').pageMe({pagerSelector:'#paging-addpro',showPrevNext:true,hidePageNumbers:false,perPage:2});   
            // $("#rsmBirth").datetimepicker({
            //     format: "dd MM yyyy - HH:ii P",
            //     showMeridian: true,
            //     autoclose: true,
            //     todayBtn: false
            // });            
          });         

            //updateresume
            var formUpdate  = document.getElementById("formUpdateResume");
            //step one
            var ursmName = document.getElementById("ursmName");
            var ursmGender = document.getElementById("ursmGender");
            var ursmReligion = document.getElementById("ursmReligion");
            //step two
            var ursmEmail = document.getElementById("ursmEmail");
            var ursmTelp = document.getElementById("ursmTelp");
            //step three
            var ursmSkill1 = document.getElementById("ursmSkill1");
            var ursmPrcent = document.getElementById("ursmPrcent");
            var ursmJob = document.getElementById("ursmJob");
            //step four
            var ursmEducation1 = document.getElementById("ursmEducation1");
            var ursmAchieve1 = document.getElementById("ursmAchieve1");
            //step five
            
            var umsgOne     = document.getElementById("umsgOne");
            var umsgTwo     = document.getElementById("umsgTwo");
            var umsgThree   = document.getElementById("umsgThree");
            var umsgFour    = document.getElementById("umsgFour"); 

            //step one
            ursmName.onkeyup        = function () { validateuStepone() };
            ursmGender.onchange     = function () { validateuStepone() };
            ursmReligion.onchange   = function () { validateuStepone() };
            //step two
            ursmTelp.onkeyup        = function () { 
                validateuSteptwo(); 
                this.value          = this.value.replace(/[^0-9.]/g,'');
            };
            //step three
            ursmSkill1.onkeyup = function () { validateuStepthree() };
            ursmPrcent.onkeyup = function () { this.value = this.value.replace(/[^0-9.]/g,''); };
            ursmJob.onkeyup = function () { validateuStepthree() };
            //step four
            ursmEducation1.onkeyup = function () { validateuStepfour() };
            
            //Function Update
            function validateuStepone() {
                if (ursmName.value && ursmGender.value && ursmReligion.value != "") {
                    $('.uendStepone').prop('disabled', false);
                    formUpdate.onsubmit = function () { return true };
                }
                else {
                    $('.uendStepone').prop('disabled', true);
                    formUpdate.onsubmit = function () { return false };
                }
            } 
            function validateuSteptwo() {
                if (ursmTelp.value != "") {
                    $('.uendSteptwo').prop('disabled', false);
                    formUpdate.onsubmit = function () { return true };
                }
                else{
                    $('.uendSteptwo').prop('disabled', true);
                    formUpdate.onsubmit = function () { return false };
                }
            }
            function validateuStepthree() {
                if (ursmSkill1.value && ursmJob.value != "") {
                    $('.uendStepthree').prop('disabled', false);
                    formUpdate.onsubmit = function () { return true };
                    umsgThree.innerHTML = '<div class="alert alert-success"> Good </div>';
                }
                else {
                    $('.uendStepthree').prop('disabled', true);
                    formUpdate.onsubmit = function () { return false };
                    umsgThree.innerHTML = '<div class="alert alert-warning"> Fill the blank </div>';
                }
            } 
            function validateuStepfour() {
                if (ursmEducation1.value != "") {
                    $('.uendStepfour').prop('disabled', false);
                    formUpdate.onsubmit = function () { return true };
                    umsgFour.innerHTML = '<div class="alert alert-success"> Good </div>';
                }
                else {
                    $('.uendStepfour').prop('disabled', true);
                    formUpdate.onsubmit = function () { return false };
                    umsgFour.innerHTML = '<div class="alert alert-warning"> Fill the blank </div>';
                }
            }            
      });

      $(".updateResume").click(function(){
        var RsumId = $(this).attr("data-id");
        $("#urRsumId").attr("value", RsumId);
        document.cookie = "rsumid="+RsumId;
        //msgone
        var RsumName = $(this).attr("data-name");
        $("#ursmName").attr("value", RsumName);
        var Gender = $(this).attr("data-gender");
        document.cookie = "gender="+Gender;
        var BirthDate = $(this).attr("data-birthdate");
        $("#uBirthDate").attr("value", BirthDate);
        var Religion = $(this).attr("data-religion");
        document.cookie = "religion="+Religion;
        //msgtwo    
        var RsumTelp = $(this).attr("data-telp");
        $("#ursmTelp").attr("value", RsumTelp); 
        //msgthree
        var JobDesk = $(this).attr("data-job");
        $("#ursmJob").attr("value", JobDesk);
        var SkillPercent = $(this).attr("data-percent");
        $("#ursmPrcent").attr("value", SkillPercent);
        //msgfour
        var RsumSkill1 = $(this).attr("data-skill1");
        $("#ursmSkill1").attr("value", RsumSkill1);
        var RsumSkill2 = $(this).attr("data-skill2");
        $("#ursmSkill2").attr("value", RsumSkill2);
        var RsumSkill3 = $(this).attr("data-skill3");
        $("#ursmSkill3").attr("value", RsumSkill3);   
        var RsumSkill4 = $(this).attr("data-skill4");
        $("#ursmSkill4").attr("value", RsumSkill4);
        var RsumSkill5 = $(this).attr("data-skill5");
        $("#ursmSkill5").attr("value", RsumSkill5);
        var LastEducation1 = $(this).attr("data-lasteducation1");
        $("#ursmEducation1").attr("value", LastEducation1);
        var LastEducation2 = $(this).attr("data-lasteducation2");
        $("#ursmEducation2").attr("value", LastEducation2);
        var LastEducation3 = $(this).attr("data-lasteducation3");
        $("#ursmEducation3").attr("value", LastEducation3);
        var Achieve1 = $(this).attr("data-achieve1");
        $("#ursmAchieve1").attr("value", Achieve1);
        var Achieve2 = $(this).attr("data-achieve2");
        $("#ursmAchieve2").attr("value", Achieve2);
        var Achieve3 = $(this).attr("data-achieve3");
        $("#ursmAchieve3").attr("value", Achieve3);
      });        
      //delete forum 
      $(".delete-resume").click(function(){       
        var idRsum = $(this).attr("data-id");
        $("#RsumId").prop("value", idRsum);

        var imageRsum = $(this).attr("data-image");
        $("#RsumImage").prop("value", imageRsum);
      });        
    </script>

</body>
</html>
