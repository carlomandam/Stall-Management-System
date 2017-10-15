<?php $__env->startSection('title'); ?>
<?php echo e('Registration List'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-header'); ?>

<ol class="breadcrumb">
	<li><i class="fa fa-dashboard"></i> Transactions</li>
	<li>Manage Contracts</li>
	<li class="active">Registration List</li>
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


<div class="box box-solid box-primary">
	<div class="box-header with-border">
		<label class = "box-header-label"> Registration List</label>
	</div>
	<div>

		<div class="box-body">

			<div class="col-xs-12">


			


						<div class="table-responsive">
							<table id="tblreg" class="table table-striped" role="grid">
								<thead>
									<tr>
										<th style="width: 300px;">Name</th>
										<th style="width: 300px;">Address</th>
										<th style="width: 200px;">Contact No.</th>
										<th style="width: 200px;">Registration Date</th>
										<th style="width: 500px;">Actions</th>
									</tr>
								</thead>
						
							</table>
						</div>
					
			</div>
		</div>
	</div>
</div>
<!--/.modal new contract=-->
<!--modal view-->
 <div class="modal fade" id="newcontract" 
     tabindex="-1" role="dialog" 
     aria-labelledby="newModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" 
        id="newModalLabel">New Contract</h4>
      </div>
      <div class="modal-body">
                        <div class = "col-md-12 form-group">
                            <div class = "col-md-6">
                              <label for = "name">Stall Holder Name/ Organization:&nbsp</label> 
                              </div>
                              <div class = "col-md-6">
                              <p id = "nameAndOrg">Iwa motors of Tanya Markova</p>
                          </div>
                        </div>
                         <div class = "col-md-12 form-group">
                            <div class = "col-md-6">
                              <label for = "name">Stall ID:&nbsp</label> 
                              </div>
                              <div class = "col-md-6">
                              <p id = "stall_no">bldg2-00001</p>
                          </div>
                        </div>
                        <div class = "col-md-12 form-group">
                          <div class = "col-md-4">
                            <label for = "length">Length of Contract</label><span class="required">&nbsp*</span>
                           </div>
                           <div class = "col-md-8">
                            <input type = "text" id = "specific_no" name = "specific_no" placeholder="" />
                           
                            
                            <select name = "length" id = "length">
                             	<option>Week/s</option>
                             	<option>Month/s</option>
                             	<option>Year/s</option>
                             	<option>Year-To-Year</option>
                             	</select>
                            </select>
                                 
                          </div>
                  <p class="small text-danger" style="margin-top: 40px; margin-left: 20px;">Fields with asterisks(*) are required</p>
                    </div>
                  
                       
      </div>
      <div class="modal-footer">
         <button class="btn btn-primary btn-flat" >Submit</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cancel Registration</h4>
      </div>
      <div class="modal-body">
        <h4>Are you sure?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary btn-flat">Yes</button>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
	$(document).ready(function(){
		$.get('/getRegistrationList', function(data){
				var table = $('#tblreg').DataTable().clear();
				console.log(data);
				$.each(data, function(i,data){
					table.row.add([
						
						data.stallHolderName,
						data.Address,
						data.ContactNo,
						data.RegDate,
						"<button type='Submit' class='btn btn-flat btn-success'data-toggle='modal' data-target='#newcontract'  ><span class = 'fa  fa-angle-double-right'></span>&nbspCreate Contract</button> <button type='Submit' onclick='window.location="+'"'+"<?php echo e(url('/UpdateRegistration/"+this.value+"')); ?>"+'"'+"' class='btn btn-flat btn-primary' value = '"+data.rentID+"'><span class = 'fa fa-pencil'></span>&nbspUpdate</button> <button type='Submit' class='btn btn-flat btn-danger' data-toggle='modal' data-target='#delete' ><span class = 'fa fa-ban'></span>&nbspCancel</button>"
						
					
                        
						]).draw();
				});
			});


	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>