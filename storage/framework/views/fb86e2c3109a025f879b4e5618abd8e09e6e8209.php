<?php $__env->startSection('title'); ?>
<?php echo e('New Request'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-header'); ?>

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i> Manage Requests</li>
  <li class="active">New Request</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<style>
  #floortbl td{
   padding-bottom:5px;
 }
 #floortbl th, #floortbl td{
  text-align: center;
}




</style>
<div class="box box-solid box-default">
  <div class="box-body" >
    <div class="col-md-12">
      <div class="box box-solid box-primary">
        <div class="box-header with-border">
          <label>New Request</label>
        </div>
        <div>
          <div class="box-body">
            <div class="col-md-12">
              <div class="col-md-3">
                <div class="col-md-12">
                  <label >Request No.</label>
                </div>
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" disabled=""> 
              </div>
              <br style="line-height: 40px">
            </div>
            <div class="col-md-12">
              <div class="col-md-3">
                <div class="col-md-12">
                  <label >Requestor's Name</label>
                </div>
              </div>
              <div class="col-md-9">
                <select class="form-control"> 
                  <option>Brixter Kim Duenas</option>
                </select>
              </div>
              <br style="line-height: 40px">
            </div>
            <hr>
            <div class="col-md-12">
              <div class="col-md-3">
                <label class="col-md-12">Request Type<span class="required">&nbsp*</span></label>
              </div>
              <div class="col-md-9">
                <select class="form-control" id="changerequest"> 
                  <option value="0">Request of Transfer</option>
                  <option value="1">Cancel Of Contract</option>
                  <option value="2">Others</option>
                </select>
              </div><br style="line-height: 40px">
            </div>

            <br style="line-height: 40px">
            <div class="col-md-12">
              <div class="col-md-6" id="transferstall"> 
                <div class="col-md-6">
                  <label>Select Stall<span class="required">&nbsp*</span></label>
                </div>
                <div class="col-md-6">
                  <div class="input-group">
                    <select class="form-control">
                      <option>--Select Stall--</option>
                      <option>A001</option>
                      <option>option 3</option>
                      <option>option 4</option>
                      <option>option 5</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-6" id="otherdesc" style="display: none">
                <div class="col-md-6">
                  <label>Other Subject<span class="required">&nbsp*</span></label>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control">
                </div>
              </div>

              <div class="col-md-6" id="display">
                <div class="col-md-3">
                  <label  class="col-md-3"> Desired Stall<span class="required">&nbsp*</span></label>  
                </div>
                <div clas="col-md-9">
                <div class="" id="pucha">
                    <div class="input-group">
                      <input  type="text" class="form-control" disabled="">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat">Select Stall</button>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <br style="line-height: 40px">
            <div class="col-md-12">
              <div class="col-md-3">
                <label class="col-md-12">Desired Date<span class="required">&nbsp*</span></label>
              </div>
              <div class="col-md-9">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask/>
                </div>
              
              </div>
            </div>
            <br style="line-height: 40px">

            <div class="col-md-12">
              <div class="col-md-3">
                <label class="col-md-12">Description of Request<span class="required">&nbsp*</span></label>
              </div>
              <div class="col-md-9">
                <textarea class="form-control" rows="3"></textarea>
              </div>
            </div>


            <div class="col-md-12">
              <p class="small text-danger">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspFields with asterisks(*) are required</p>
            </div>
            
            <div class="col-md-12 ">
              <button type="buton" class="btn btn-primary pull-right">Submit
                <button type="buton" class="btn btn-default pull-right">Cancel
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script type="text/javascript">


  $(document).ready(function(){

    $('#changerequest').on('change', function() {
      if ( this.value == '0')
      {
        document.getElementById("display").className =('col-md-6');
        document.getElementById("pucha").className =('');
        $("#transferstall").show();
        $("#otherdesc").hide();
      }
      else if(this.value == '2')
      {
        document.getElementById("display").className =('col-md-6');
        document.getElementById("pucha").className =('');
        $("#transferstall").hide();
        $("#otherdesc").show();
      }else
      {
        document.getElementById("display").className =('col-md-12`');
        document.getElementById("pucha").className =('col-md-9');
        $("#transferstall").hide();
        $("#otherdesc").hide();
      }
    });
  });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>