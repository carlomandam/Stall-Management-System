<?php $__env->startSection('title'); ?>
<?php echo e('Billingt'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="box box-primary" >
          <div class="box-heading"></div>
          <div class="box-body">
              <div class="col-md-12">

                  <div class="row">
                    <div class="col-md-12"><h4 style="text-align: center;"><b>Billing</b></h4></div>  
                  </div>

                  <div class="row">
                    <div class="col-xs-12" >
                      <table class="table table-bordered table-striped" style="font-size:15px;" >
                        <thead>
                          <tr>
                            <th><input type="checkbox" name=""> Check All</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox" name=""></td>
                                <td>Rental Fee</td>
                                <td>9/14/2017</td>
                                <td>Php 100.00</td>
                                <td>Paid</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name=""></td>
                                <td>Rental Fee</td>
                                <td>9/15/2017</td>
                                <td>Php 100.00</td>
                                <td>Unpaid</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name=""></td>
                                <td>Rental Fee</td>
                                <td>9/16/2017</td>
                                <td>Php 100.00</td>
                                <td>Unpaid</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name=""></td>
                                <td>Rental Fee</td>
                                <td>9/17/2017</td>
                                <td>Php 100.00</td>
                                <td>Unpaid</td>
                            </tr>
                        </tbody>

                      </table>
                    </div>
                  </div>

                  <div class="row">
                      <div class="col-xs-12" style="text-align: center;">
                          <button class="btn btn-danger">Void</button>
                          <button class="btn btn-info">Add Charges</button>
                          <button class="btn btn-success">Generate Bill</button>
                      </div>
                  </div>
                
        
              </div>
          </div>

    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript" src ="<?php echo e(URL::asset('js/billing.js')); ?>"></script>
<script type="text/javascript">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>