<?php $__env->startSection('content-header'); ?>
  <h1>
        Utilities 
        
      </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Maintenance</a></li>
                    <li class="active">Utilities</li>
                </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
 <div style="margin-top:2%;">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#new"><span class='glyphicon glyphicon-plus'></span>Add New Utility </button>
                </div>
                <div style="border:2px solid black;">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
                            <thead>
                                <tr>
                                    <th>Utility Name</th>
                                    <th>Description</th>
                                    <th>Metered</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal fade" id="new" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-md" role="document">
                        <form action="" method="post" id="newform">
                            <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Add Utility</h4> </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Utility Name*</label>
                                                <input type="text" class="form-control" name="name" placeholder="Utility Name" /> </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="rate">Description</label>
                                                <textarea class="form-control" name="desc"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input name="metered" type="checkbox" value="1">&nbsp;<label>Metered</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <!-- <label style="float:left">All labels with "*" are required</label> -->
                                    <button class="btn btn-info" style="background-color:#191966">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal fade" id="update" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-md" role="document">
                        <form method="post" id="updateform">
                            <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name='id'>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Update Utility</h4> </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Utility Name*</label>
                                                <input type="text" class="form-control" name="name" placeholder="Utility Name" /> </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="rate">Description</label>
                                                <textarea class="form-control" name="desc"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input name="metered" type="checkbox" value="1">&nbsp;<label>Metered</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <!-- <label style="float:left">All labels with "*" are required</label> -->
                                    <button class="btn btn-info" style="background-color:#191966">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
	 var obj;
        var chk;
        $(document).ready(function () {
            $("#newform").validate({
                rules: {
                    name: {
                        required: true
                    }
                }
                , messages: {
                    name: {
                        required: "Please enter Utility Name"
                    }
                }
                , errorClass: "error-class"
                , validClass: "valid-class"
            });
            $("#updateform").validate({
                rules: {
                    name: {
                        required: true
                    }
                }
                , messages: {
                    name: {
                        required: "Please enter Penalty Name"
                    }
                }
                , errorClass: "error-class"
                , validClass: "valid-class"
            });
            $('#table').DataTable({
                ajax: '/utilTable'
                , responsive: true
                , "columns": [
                    {
                        "data": "utilName"
                    }
                    , {
                        "data": "utilDesc"
                    }
                    , {
                        "data": function(data, type, dataToSet){
                            if(data.isMetered == 1)
                                return "Yes";
                            else
                                return "No";
                        }
                    }
                    , {
                        "data": "actions"
                    }
			]
                , "columnDefs": [
                    {
                        "width": "180px"
                        , "searchable": false
                        , "sortable": false
                        , "targets": 3
                    }
  ]
            });
            $("#newform").submit(function (e) {
                e.preventDefault();
                if (!$("#newform").valid()) return;
                var formData = new FormData($(this)[0]);
                $.ajax({
                    type: "POST"
                    , url: '/addUtility'
                    , data: formData
                    , processData: false
                    , contentType: false
                    , context: this
                    , success: function (data) {
                        toastr.success('Added New Utility');
                        $('#table').DataTable().ajax.reload();
                        $('#new').modal('hide');
                    }
                });
            });
            $("#updateform").unbind('submit').bind('submit',function (e) {
                e.preventDefault();
                if (!$("#updateform").valid()) return;
                var formData = new FormData($(this)[0]);
                $.ajax({
                    type: "POST"
                    , url: '/updateUtility'
                    , data: formData
                    , processData: false
                    , contentType: false
                    , context: this
                    , success: function (data) {
                        if(data){
                            toastr.success('Updated Utility');
                            $('#table').DataTable().ajax.reload();
                            $('#update').modal('hide');
                        }
                    }
                });
            });
            $(".modal").on('hidden.bs.modal', function () {
                $(this).find('form').validate().resetForm();
                $(this).find('form')[0].reset();
            })
        });

        function getInfo(id) {
            $.ajax({
                type: "POST"
                , url: '/getUtilityInfo'
                , data: {
                    "_token": "<?php echo e(csrf_token()); ?>"
                    , "id": id
                }
                , success: function (data) {
                    obj = JSON.parse(data)[0];
                    $('#update').find('input[name=id]').val(obj.utilID);
                    $('#update').find('input[name=name]').val(obj.utilName);
                    $('#update').find('textarea[name=desc]').val(obj.utilDesc);
                    if(obj.isMetered == 1)
                        $('#update').find('input[name=metered]').prop('checked',true);
                    $('#update').modal('show');
                }
            });
        }

        function deleteUtility(id) {
            $.ajax({
                type: "POST"
                , url: '/deleteUtility'
                , data: {
                    "_token": "<?php echo e(csrf_token()); ?>"
                    , "id": id
                }
                , success: function (data) {
                    $('#table').DataTable().ajax.reload();
                    toastr.success('Utility Deleted');
                }
            });
        }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>