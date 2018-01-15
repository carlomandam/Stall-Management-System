<?php $__env->startSection('title'); ?>
<?php echo e('New User'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register new user</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/Register">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group <?php echo e($errors->has('fname') ? ' has-error' : ''); ?>">
                            <label for="fname" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="fname" type="text" class="form-control" name="fname" value="<?php echo e(old('fname')); ?>" required autofocus>

                                <?php if($errors->has('fname')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('fname')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mname" class="col-md-4 control-label">Middle Name</label>

                            <div class="col-md-6">
                                <input id="mname" type="text" class="form-control" name="mname" value="<?php echo e(old('mname')); ?>" autofocus>
                            </div>
                        </div>

                        <div class="form-group <?php echo e($errors->has('lname') ? ' has-error' : ''); ?>">
                            <label for="lname" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="lname" type="text" class="form-control" name="lname" value="<?php echo e(old('lname')); ?>" required autofocus>

                                <?php if($errors->has('lname')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('lname')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group <?php echo e($errors->has('lname') ? ' has-error' : ''); ?>">
                            <label for="lname" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="pass" type="password" class="form-control" name="pass" value="<?php echo e(old('pass')); ?>" required autofocus>

                                <?php if($errors->has('pass')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('pass')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lname" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="cpass" type="password" class="form-control" name="pass_confirmation" required autofocus>
                            </div>
                        </div>

                        <div class="form-group <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Role</label>

                            <div class="col-md-6">
                                <select class="js-example-basic-multiple stypeSelect form-control" id="role" name="role" style="width:100%"> 
                                	<option value="Admin">Administrator</option>
                                	<option value="Staff">Staff</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
	<?php if(Session::get('Status') == 'Success'): ?>
		toastr.success('New user registered');
	<?php endif; ?>
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>