<?php $__env->startSection('title'); ?>
    <?php echo e("KioskMap"); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/select2/select2.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/bootstrap/css/panel-tab.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/bootstrap/css/mapping.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/bootstrap/css/Kioskmap.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Maintenance</a></li>
        <li class="active">Kiosk Map</li>
      </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="row">

      <div class="col-md-3">

          <!-- Border Choose Building -->
         <div class="col-md-12" >

              <div class="panel panel-primary">
                  <div class="panel-heading" style="">
                    <h5>
                      <span>Stall Capacity</span>
                      <span></span>
                       <span class="cap"></span>
                    </h5>
                  </div>
                  <div class="panel-body">

                          <div class="form-group">
                              <label>Choose Building</label>
                              <select class="form-control select2 building" style="width: 100%;">
                                <option disabled selected="selected">--Select--</option>
                                <?php $__currentLoopData = $buildings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $building): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($building->bldgID); ?>"><?php echo e($building->bldgName); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                          </div>
                          <!-- /.form-group -->
                          <div class="form-group">
                              <label>Choose Floor No.</label>
                              <select class="form-control select2 floors" style="width: 100%;">
                                
                              </select>
                          </div>
                          <!-- /.form-group -->
                      
                  </div>
                  <!-- panel-body -->

              </div>
            
          </div>
          <!-- col-md-12 Border choose Building -->


           <!-- Border Choose Building -->
         <div class="col-md-12">

              <div class="panel with-nav-tabs panel-primary">

                  <div class="panel-heading" style="height: 10%;">

                        <ul class="nav nav-tabs">

                            <li class="active"><a href="#stalltpyetab" data-toggle="tab">Type</a></li>
                            <li><a href="#otherstab" data-toggle="tab">Others</a></li>
                        </ul>
                        <!-- nav nav-tabs -->

                  </div>
                  <!-- panel-heading -->

                  <div class="panel-body" style="height: 290px; overflow: scroll;">
                      <div class="tab-content">
                        <div class="tab-pane fade in active" id="stalltpyetab">
                              <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th></th>
                                    <th>Type</th>
                                    <th>Size</th>
                                    <th>Frequency</th>
                                    <th>Rate</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                      <td id=""><input type="radio" name=""></td>
                                      <td><?php echo e($rate->stypeName); ?></td>
                                      <td><?php echo e($rate->stypeArea); ?><i>meter squared</i></td>
                                      <td><?php echo e($rate->frequencyDesc); ?></td>
                                      <td><?php echo e($rate->dblRate); ?></td>
                                    </tr>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                              </table>
                              
                        </div>

                        <div class="tab-pane fade" id="otherstab">
                        Default 2
                        </div>
                    </div>
                          
                  </div>
                  <!-- panel-body -->
                  <div class="panel-footer" style="height: 5%;text-align: center;">
                    
                  </div>
              </div>
            
          </div>
          <!-- col-md-12 Border choose Building -->
        
      </div>
        <!-- col-md-3 -->

      <div class="col-md-9">
                    <!-- Border Choose Building -->
        <div class="col-md-12" >
            
            <div class="panel with-nav-tabs panel-primary">

                  <div class="panel-heading" style="height:47px;">

                      <ul class ="nav pull-left">
                          <li class="">
                          <h4>
                          <span class="buildingname">Choose Building</span>
                          <small class="floorname" style="margin-left: 5px;color: white;"></small>
                          </h4>
                          </li>
                            
                      </ul>

                      <ul class="nav nav-tabs pull-right" >
                            <li class="active"><a href="#map" data-toggle="tab">Map</a></li>
                            <li><a href="#table" data-toggle="tab">Table</a></li>
                      </ul>

                  </div>
                  <!-- col-md-12 panel-heading -->

                  <div class="panel-body nav-tabs-custom" style="height: 510px;">

                      <div class="tab-content">

                        <div class="tab-pane fade in active" id="map">

                           <div id="platform">
                             <ul id ="place">
                               
                             </ul>
                           </div>

                        </div>
                          <!-- tab-pane fade in active -> map -->

                        <div class="tab-pane fade" id="table">table</div>

                      </div>
                    <!-- tab-content -->
                  </div>
                   <!-- panel-body nav-tabs-custom -->
                 
            </div>
            <!-- panel with-nav-tabs panel-primary -->

         </div>
         <!-- col-md-12 -->

         
      </div>
          <!-- col-md-9 -->

  </div>
    <!-- row -->




	
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src ="<?php echo e(URL::asset('assets/select2/select2.js')); ?>"></script>
<script>
  $('#mKiosk').addClass('active');
  $(".select2").select2();
  $(function(){

  })
</script>
<script type="text/javascript" src ="js/mapping.js"></script>




<?php $__env->stopSection(); ?>





<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>