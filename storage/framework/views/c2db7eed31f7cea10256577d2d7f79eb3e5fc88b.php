<?php $__env->startSection('content-header'); ?>

<h1>Contract</h1>
      
  <?php $__env->stopSection(); ?>

  <?php $__env->startSection('content'); ?>
  	  <div class="box">
            <div class="box-header">
              <a href="/CreateContract"><button class="btn btn-primary">Create New Contract</button></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Stall Name</th>
                  <th>Stall Type</th>
                  <th>Business Type</th>
                  <th>Due Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
           			<tr>
           				<td>A01</td>
           				<td>Box Type</td>
           				<td>Goods and Garments</td>
                  <td>----</td>
                  <td>Active</td>
           				<td>
           					<a href="/ShowDetails"><button class ="btn btn-success">Show Details</button></a>
           					<button class="btn btn-danger" data-toggle="modal" data-target="#delete">Cancel Contract</button>
           				</td>
           			</tr>
                <tr>
                  <td>A02</td>
                  <td>Cart</td>
                  <td>Foods</td>
                  <td>----</td>
                  <td>Active</td>
                  <td>
                    <a href="/ShowDetails"><button class ="btn btn-success">Show Details</button></a>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#delete">Cancel Contract</button>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- MODAL -->
          <!-- Modal -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cancel Contract</h4>
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
  <?php $__env->stopSection(); ?>

  <?php $__env->startSection('script'); ?>
  	<script>
	  $(function () {
	    $("#example1").DataTable();
	    
	  });
</script>

  <?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>