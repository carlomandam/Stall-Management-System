<?php $__env->startSection('content-header'); ?>
  <h1>
        Fees 
        
      </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Maintenance</a></li>
                    <li class="active">Fees</li>
                </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
 <div style="margin-top:2%;">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#new"><span class='glyphicon glyphicon-plus'></span>Add New Fee </button>
                </div>
                <div style="border:2px solid black;">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
                            <thead>
                                <tr>
                                    <th>Fee Name</th>
                                    <th>Amount</th>
                                    <th>Description</th>
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
                                    <h4 class="modal-title">Add Fee</h4> </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="feeName">Fee Name*</label>
                                                <input type="text" class="form-control" name="feeName" placeholder="Fee Name" /> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="stypeWidth">Amount*</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i>Php</i></div>
                                                    <input type="text" class="form-control" name="feeAmount"/> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="feeDesc">Description</label>
                                                <textarea class="form-control" name="feeDesc" placeholder="Fee Description"></textarea>
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
                            <input type="hidden" name='feeID'>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Update Fee</h4> </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="feeName">Fee Name*</label>
                                                <input type="text" class="form-control" name="feeName" placeholder="Fee Name" /> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="stypeWidth">Amount*</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i>Php</i></div>
                                                    <input type="text" class="form-control" name="feeAmount"/> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="feeDesc">Description</label>
                                                <textarea class="form-control" name="feeDesc" placeholder="Fee Description"></textarea>
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
                    feeName: {
                        required: true
                    }
                    , feeAmount: {
                        required: true,
                        number:true
                    }
                }
                , messages: {
                    feeName: {
                        required: "Please enter Fee Name"
                    }
                    , feeAmount: {
                        required: "Please enter Amount",
                        number: "Invalid Amount"
                    }
                }
                , errorClass: "error-class"
                , validClass: "valid-class"
            });
            $("#updateform").validate({
                rules: {
                    feeName: {
                        required: true
                    }
                    , feeAmount: {
                        required: true,
                        number:true
                    }
                }
                , messages: {
                    feeName: {
                        required: "Please enter Fee Name"
                    }
                    , feeAmount: {
                        required: "Please enter Amount",
                        number: "Invalid Amount"
                    }
                }
                , errorClass: "error-class"
                , validClass: "valid-class"
            });
            $('#table').DataTable({
                ajax: '/feeTable'
                , responsive: true
                , "columns": [
                    {
                        "data": "feeName"
                    }
                    , {
                        "data": "feeAmount"
                    }
                    , {
                        "data": "feeDesc"
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
                    , url: '/addFee'
                    , data: formData
                    , processData: false
                    , contentType: false
                    , context: this
                    , success: function (data) {
                        toastr.success('Added New Fee');
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
                    , url: '/updateFee'
                    , data: formData
                    , processData: false
                    , contentType: false
                    , context: this
                    , success: function (data) {
                        if(data){
                            toastr.success('Updated Stall Type Information');
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
                , url: '/getFeeInfo'
                , data: {
                    "_token": "<?php echo e(csrf_token()); ?>"
                    , "id": id
                }
                , success: function (data) {
                    obj = JSON.parse(data)[0];
                    $('#update').find('input[name=feeID]').val(obj.feeID);
                    $('#update').find('input[name=feeName]').val(obj.feeName);
                    $('#update').find('input[name=feeAmount]').val(obj.feeAmount);
                    $('#update').find('textarea[name=feeDesc]').val(obj.feeDesc);
                    $('#update').modal('show');
                }
            });
        }

        function deleteBuilding(id) {
            $.ajax({
                type: "POST"
                , url: '/deleteFee'
                , data: {
                    "_token": "<?php echo e(csrf_token()); ?>"
                    , "id": id
                }
                , success: function (data) {
                    $('#table').DataTable().ajax.reload();
                    toastr.success('Fee Deleted');
                }
            });
        }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>