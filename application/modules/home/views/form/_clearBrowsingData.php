<?php $UserId = $this->session->userdata('sc_sess')['UserId']; ?>   

  <div class="modal fade" id="clear_log" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
          <form action="<?php echo base_url()."home/history/clearBrowsingData"?>" method="post">
          <input type="hidden" name="UserId" value="<?=$UserId?>">
              <div class="modal-header" style="background-color: #fff">
                  <h4 class="modal-title">Clear Browsing Data</h4>
              </div>
              <div class="modal-body">
                <div class="list-group">
                  <div class="alert alert-warning"><strong>Psst!</strong> Incognito mode (Ctrl+Shift+N) may come in handy next time. </div>
                  <!-- Authenticate History -->
                  <div class="list-group-item log">
                      <div class="checkbox pull-left">
                          <label> <input type="checkbox" name="authenticate" value="01" checked> </label>   
                      </div>
                      <div class="pull-left form-control-inline">
                          <a class="list-group-item-heading title">Authenticate History</a>
                          <p class="list-group-item-text sub-title">
                            note when you do activity when you get in and out of neogeeks
                          </p>     
                      </div>
                      <div class="clearfix"></div>
                  </div>                  
                  <!-- CUD History -->
                  <div class="list-group-item log">
                      <div class="checkbox pull-left">
                          <label> <input type="checkbox" name="transaction" value="234"> </label>   
                      </div>
                      <div class="pull-left form-control-inline">
                          <a class="list-group-item-heading title">Create, Update, and Delete History</a>
                          <p class="list-group-item-text sub-title">
                            note when you do an activity additions, alterations, or delete data in the database 
                          </p>     
                      </div>
                      <div class="clearfix"></div>
                  </div>  
                  <!-- Asign History -->
                  <div class="list-group-item log">
                      <div class="checkbox pull-left">
                          <label> <input type="checkbox" name="asign" value="5" checked> </label>   
                      </div>
                      <div class="pull-left form-control-inline">
                          <a class="list-group-item-heading title">Asigning History</a>
                          <p class="list-group-item-text sub-title">
                            note when you do a process of entering data such as (member or project) <br> into other data in database 
                          </p>     
                      </div>
                      <div class="clearfix"></div>
                  </div>
                  <!-- Confirmation History -->
                  <div class="list-group-item log">
                      <div class="checkbox pull-left">
                          <label> <input type="checkbox" name="confirm" value="6" checked> </label>   
                      </div>
                      <div class="pull-left form-control-inline">
                          <a class="list-group-item-heading title">Confirmation History</a>
                          <p class="list-group-item-text sub-title">
                            note when you perform a confirmation process a data
                          </p>     
                      </div>
                      <div class="clearfix"></div>
                  </div>                                                             
                </div> 

                <div class="col-lg-10"></div>
                <div class="col-lg-14">
                 <div class="action_btns">
                   <div class="one_half"><button type="submit" class="btn">Clear Browsing Data</button></div>
                   <div class="one_half last"><button type="button" data-dismiss="modal" class="btn">Cancel</button></div>     
                 </div>
                </div>

              </div>
              <div class="modal-footer" style="background-color: #ecf0f1">
                 <div class="centeredText ruleterms">
                   <i class="fa fa-info-circle"></i>
                   <span>By clearing data, you agree to delete your history such as <a href="#">Authenticate History</a>, <a href="#">Master CUD</a>, <a href="#">Asign History</a> and <a href="#">Confirmation History</a>.</span>
                 </div>                  
              </div>
          </form>
          </div>
      </div>
  </div>