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
                            <label>Create Request</label>
                      </div>
                      <div>
                          <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form>
                                    <div class="alert alert-danger print-error-msg" style="display:none">
                                      <ul></ul>
                                      </div>
                                         
                                        <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Stall Holder:</label>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control stallHolder" style="width: 100%;" name="newHolderName">
                                                      <option disabled selected="selected">--Select--</option>
                                                      <?php $__currentLoopData = $stalls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stall): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($stall->stallHID); ?>" ><?php echo e($stall->stallHFName); ?><?php echo e($stall->stallHMName); ?><?php echo e($stall->stallHLName); ?></option>
                                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                     
                                                  </select> 
                                            </div>
                                          </div>
                                        </div>
                                         <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Request Type:</label>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control requestType" style="width: 100%;" name="newType"> 
                                                      <option disabled selected="selected">--Select--</option>
                                                      <option value="1">Transfer Request</option>
                                                      <option value="2">Cancel Contract</option>
                                                      <option value="3">Others</option>
                                                  </select> 
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px;display: none;" id="typeTransfer">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Transfer stall:</label>
                                            </div>
                                            <div class="col-md-4">
                                                <table width="100%" class="table table-bordered table-striped">
                                                    <thead>
                                                      <tr>
                                                        <th>From:</th>
                                                        <th>To:</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody class='activeStall'>
                                                          <tr>
                                                              <td>
                                                              <select class="form-control stallRentFrom" style="width: 100%;" name="transferStallRentID">
                                                                   <option disabled selected="selected">--Select Stall--</option>
                                                                
                                                                </select> 
                                                              </td>
                                                              <td>
                                                                  <select class="form-control stallRentTo" style="width: 100%;" name="stallRentTo">
                                                                   <option disabled selected="selected">--Select Stall--</option>
                                                                    <?php $__currentLoopData = $avails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $avail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($avail->stallID); ?>"><?php echo e($avail->stallID); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                                          
                                                                </select>     
                                                              </td>
                                                          </tr>
                                                        
                                                    </tbody>
                                                </table> 
                                            </div>
                                          </div>
                                        </div>
                                         <div class="col-md-12" style="margin-top: 10px;display: none;" id="typeCancel">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Cancel Contract</label>
                                            </div>
                                            <div class="col-md-4">
                                                <table width="100%" class="table table-bordered table-striped">
                                                    <thead>
                                                      <tr>
                                                        <th>Stall Code:</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody class="contract">
                                                        <tr>
                                                          <td>
                                                              <select class="form-control stallRentFrom" style="width: 100%;" name="cancelStallRentID">
                                                                   <option disabled selected="selected">--Select Stall--</option>
                                                                                                        
                                                                </select>    
                                                          </td>
                                                        </tr>
                                                    </tbody>
                                                </table> 
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px;display: none;" id="typeOthers">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Others</label>
                                            </div>
                                            <div class="col-md-4">
                                                <table width="100%" class="table table-bordered table-striped">
                                                    <thead>
                                                      <tr>
                                                        <th>Stall Code:</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody class="contract">
                                                        <tr>
                                                          <td>
                                                              <select class="form-control stallRentFrom" style="width: 100%;" name="otherStallRentID">
                                                                   <option disabled selected="selected">--Select Stall--</option>
                                                                                                        
                                                                </select>    
                                                          </td>
                                                        </tr>
                                                    </tbody>
                                                </table> 
                                            </div>
                                          </div>
                                        </div>
                                         <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Request Description:</label>
                                            </div>
                                            <div class="col-md-6">
                                              <textarea class="form-control" name="newDesc"></textarea>
                                            </div>
                                          </div>
                                        </div>
                                         <div class="col-md-12" style="margin-top: 10px;">
                                            <div class="pull-right">
                                                <button class="btn btn-primary" id="save" ><i class="fa fa-save"></i> Save</button>
                                                 <button class="btn btn-danger"><a href="/requestList">Cancel</a> </button>
                                            </div>
                                        </div>

                                    </form>
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
<script src ="<?php echo e(URL::asset('assets/select2/select2.js')); ?>"></script>
<!-- <script type="text/javascript" src ="js/request.js"></script> -->
<script type="text/javascript">
  $(".stallHolder").select2();
  $(".stallTo").select2();
  $(".stallRentFrom").select2();
  $(".stallRentTo").select2();
  $(document).on('change','.stallHolder',function(){
     id = $(this).val();
    ;
     $('.aList').remove();
     $.ajax({
        type: "GET",
        url: '/requestList/getStall/'+id,
        success: function(data)  {
           $.each(data.active.active_stall_rental,function(key,value){
              $('.stallRentFrom').append('<option class="aList" value="'+value.stallRentalID+'">'+value.stallID+'</option>');  
           });
          
        }  
     });
  })
  $(document).on('click','#save', function(e){
    e.preventDefault();
    var _token = $("input[name='_token']").val();
    var Type = $("select[name='newType']").val();
    var Desc = $("textarea[name='newDesc']").val();
    var Status = 0;
    var Remarks = null;
    var ApprovedDate = null;
    if(Type==1){
         var RentalID = $("select[name='transferStallRentID']").val();
         var RentTo = $("select[name='stallRentTo']").val();
         console.log(RentTo);
             $.ajax({
              type: "POST",
              url: "/requestList",
              data: { 
                '_token' : $('input[name=_token]').val(),
                'newRentalID':RentalID,
                'newType': Type,
                'newDesc': Desc,
                'newStatus':Status,
                'newRemarks':Remarks,
                'newApprovedDate': ApprovedDate,                
                'newRentTo':RentTo
                
                  },
                success: function(data) {
                  if($.isEmptyObject(data.error)){
                    toastr.success('Request Added');
                    window.location = '/requestList';
                  }else{
                    printErrorMsg(data.error);
                  }
                }

              });
             function printErrorMsg (msg) {
              $(".print-error-msg").find("ul").html('');
              $(".print-error-msg").css('display','block');
              $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
              });
            }


    }
    else if(Type==2){
       var RentalID = $("select[name='cancelStallRentID']").val();
            $.ajax({
              type: "POST",
              url: "/requestList",
              data: { 
                '_token' : $('input[name=_token]').val(),
                'newRentalID':RentalID,
                'newType': Type,
                'newDesc': Desc,
                'newStatus':Status,
                'newRemarks':Remarks,
                'newApprovedDate': ApprovedDate 
                  },
                success: function(data) {
                  if($.isEmptyObject(data.error)){
                    toastr.success('Request Added');
                    window.location = '/requestList';
                  }else{
                    printErrorMsg(data.error);
                  }
                }

              });
             function printErrorMsg (msg) {
              $(".print-error-msg").find("ul").html('');
              $(".print-error-msg").css('display','block');
              $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
              });
            }
    }
    else if(Type==3){
      var RentalID = $("select[name='otherStallRentID']").val();
          $.ajax({
              type: "POST",
              url: "/requestList",
              data: { 
                '_token' : $('input[name=_token]').val(),
                'newRentalID':RentalID,
                'newType': Type,
                'newDesc': Desc,
                'newStatus':Status,
                'newRemarks':Remarks,
                'newApprovedDate': ApprovedDate
                  },
                success: function(data) {
                  if($.isEmptyObject(data.error)){
                    toastr.success('Request Added');
                    window.location = '/requestList';
                  }else{
                    printErrorMsg(data.error);
                  }
                }

              });
             function printErrorMsg (msg) {
              $(".print-error-msg").find("ul").html('');
              $(".print-error-msg").css('display','block');
              $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
              });
            }
    }


   
    
  })
  $(document).on('change', '.requestType',function(){
    id=$(this).val();
    if(id==1){
      $('#typeTransfer').show();
      $('#typeCancel').hide();
      $('#typeOthers').hide();

    }
    else if(id==2){
      $('#typeTransfer').hide();
      $('#typeCancel').show();
      $('#typeOthers').hide();
    }
    else if(id==3){
      $('#typeOthers').show();
      $('#typeTransfer').hide();
      $('#typeCancel').hide();
    }
  })




</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>