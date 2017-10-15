<?php $__env->startSection('title'); ?>
<?php echo e('Contract List'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-header'); ?>
<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i> Transactions</li>
  <li>Manage Contracts</li>
  <li class="active">Contract List</li>
</ol>

<style>
.required {
    color: red;
} 
.col-md-12 column {  
   text-align:center;
}
.col-md-12 column form {
   display:inline-block;
}

</style>
  <?php $__env->stopSection(); ?>

  <?php $__env->startSection('content'); ?>
      <div class="box box-solid box-primary">
        <div class="box-header with-border">
          <label class = "box-header-label"> Contract List</label>
        </div>
      <div>
            <!-- /.box-header -->
            <div class="box-body">
           
            <div class = "table-responsive">
              <table id="tblcontract" class="table table-bordered table-striped" width="100%">
              
                <thead>
                <tr>
                  <th>No</th>
                  <th>Stall ID</th>
                  <th>Name</th>
                  <th>Contract Effectivity Date</th>
                  <th>Contract End Date</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <td> 1</td>
                  <td>1</td>
                  <td>Brixter Duenas</td>
                  <td>August 20, 2017</td>
                  <td>August 20,2018</td>
                  <td><label class = "label label-success">Active</label></td>
                  <td>
                  <button type='Submit' class='btn btn-flat btn-primary'><span class = 'fa fa-print'></span>&nbspPrint</button> 
                  <button type='Submit' class='btn btn-flat btn-primary' data-toggle='modal' data-target='#view'><span class = 'fa fa-eye'></span>&nbspView</button>
                  <button type="Submit" class="btn btn-flat btn-danger"><span class = "fa fa-ban"></span>&nbspCancel</button>
                  </td>
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </div>
          <!-- MODAL -->
          <!-- Modal -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete</h4>
      </div>
      <div class="modal-body">
        <h2>Are you sure?</h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success">Yes</button>
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
                        <div class = "col-md-12 form-group row">
                            <div class = "col-md-6">
                              <label for = "name">Stall Holder Name/ Organization:&nbsp</label> 
                              </div>
                              <div class = "col-md-6">
                              <p id = "nameAndOrg">Iwa motors of Tanya Markova</p>
                          </div>
                        </div>
                         <div class = "col-md-12 form-group row">
                            <div class = "col-md-6">
                              <label for = "name">Stall ID:&nbsp</label> 
                              </div>
                              <div class = "col-md-6">
                              <p id = "stall_no">bldg2-00001</p>
                          </div>
                        </div>
                        <div class = "col-md-12 form-group row">
                          <div class = "col-md-4">
                            <label for = "length">Length of Contract</label><span class="required">&nbsp*</span>
                           </div>
                           <div class = "col-md-8">
                            <input type = "text" id = "specific_no" name = "specific_no" placeholder="" />
                           
                            
                            <select name = "length" id = "length">
                             
                            </select>
                                 
                          </div>
                  <p class="small text-danger" style="margin-top: 40px; margin-left: 20px;">Fields with asterisks(*) are required</p>
                    </div>
                  
                       
      </div>
      <div class="modal-footer">
         <button class="btn btn-info" style="background-color:#191966">Submit</button>
      </div>
    </div>
  </div>
</div>
  <?php $__env->stopSection(); ?>

  <?php $__env->startSection('script'); ?>
   
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>