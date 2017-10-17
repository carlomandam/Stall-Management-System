<?php $__env->startSection('title'); ?>
<?php echo e('Request'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-header'); ?>

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i>Manage Request</li>
  <li class="active">Request List</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div>
  <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
    <div class="box box-solid box-default">
        <div class="box-body" >
            <div class="col-md-12">
                  <div class="box box-solid box-primary">
                        <div class="box-header with-border">
                        </div>
                        <div>
                              <div class="box-body">
                                   <?php $__currentLoopData = $req; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <div class="row">
                                      <div class="col-md-2">
                                        <label>Request Type</label>
                                      </div>
                                     
                                      <div class="col-md-2">
                                        <?php if($r->Type==1): ?>
                                        Transafer Stall
                                       <?php elseif($r->Type==2): ?>
                                       Leave Stall
                                       <?php elseif($r->Type==3): ?>
                                       Other/s
                                       <?php endif; ?>
                                      </div>
                                    
                                  </div>
                                      <div class="row" style="margin-top: 10px;">
                                          <div class="col-md-2">
                                              <label>Status:</label>
                                          </div>
                                          <div  class="col-md-2">
                                            <select class="form-control" name="status">
                                              <option selected disabled>Pending</option>
                                              <option class="alert-success" value="1">Apporved</option>
                                              <option class="alert-danger" value="2">Reject</option>
                                            </select>
                                          </div>
                                      </div>

                                      <div class="row" style="margin-top: 10px;">
                                          <div class="col-md-2">
                                              <label>Name:</label>
                                          </div>
                                          <div  class="col-md-3">
                                            <?php echo e($r->First); ?> <?php echo e($r->Middle); ?> <?php echo e($r->Last); ?>   
                                          </div>
                                      </div>
                                         <?php if($r->Type==1): ?>
                                         <div class="row" style="margin-top: 10px;">
                                          <div class="col-md-2">
                                            <label>Stall:</label>
                                          </div>
                                          <div  class="col-md-4">

                                            <table class="table table-bordered">
                                              <thead>
                                                <tr>
                                                  <th>Current Stall</th>
                                                  <th>Desired Stall</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <?php $__currentLoopData = $info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                  <td><?php echo e($i->stallFrom); ?></td>
                                                  <td><?php echo e($i->stallRequested); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                              </tbody>
                                              
                                            </table>
                                          </div>
                                        </div>
                                         <?php elseif($r->Type==2): ?>
                                         <div class="row" style="margin-top: 10px;">
                                          <div class="col-md-2">
                                            <label>Stall:</label>
                                          </div>
                                          <div  class="col-md-4">

                                            <table class="table table-bordered">
                                              <thead>
                                                <tr>
                                                  
                                                  <th>Desired Stall</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <?php $__currentLoopData = $info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                  <td><?php echo e($i->stallFrom); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                              </tbody>
                                              
                                            </table>
                                          </div>
                                        </div>
                                       <?php elseif($r->Type==3): ?>
                                            <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-2">
                                          <label>Subject:</label>
                                        </div>
                                        <div  class="col-md-4">
                                         <?php echo e($r->subject); ?>

                                        </div>
                                      </div>
                                       <?php endif; ?> 
                                      
                                          <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-2">
                                          <label>Desired Date:</label>
                                        </div>
                                        <div  class="col-md-2">
                                          <input type="text" name="desiredTS" value="<?php echo e($r->desired); ?>" readonly>
                                        </div>
                                      </div>

                                      <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-2">
                                          <label>Reason:</label>
                                        </div>
                                        <div  class="col-md-4">
                                          <textarea class="form-control" name="transferReasonTS" rows="5" readonly><?php echo e($r->reason); ?> </textarea>
                                        </div>
                                      </div>

                                      <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-2">
                                          <label>Remarks:</label>
                                        </div>
                                        <div  class="col-md-4">
                                          <textarea class="form-control" name="remarks" rows="5"></textarea>
                                        </div>
                                      </div>

                                       <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-4">
                                          <?php if(Auth::user()->position == "Admin"): ?>

                                          <a href="/Requests"><button class="btn btn-primary" id>BACK</button>

                                            <button class="btn btn-success" data-id="<?php echo e($r->ID); ?>" id="update">Update</button>
                                          </a>
                                          <?php elseif(Auth::user()->position == "Employee"): ?>
                                               <a href="/Requests"><button class="btn btn-primary" id>BACK</button>
                                           <?php endif; ?>                                     
                                        </div>
                                       
                                      </div>

                                  


                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                  </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
 <script type="text/javascript" src="<?php echo e(URL::asset('js/request.js')); ?>"></script>
<script type="text/javascript">

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>