<?php $__env->startSection('title'); ?> <?php echo e('Login'); ?>

<?php $__env->stopSection(); ?> 

<?php $__env->startSection('content'); ?>
<div class="container">
  
  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    
    <div class="col-md-4">
      <section class="login-form">
       <div class="login">
          <form class="form-horizontal" method="POST" action="<?php echo e(route('login.submit')); ?>">
                        <?php echo e(csrf_field()); ?>

          <div>
            <img src="<?php echo e(URL::asset('image/LOGO.png')); ?>" width="150px" height="150px">
            <h3 style="font-family: impact;margin-top: -10%; text-align: center;">Stalls Management System</h3>
          </div>
          <input type="email" name="email" placeholder="Email" value="<?php echo e(old('email')); ?>" required class="form-control input-lg" />
          <?php if($errors->has('email')): ?>
          <span class="help-block">
            <strong><?php echo e($errors->first('email')); ?></strong>
          </span>
          <?php endif; ?>
          
          <input type="password" class="form-control input-lg <?php echo e($errors->any() ? ' has-error' : ''); ?>" name="password" id="password" placeholder="Password"/>
          <?php if($errors->any()): ?>
          <span class="help-block">
            <strong><?php echo e($errors->first('password')); ?></strong>
          </span>
          <?php endif; ?>
          
          <!-- <div class="pwstrength_viewport_progress"></div> -->
          
          
          <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Sign in</button>
         
          
        </form>
       </div>
        
      </section>  
      </div>
      
      <div class="col-md-4"></div>
      

  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('login.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>