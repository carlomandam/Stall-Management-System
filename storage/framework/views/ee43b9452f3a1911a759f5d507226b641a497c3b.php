<?php $__env->startSection('title'); ?>
<?php echo e('System Users'); ?>

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

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header">
                    Current Users
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="prodtbl" class="table table-responsive table-bordered table-striped" role="grid">
                            <thead>
                                <tr>
                                    <th width="40%">Name</th>
                                    <th width="20%">Role</th>
                                    <th width="40%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    use App\User;
                                    $users = User::all();
                                    foreach ($users as $user) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo e($user->fname); ?> <?php echo e($user->mname); ?> <?php echo e($user->lname); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($user->position); ?>

                                                </td>
                                                <td>
                                                    <button onclick="getUserDetail(<?php echo e($user->id); ?>)" class="btn btn-primary btn-flat" style="padding: 2px 10px 4px 3px; border-radius:50px;"><span class='glyphicon btn-glyphicon fa fa-eye img-circle text-primary' style="padding:7px; background:#ffffff; margin-right:4px;"></span> &nbsp; View</button>
                                                    <div class='btn-group'>
                                                        <button type='button' style='padding: 2px 10px 4px 3px; border-radius:50px;' class='btn btn-danger btn-flat dropdown-toggle' data-toggle='dropdown'>
                                                            <span class='glyphicon btn-glyphicon fa fa-trash img-circle text-danger' style='padding:7px; background:#ffffff; margin-right:4px;'>
                                                            </span> 
                                                            Deactivate
                                                        </button>
                                                        <ul class='dropdown-menu pull-right opensleft' role='menu'>
                                                            <center>
                                                                <h4>Are You Sure?</h4>
                                                                <li class='divider'></li>
                                                                <li>
                                                                    <a href='#' onclick='removeUser(<?php echo e($user->id); ?>); return false;'>
                                                                        YES
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href='#' onclick='return false'>NO</a>
                                                                </li>
                                                            </center>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">User Details</h4> </div>
            <div class="modal-body">
                <form id="upForm" class="form-horizontal" method="POST" action="/UpdateUser">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="fname" class="col-md-4 control-label">First Name</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="fname" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mname" class="col-md-4 control-label">Middle Name</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="mname" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lname" class="col-md-4 control-label">Last Name</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="lname" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="pull-right">
                    <button onclick="$('#modal').modal('hide')" class="btn btn-danger btn-flat" style="padding: 2px 10px 4px 3px; border-radius:50px;"><span class='glyphicon btn-glyphicon fa fa-close img-circle text-primary' style="padding:7px; background:#ffffff; margin-right:4px;"></span> &nbsp; Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    $(document).ready(function(){
        <?php if(Session::get('Status') == 'Success'): ?>
            toastr.success('New user registered');
        <?php elseif(Session::get('Status') == 'Deleted'): ?>
            toastr.success('User Removed');
        <?php endif; ?>
    });

    function getUserDetail(id){
        $body.addClass("loading");
        $.ajax({
            type: "POST"
            , url: '/getUserInfo'
            , data: {
                "id": id
            }
            , success: function (data) {
                obj = JSON.parse(data);
                $("#modal input[name=id]").val(obj.id);
                $("#modal input[name=fname]").val(obj.fname);
                $("#modal input[name=mname]").val(obj.mname);
                $("#modal input[name=lname]").val(obj.lname);
                $("#modal input[name=email]").val(obj.email);
                $("#modal select").val(obj.position);
                $body.removeClass("loading");
                $('#modal').modal('show');
            }
        });
    }

    function removeUser(id){
        $body.addClass("loading");
        var form = document.createElement("form");
        var element1 = document.createElement("input");
        var token = document.createElement("input");
        form.method = "POST";
        form.action = "/RemoveUser";   

        element1.value=id;
        element1.name="id";

        token.value="<?php echo e(csrf_token()); ?>";
        token.name="_token";
        form.appendChild(element1);
        form.appendChild(token);

        document.body.appendChild(form);

        form.submit();
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>