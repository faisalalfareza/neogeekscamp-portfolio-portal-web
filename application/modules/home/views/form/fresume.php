<?php $UserId = $this->session->userdata('sc_sess')['UserId']; ?>  

    <!--Create Resume-->
    <div class="modal fade" id="createResume" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="resume/create" method="post" id="formResume" class="formResume" enctype="multipart/form-data" onsubmit="return false">
                    
                <input type="hidden" name="UserId" value="<?=$UserId?>">    
                    
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet portlet-bordered">
                    <div class="portlet-container startStepone">
                        <div class="portlet-title">
                            <div class="col-sm-6">
                                <div class="caption caption-red">
                                    <img src="<?=base_img()."icon/file-1.png"?>" class="icon-form">
                                    <span class="caption-subject"> Profile </span>
                                    <span class="caption-helper"> For Employee </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group fileUpload pull-right">
    
                                  <div class="one_half">
                                    <button type="button" class="btn fileUpload">
                                       <i class="fa fa-picture-o"></i> &nbsp; Add Avatar
                                       <input type="file" name="image" class="upload" accept="image/*" />    
                                    </button>
                                  </div>

                                </div>
                            </div>
                        </div>
                        <div id="msgOne"></div>
                        <div class="portlet-body">
                            <div class="col-sm-6">
                                <div class="form-group">
                                   <label class="control-label" for="inputDefault">Name</label>
                                   <input id="rsmName" type="text" name="RsumName" class="form-control input-form" placeholder="Name of the member ?" autofocus>
                                </div>
                                <div class="form-group">
                                   <label class="control-label" for="inputDefault">Gender</label>
                                   <select id="rsmGender" name="Gender" class="form-control selectpicker show-menu-arrow show-tick" title="Select a gender">
                                        <option value="male"> &nbsp; Male</option>
                                        <option value="female"> &nbsp; Female</option>
                                    </select>
                                </div>                               
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="inputSmall">Date of Birth</label>
                                    <div class="input-group date" id="form_dt" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                        <input type="text" id="rsmBirth" name="BirthDate" class="form-control input-form" placeholder="When the member is born ?" required readonly/>
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="hidden" id="dtp_input2" value="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                   <label class="control-label" for="inputDefault">Religion</label>
                                   <select id="rsmReligion" name="Religion" class="form-control selectpicker show-menu-arrow show-tick" title="Select a religion">
                                        <option value="islam">Islam</option>
                                        <option value="kristen">Kristen</option>
                                        <option value="hindu">Hindu</option>
                                        <option value="budha">Budha</option>
                                        <option value="konghucu">Konghucu</option>
                                    </select>
                                </div>
                                <div class="action_btns">
                                   <div class="one_half"><button type="button" id="exit_profile" data-dismiss="modal" class="btn">Cancel</button></div> 
                                   <div class="one_half last"><button type="submit" class="btn btn-success endStepone" disabled>Next</button></div>     
                                </div>                                
                            </div>
                            <div class="action_btns"></div>
                        </div>
                    </div>    
                    <div class="portlet-container startSteptwo">
                        <div class="portlet-title">
                            <div class="caption caption-red">
                                <button type="button" class="close" id="exit_contact"><i class="fa fa-times-circle"></i></button>
                                <span class="caption-subject"> Contact </span>
                                <span class="caption-helper"> For Employee </span>
                            </div>
                        </div>
                        <div id="msgTwo"></div>
                        <div class="portlet-body">
                            <div class="col-sm-6">
                                <div class="form-group">
                                   <label class="control-label" for="inputDefault">Email</label>
                                   <input id="rsmEmail" type="email" name="RsumEmail" class="form-control input-form" placeholder="example@visionet.co.id" autofocus>
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                   <label class="control-label" for="inputDefault">Phone Number</label>
                                   <div class="input-group">
                                       <div class="input-group-addon">+62</div>
                                       <input id="rsmTelp" type="text" name="RsumTelp" minlength="10" maxlength="11" class="form-control input-form">
                                   </div>
                                </div> 
                                <div class="action_btns">
                                   <div class="one_half"><button type="button" class="btn" id="exit_two">Back</button></div> 
                                   <div class="one_half last"><button type="button" class="btn btn-success endSteptwo" disabled>Next</button></div>     
                                </div>
                            </div>
                            <div class="action_btns"></div>
                        </div>
                    </div> 
                    <div class="portlet-container startStepthree">
                        <div class="portlet-title">
                            <div class="caption caption-red">
                                <button type="button" class="close" id="exit_job"><i class="fa fa-times-circle"></i></button>
                                <span class="caption-subject"> Job Experience </span>
                                <span class="caption-helper"> From Employee </span>
                            </div>
                        </div>
                        <div id="msgThree"></div>
                        <div class="portlet-body">
                            <button type="button" id="tambah" class="btn btn-success btn-outline"><i class="fa fa-plus-circle"></i> &nbsp; Add Skill</button> <br><br>
                            
                            <div class="col-sm-6">             
                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Skill or Ability</label>
                                    <input type="text" id="rsmSkill1" name="RsumSkill1" class="form-control input-form" placeholder="Ability that you have ?">
                                </div>
                                <div id="group"></div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                   <label class="control-label" for="inputDefault">Job Desk</label>
                                   <input id="rsmJob" type="text" name="RsumJob" class="form-control input-form" placeholder="Your position now ?" autofocus>
                                </div> 
                                <div class="form-group">
                                   <label class="control-label" for="inputDefault">Presentation skills</label>
                                   <div class="input-group">
                                       <input id="rsmPrcent" type="text" name="SkillPercent" class="form-control input-form" placeholder="What percentage of your Skill ?">
                                       <div class="input-group-addon">%</div>
                                   </div>
                                </div>                                
                                <div class="action_btns">
                                   <div class="one_half"><button type="button" class="btn" id="exit_three">Back</button></div> 
                                   <div class="one_half last"><button type="button" class="btn btn-success endStepthree" disabled>Next</button></div>     
                                </div>
                            </div>
                            <div class="action_btns"></div>
                        </div>
                    </div>
                    <div class="portlet-container startStepfour">
                        <div class="portlet-title">
                            <div class="caption caption-red">
                                <button type="button" class="close" id="exit_education"><i class="fa fa-times-circle"></i></button>
                                <span class="caption-subject"> Education Experience </span>
                                <span class="caption-helper"> From Employee </span>
                            </div>
                        </div>
                        <div id="msgFour"></div>
                        <div class="portlet-body">
                            <div class="col-sm-6">  
                                <button type="button" id="addEducation" class="btn btn-success btn-outline"><i class="fa fa-plus-circle"></i> &nbsp; Add another education</button> <br><br>
                                
                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Last Education</label>
                                    <input type="text" id="rsmEducation1" name="LastEducation1" class="form-control input-form" placeholder="Last education you live ?" autofocus>
                                </div>
                                <div id="education-group"></div>
                            </div> 
                            <div class="col-sm-6">
                                <button type="button" id="addAchieve" class="btn btn-success btn-outline"><i class="fa fa-plus-circle"></i> &nbsp; Add another achievment</button> <br><br>
                                
                                <div class="form-group">
                                   <label class="control-label" for="inputDefault">Achievment</label>
                                   <input id="rsmAchieve1" type="text" name="Achieve1" class="form-control input-form" placeholder="Award what you have achieved ?">
                                </div> 
                                <div id="achievment-group"></div>
                                <div class="action_btns">
                                   <div class="one_half"><button type="button" class="btn" id="exit_four">Back</button></div> 
                                   <div class="one_half last"><button type="button" class="btn btn-success endStepfour" disabled>Project</button></div>     
                                </div>
                            </div>
                            <div class="action_btns"></div>
                        </div>
                    </div>
                    <div class="portlet-container startStepfive">
                        <div class="portlet-title">
                            <div class="caption caption-red">
                                <button type="button" class="close" id="exit_project"><i class="fa fa-times-circle"></i></button>
                                <span class="caption-subject"> History Project </span>
                                <span class="caption-helper"> Employee </span>
                            </div>
                        </div>
                        <div id="msgFive"></div>
                        <div class="portlet-body">
                            <ul class="pagination pagination-sm mark" id="paging"></ul>
                            <div class="list-group">
                                <?php 
                                    foreach($project as $getPro){
                                ?>
                                <div class="pro-list">
                                    <div class="list-group-item">
                                        <div class="checkbox pull-left">
                                            <label>
                                                <input type="checkbox" name="item[]" value="<?=$getPro->ProId?>">                                        
                                            </label>   
                                        </div>
                                        <div class="pull-left form-control-inline">
                                            <a href="" class="list-group-item-heading title"><?=$getPro->ProName?></a>
                                            <p class="list-group-item-text sub-title"><?=$getPro->ProDesc?></p>			
                                        </div>  
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                                <ul class="pagination pagination-sm mark" id="paging-pro"></ul>
                                
                            </div>
                            <div class="col-sm-6"></div>
                            <div class="col-sm-6">
                                <div class="action_btns">
                                   <div class="one_half"><button type="button" class="btn" id="exit_five">Back</button></div> 
                                   <div class="one_half last"><button type="submit" class="btn btn-success endStepfive">Finish</button></div>     
                                </div>  
                            </div>
                            <div class="action_btns"></div>
                        </div>
                    </div>                    
                </div>
                <!-- END Portlet PORTLET-->
                </form>
            </div>
        </div>
    </div>
    <!--/End Modal-->

    <!--Update Resume-->
    <div class="modal fade" id="updateResume" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="resume/updateresume" method="post" id="formUpdateResume" class="formUpdateResume" enctype="multipart/form-data">
                <input id="urRsumId" type="hidden" name="RsumId" value=""> 
                    
                <input type="hidden" name="UserId" value="<?=$UserId?>">    
                    
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet portlet-bordered">
                    <div class="portlet-container ustartStepone">
                        <div class="portlet-title">
                            <div class="col-sm-6">
                                <div class="caption caption-red">
                                    <img src="<?=base_img()."icon/file-1.png"?>" class="icon-form">
                                    <span class="caption-subject"> Profile </span>
                                    <span class="caption-helper"> For Employee </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group fileUpload pull-right">
    
                                  <div class="one_half">
                                    <button type="button" class="btn fileUpload">
                                       <i class="fa fa-picture-o"></i> &nbsp; Change Avatar
                                       <input type="file" name="image" class="upload" accept="image/*" />    
                                    </button>
                                  </div>

                                </div>
                            </div>
                        </div>
                        <div id="umsgOne"></div>
                        <div class="portlet-body">
                            <div class="col-sm-6">
                                <div class="form-group">
                                   <label class="control-label" for="inputDefault">Name</label>
                                   <input id="ursmName" type="text" name="RsumName" class="form-control input-form" placeholder="Name of the member ?" autofocus value="">
                                </div>
                                <div class="form-group">
                                        <?php 
                                           $gender =  $_COOKIE['gender'];
                                        ?>
                                   <label class="control-label" for="inputDefault">Gender</label>
                                   <select id="ursmGender" name="Gender" class="form-control selectpicker show-menu-arrow show-tick">
                                            <?php if($gender=='male'){
                                            $selectedmale = 'selected'; } ?>
                                            
                                            <?php if($gender=='female'){
                                            $selectedfemale = 'selected'; } ?>

                                        <option value="male" id='male' <?=$selectedmale?>> &nbsp; Male</option>
                                        <option value="female" id='female' <?=$selectedfemale?>> &nbsp; Female</option>
                                    </select>
                                </div>                               
                            </div> 
                            <div class="col-sm-6">

                                <div class="form-group">
                                        <?php 
                                           $religion =  $_COOKIE['religion'];

                                        ?>
                                   <label class="control-label" for="inputDefault">Religion</label>
                                   <select id="ursmReligion" name="Religion" class="form-control selectpicker show-menu-arrow show-tick">
                                            
                                            <?php if($religion=='islam'){
                                            $sislam = 'selected'; } ?>
                                            
                                            <?php if($religion=='kristen'){
                                            $skristen = 'selected'; } ?>

                                            <?php if($religion=='hindu'){
                                            $shindu = 'selected'; } ?>

                                            <?php if($religion=='budha'){
                                            $sbudha = 'selected'; } ?>

                                            <?php if($religion=='konghucu'){
                                            $skonghucu = 'selected'; } ?>

                                        <option value="islam" id='islam' <?=$sislam?>>Islam</option>
                                        <option value="kristen" id='kristen' <?=$skristen?>>Kristen</option>
                                        <option value="hindu" id='hindu' <?=$shindu?>>Hindu</option>
                                        <option value="budha" id='budha' <?=$sbudha?>>Budha</option>
                                        <option value="konghucu" id='konghucu' <?=$skonghucu?>>Konghucu</option>
                                    </select>
                                </div>
                                <div class="action_btns">
                                   <div class="one_half"><button type="button" id="uexit_profile" data-dismiss="modal" class="btn">Cancel</button></div> 
                                   <div class="one_half last"><button type="button" class="btn btn-success uendStepone">Next</button></div>     
                                </div>                                
                            </div>
                            <div class="action_btns"></div>
                        </div>
                    </div>    
                    <div class="portlet-container ustartSteptwo">
                        <div class="portlet-title">
                            <div class="caption caption-red">
                                <button type="button" class="close" id="uexit_contact"><i class="fa fa-times-circle"></i></button>
                                <span class="caption-subject"> Contact </span>
                                <span class="caption-helper"> For Employee </span>
                            </div>
                        </div>
                        <div id="umsgTwo"></div>
                        <div class="portlet-body">
                            <div class="col-sm-6">
                                <div class="form-group">
                                   <label class="control-label" for="inputDefault">Phone Number</label>
                                   <div class="input-group">
                                       <div class="input-group-addon">+62</div>
                                       <input id="ursmTelp" type="text" name="RsumTelp" minlength="10" maxlength="11" value="" class="form-control input-form">
                                   </div>
                                </div> 
                                <div class="action_btns">
                                   <div class="one_half"><button type="button" class="btn" id="uexit_two">Back</button></div> 
                                   <div class="one_half last"><button type="button" class="btn btn-success uendSteptwo" >Next</button></div>     
                                </div>
                            </div>
                            <div class="action_btns"></div>
                        </div>
                    </div> 
                    <div class="portlet-container ustartStepthree">
                        <div class="portlet-title">
                            <div class="caption caption-red">
                                <button type="button" class="close" id="uexit_job"><i class="fa fa-times-circle"></i></button>
                                <span class="caption-subject"> Job Experience </span>
                                <span class="caption-helper"> From Employee </span>
                            </div>
                        </div>
                        <div id="umsgThree"></div>
                        <div class="portlet-body">
                            <div class="col-sm-6">             
                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Skill or Ability</label>
                                    
                                    <input type="text" id="ursmSkill1" name="RsumSkill1" class="form-control input-form" placeholder="Ability that you have ?" value="<?=$getSkill->RsumSkill1?>">
                                    <br>
                                    <input type="text" id="ursmSkill2" name="RsumSkill2" class="form-control input-form" placeholder="Ability that you have ?" value="<?=$getSkill->RsumSkill2?>">
                                    <br>
                                    <input type="text" id="ursmSkill3" name="RsumSkill3" class="form-control input-form" placeholder="Ability that you have ?" value="<?=$getSkill->RsumSkill3?>">
                                    <br>
                                    <input type="text" id="ursmSkill4" name="RsumSkill4" class="form-control input-form" placeholder="Ability that you have ?" value="<?=$getSkill->RsumSkill4?>">
                                    <br>
                                    <input type="text" id="ursmSkill5" name="RsumSkill5" class="form-control input-form" placeholder="Ability that you have ?" value="<?=$getSkill->RsumSkill5?>">
                                    <br>
                                </div>
                                <div id="ugroup"></div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                   <label class="control-label" for="inputDefault">Job Desk</label>
                                   <input id="ursmJob" type="text" name="RsumJob" class="form-control input-form" placeholder="Your position now ?" autofocus>
                                </div> 
                                <div class="form-group">
                                   <label class="control-label" for="inputDefault">Presentation skills</label>
                                   <div class="input-group">
                                       <input id="ursmPrcent" type="text" name="SkillPercent" class="form-control input-form" placeholder="What percentage of your Skill ?">
                                       <div class="input-group-addon">%</div>
                                   </div>
                                </div>                                
                                <div class="action_btns">
                                   <div class="one_half"><button type="button" class="btn" id="uexit_three">Back</button></div> 
                                   <div class="one_half last"><button type="button" class="btn btn-success uendStepthree" >Next</button></div>     
                                </div>
                            </div>
                            <div class="action_btns"></div>
                        </div>
                    </div>
                    <div class="portlet-container ustartStepfour">
                        <div class="portlet-title">
                            <div class="caption caption-red">
                                <button type="button" class="close" id="uexit_education"><i class="fa fa-times-circle"></i></button>
                                <span class="caption-subject"> Education Experience </span>
                                <span class="caption-helper"> From Employee </span>
                            </div>
                        </div>
                        <div id="umsgFour"></div>
                        <div class="portlet-body">
                            <div class="col-sm-6">  
                                <!-- <button type="button" id="uaddEducation" class="btn btn-success btn-outline"><i class="fa fa-plus-circle"></i> &nbsp; Add another education</button> <br><br> -->
                                
                                <div class="form-group">
                                    <label class="control-label" for="inputDefault">Last Education</label>
                                    <input type="text" id="ursmEducation1" name="LastEducation1" class="form-control input-form" placeholder="Last education you live ?" autofocus>
                                
                                    <input type="text" id="ursmEducation2" name="LastEducation2" class="form-control input-form" placeholder="Last education you live ?" autofocus>
                                
                                    <input type="text" id="ursmEducation3" name="LastEducation3" class="form-control input-form" placeholder="Last education you live ?" autofocus>
                                </div>
                                <div id="ueducation-group"></div>
                            </div> 
                            <div class="col-sm-6">
                                <!-- <button type="button" id="uaddAchieve" class="btn btn-success btn-outline"><i class="fa fa-plus-circle"></i> &nbsp; Add another achievment</button> <br><br> -->
                                
                                <div class="form-group">
                                   <label class="control-label" for="inputDefault">Achievment</label>
                                   <input id="ursmAchieve1" type="text" name="Achieve1" class="form-control input-form" placeholder="Award what you have achieved ?">
                                
                                   <input id="ursmAchieve2" type="text" name="Achieve2" class="form-control input-form" placeholder="Award what you have achieved ?">
                                
                                   <input id="ursmAchieve3" type="text" name="Achieve3" class="form-control input-form" placeholder="Award what you have achieved ?">
                                </div>
                                <div id="uachievment-group"></div>
                                <div class="action_btns">
                                   <div class="one_half"><button type="button" class="btn" id="uexit_four">Back</button></div> 
                                   <div class="one_half last"><button type="button" class="btn btn-success uendStepfour">Project</button></div>     
                                </div>
                            </div>
                            <div class="action_btns"></div>
                        </div>
                    </div>
                    <div class="portlet-container ustartStepfive">
                        <div class="portlet-title">
                            <div class="caption caption-red">
                                <button type="button" class="close" id="uexit_project"><i class="fa fa-times-circle"></i></button>
                                <span class="caption-subject"> History Project </span>
                                <span class="caption-helper"> Employee </span>
                            </div>
                        </div>
                        <div id="umsgFive"></div>
                        <div class="portlet-body">
                        <div class="alert alert-info" id="alert">Discard project with "<i class="fa fa-check"></i>"</div>
                            <div class="list-group">
                                 <?php 
                                        $rsumid =  $_COOKIE['rsumid'];
                                        $link = mysqli_connect('localhost', 'root', '', 'db_ngc');
                                        $query = "SELECT * from tbresume_project where RsumId=".$rsumid;
                                        $queryjoin = "SELECT * from tbproject WHERE ProId in (SELECT ProId from tbresume_project where RsumId=".$rsumid.")";
                                        $result = mysqli_query($link, $query); 
                                        $join = mysqli_query($link, $queryjoin);
                                        
                                        foreach($project as $getPro){
                                            
                                            while($row = mysqli_fetch_object($result)) { $id = $row->ProId; 
                                            while($getJoin = mysqli_fetch_object($join)) {
                                        ?>
                                <div class="addpro-list">
                                    <div class="list-group-item">
                                        <div class="checkbox pull-left">
                                            <label>
                                                <input type="checkbox" name="item[]" value="<?=$id?>">
                                            </label>   
                                        </div>
                                        <div class="pull-left form-control-inline">
                                            <a href="" class="list-group-item-heading title"><?=$getJoin->ProName?></a>
                                            <p class="list-group-item-text sub-title"><?=$getJoin->ProDesc?></p>         
                                        </div>  
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <?php
                                        }
                                    }
                                }
                                ?>
                                <ul class="pagination pagination-sm mark" id="paging-addpro"></ul>                                       
                            </div>
                            <div class="col-sm-6"></div>
                            <div class="col-sm-6">
                                <div class="action_btns">
                                   <div class="one_half"><button type="button" class="btn" id="uexit_five">Back</button></div> 
                                   <div class="one_half last"><button type="submit" class="btn btn-success uendStepfive">Finish</button></div>     
                                </div>  
                            </div>
                            <div class="action_btns"></div>
                        </div>
                    </div>                    
                </div>
                <!-- END Portlet PORTLET-->
                </form>
            </div>
        </div>
    </div>
    <!--/End Modal-->    

    <!--Delete Modal-->
     <div class="modal fade" id="delresume">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Resume</h4>
            </div>
            <div class="modal-body">
                <br>
              <p class="modal-title">Are you sure ?</p>
                <br>
              <form method="post" action="resume/delete" id="formDeleteResume">
                <input type="hidden" name="rsumid" id="RsumId" value="">
                <input type="hidden" name="rsumimage" id="RsumImage" value="">
                <button type="submit" class="btn btn-raised btn-success">Sure</button>
                <button class="btn" data-dismiss="modal">Cancel</button>
              </form>   
            </div>
          </div>
        </div>
     </div>
    <!--end-->
