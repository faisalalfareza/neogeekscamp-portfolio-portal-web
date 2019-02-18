<?php
    $UserId = $this->session->userdata('sc_sess')['UserId'];  
    $UserEmail = $this->session->userdata('sc_sess')['UserEmail'];
    $UserEmailTrim = substr($UserEmail, strpos($UserEmail,"<")+0, strrpos($UserEmail, "@")-strpos($UserEmail,"<")-0);  
?>  

<!--News Modal-->
    <div class="modal news fade" id="createNews" role="dialog">
        <div class="modal-dialog ">
            <div class="modal-content">
                <form action="<?php echo base_url()."home/news/create"?>" method="post" id="formNews" class="formNews" enctype="multipart/form-data">
                <input type="hidden" name="CreatedBy" value="<?=$UserEmailTrim?>">    
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet portlet-bordered">
                     <div class="row">
                      <div class="col-lg-12">
                        <div class="centeredText ruleterms">
                          <div class="portlet-title">
                            <div class="caption caption-red">
                                <img src="<?=base_img()."icon/megaphone.png"?>" class="icon-form">
                                <span class="caption-subject" id="caption-news"></span>
                            </div>
                          </div>
                          <span>Share with your other friends about what's going on around you by filling out the form on your right side. <a>You can enter a title and a brief description of what news you want to tell other users.</a></span>
                        </div>   
                      </div>                     
                      <div class="col-lg-12">
                        <div id="msgNews"></div>  
                        <div class="portlet-body add">
                          <div class="form-group">
                             <label class="control-label" for="inputDefault">Title</label>
                             <input id="nwsTitle" type="text" name="NewsTitle" class="form-control input-form" placeholder="The title of your news" autofocus>
                          </div>
                          <div class="form-group">
                             <label class="control-label" for="inputDefault">Content</label>
                             <textarea id="nwsContent" name="NewsContent" class="form-control" placeholder="Give a brief description about this news .."></textarea>
                          </div>
                          <!--
                          <div class="form-group">
                             <input id="readContent" type="text" class="form-control">
                             <div id="lengthContent"></div>
                          </div>    
                          -->                    
                          <div class="action_btns">
                              <div class="one_half">
                                 <button type="button" class="btn fileUpload">
                                     <i class="fa fa-picture-o"></i> &nbsp; Add Picture
                                     <input class="upload" type="file" name="NewsImage" title="(optional)" accept="image/*"/>
                                 </button>
                             </div> 
                             <div class="one_half last"><button type="submit" class="btn btn-success finishNews" disabled>Post</button></div>     
                          </div>
                        </div>
                      </div> 
                    </div>
                </div>
                <!-- END Portlet PORTLET-->
                </form>   
            </div>
        </div>
    </div>
<!--/Post Modal-->                                 
                     
<!--Article Modal-->
    <div class="modal article fade" id="createArticle" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">   
                <!-- BEGIN Portlet PORTLET-->                     
                <div class="portlet article portlet-bordered">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="centeredText ruleterms">
                        <div class="portlet-title">
                            <div class="caption caption-red">
                                <img src="<?=base_img()."icon/list-project.png"?>" class="icon-form">
                                <span class="caption-subject" id="caption-article"></span>
                            </div>                       
                        </div> 
                        <span>Share with your other friends about what's going on around you by filling out the form on your right side. <a href="#">You can enter a title and a brief description of what news you want to tell other users.</a></span>
                        </div>                                                                  
                      </div>                    
                      <div class="col-lg-12">
                      <div id="msgArtcl"></div>
                      <!--
                      <div id="msgArticle"></div> 
                      <div id="loading-article" style="display:none;"><img src="<?=base_img()."loading.gif"?>"/></div> 
                      -->
                        <div class="portlet-body article_add">
                          <form action="<?php echo base_url()."home/artikel/create"?>" method="post" id="formArticle" class="formArticle" enctype="multipart/form-data" onsubmit="return false">
                          <input type="hidden" name="CreatedBy" value="<?=$UserEmailTrim?>">
                            <div class="form-group">
                               <label class="control-label" for="inputDefault">Title</label>
                               <input id="artTitle" type="text" name="ArtclTitle" class="form-control input-form" placeholder="The title of your article" required autofocus>
                            </div>
                            <div class="form-group">
                               <label class="control-label" for="inputDefault">Content</label>
                               <textarea value="" id="artContent" name="ArtclContent" class="form-control" placeholder="Give a brief description about this article .."></textarea>
                            </div>                            
                            <select id="artType" name="ArtclType[]" class="form-control chosen-select" data-placeholder="Select category" data-selected-text-format="count > 2" multiple>
                              <?php  foreach ($category as $getCategory) { ?>
                                <option value="<?=$getCategory->CategoryName?>"><?=$getCategory->CategoryName?></option>
                              <?php } ?>
                            </select>
                            <div class="action_btns">
                               <div class="one_half">
                                   <button type="button" class="btn fileUpload">
                                       <i class="fa fa-picture-o"></i> &nbsp; Add Picture
                                       <input class="upload" type="file" name="ArticleImage" accept="image/*"/>
                                   </button>
                               </div>     
                               <div class="one_half last"><button type="submit" class="btn btn-success finishArticle" disabled>Post</button></div>     
                            </div>
                          </form>  
                          <div class="modal-footer">
                            <a href="javascript:void(0);" class="add_category">Add new category ?</a>
                          </div>
                        </div>
                        <div class="portlet-body category_add">
                          <form id="formCategory" class="formCategory" action="<?php echo base_url()."home/artikel/category"?>" method="post">
                            <div class="form-group">
                               <input type="text" name="CategoryName" class="form-control input-form" placeholder="Category of your article" required autofocus>
                            </div>
                            <div class="action_btns">
                               <div class="one_half CatToArticle"><button type="button" class="btn">Back</button></div>     
                               <div class="one_half last"><button type="submit" class="btn btn-success">Add</button></div>     
                            </div>
                          </form>
                        </div>                         
                      </div>
                    </div>                   
                </div>
                <!-- Article -->
            </div>
        </div>
    </div>
<!--/Post Modal-->                  
                


