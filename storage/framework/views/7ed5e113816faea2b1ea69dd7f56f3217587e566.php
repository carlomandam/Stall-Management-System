<?php $__env->startSection('title'); ?>
<?php echo e('Backup and Recovery'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div>
  <h2>Reset and Backup Files</h2>
  <p>Reset all the data from the workstation and backup important data<br> to safe place (It takes time in resetting and backup files)</p>
  <button class="btn btn-default" style="background-color: lightgray; border: 2px solid black;">Reset & Backup Files</button>
</div>

<div>
  <h2>Recover all deleted Files</h2>
  <p>Recover all files from the database</p>
  <button class="btn btn-default" style="background-color: lightgray; border: 2px solid black;">Recover</button>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript" src ="js/request.js"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>