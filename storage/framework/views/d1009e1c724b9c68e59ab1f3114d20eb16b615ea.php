<?php $__env->startSection('content-header'); ?>

<h1>Contract Details</h1>
  <?php $__env->stopSection(); ?>

  <?php $__env->startSection('content'); ?>
   <div class="row">
        <!-- left column -->
        <form class ="form-horizontal" id="myform">
            <div class="col-md-6">
            	<div class ="box box primary">
            		<div class= "box-header with-border">
            				<h2 class ="box-title"> <b>Stall Information</b></h2>
            				<div class ="box-body">
            					<div class="form-group">
            						<div class="col-xs-3">
            							<label for="lastname"><b>Stall Name:</b></label>
            						</div>
            						<div class="col-xs-4">
            							<input type="text" class="form-control" id="stallName" value="A01" readonly>
            						</div>
            					</div>
            					<div class="form-group">
            						<div class="col-xs-3">
            							<label for="lastname"><b>Stall Type:</b></label>
            						</div>
            						<div class ="col-xs-4">
            							<input type="text" class="form-control" id="stallType" value="Box Type" readonly>
            						</div>
            					</div>
            					<div class="form-group">
            						<div class="col-xs-3">
            							<label for="lastname"><b>Floor No:</b></label>
            						</div>
            						<div class ="col-xs-4">
            							<input type="text" class="form-control" id="middlename" value="Floor 1" readonly>
            						</div>
            					</div>
                                <div class="form-group">
                                    <div class="col-xs-3">
                                        <label for="lastname"><b>Floor No:</b></label>
                                    </div>
                                    <div class ="col-xs-4">
                                        <input type="text" class="form-control" id="middlename" value="Floor 1" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-3">
                                        <label for="lastname"><b>Stall Status:</b></label>
                                    </div>
                                    <div class ="col-xs-4">
                                        <input type="text" class="form-control" id="middlename" value="Active" readonly>
                                    </div>
                                </div>
            				</div>
            		</div>
            		
            	</div>

            </div>
            <div class="col-md-6">
                <div class ="box box primary">
                    <div class= "box-header with-border">
                            <h2 class ="box-title"> <b>Rate Information</b></h2>
                            <div class ="box-body">
                                <div class="form-group">
                                    <div class="col-xs-3">
                                        <label for="lastname"><b>Stall Rate:</b></label>
                                    </div>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" id="stallName" value="Php 00.00" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-3">
                                        <label for="lastname"><b>Rate per Day:</b></label>
                                    </div>
                                    <div class ="col-xs-4">
                                        <input type="text" class="form-control" id="stallType" value="Php 00.00" readonly>
                                    </div>
                                </div>
                            </div>
                    </div>
                    
                </div>

            </div>
            <div class="col-md-6">
                <div class ="box box primary">
                    <div class= "box-header with-border">
                            <h2 class ="box-title"> <b>Terms and Conditions</b></h2>
                            <div class ="box-body">
                                <div class="form-group">
                                    <div class="col-xs-3">
                                        <label for="lastname"><b>Implementation Date:</b></label>
                                    </div>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" id="stallName" value="6/27/2017" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-3">
                                        <label for="lastname"><b>Contract Validity:</b></label>
                                    </div>
                                    <div class ="col-xs-4">
                                        <input type="text" class="form-control" id="stallType" value="1yr 2 months" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-3">
                                        <label for="lastname"><b>Expiration Date:</b></label>
                                    </div>
                                    <div class ="col-xs-4">
                                        <input type="text" class="form-control" id="stallType" value="10/10/2020" readonly>
                                    </div>
                                </div>
                            </div>
                    </div>
                    
                </div>

            </div>
         
        	

        </form>
        <div class="col-md-6">
                <a href="/ViewContracts"><button  class="btn btn-primary" align="left">Back</button></a>
            </div>


      </div>
      <!-- /.row -->
  <?php $__env->stopSection(); ?>
  <?php $__env->startSection('script'); ?>
  	<script>
  		  //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
    function clearForm()
{
    $(':input').not(':button, :submit, :reset, :hidden, :checkbox, :radio').val('');
    $(':checkbox, :radio').prop('checked', false);
}
  	</script>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>