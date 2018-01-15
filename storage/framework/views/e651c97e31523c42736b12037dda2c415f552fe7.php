<?php $__env->startSection('title'); ?>
    <?php echo e('Building Archive'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-header'); ?>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Maintenance</a></li>
            <li class="active">Building</li>
        </ol>
        <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="box box-primary">
    <div class="box-body">
        <div class="table-responsive">
            <div class="defaultNewButton">
                <div  class = "defaultNewButton">
                    <a href="<?php echo e(url('/Building')); ?>" class="btn btn-primary btn-flat" ><span class='fa fa-arrow-left'></span>&nbspBack</a>
                </div>
            </div>
            <table id="prodtbl" class="table table-responsive table-bordered table-striped" role="grid">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th style="width: 100px;">No. of Floors</th>
                        <th>Description</th>
                        <th style="width: 280px;">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
<div class="modal fade" id="update" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Building</h4> </div>
            <div class="modal-body">
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <div id="tabcontroll" class="container" style="width:100%">
                    <div class="tab-content">
                        <div class="tab-pane active" id="1">
                            <form class="building" action="" method="post" id="updateform">
                                <input type="hidden" id="_tokenUp" name="_token" value="<?php echo csrf_token(); ?>">
                                <input type="hidden" name="id" id="idUp">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="bldgNameUp">Building Name</label><span class="required">&nbsp*</span>
                                            <input type="text" class="form-control" id="bldgNameUp" name="bldgName" placeholder="Building Name" /> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bldgCodeUp">Building Code</label><span class="required">&nbsp*</span>
                                            <input type="text" class="form-control" id="bldgCodeUp" name="bldgCode" placeholder="Building Code" /> </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="bldgDescUp">Description</label>
                                            <textarea class="form-control" id="bldgDescUp" name="bldgDesc" placeholder="Building Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="bldgDescUp">Number Of Floor</label>
                                            <input type="text" id="curfloor" style="text-align:center" readonly> </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="2">
                            <table class="table table-bordered table-striped" role="grid" id='floorUpTbl'>
                                <thead>
                                <th style="width:40%">Floor No.</th>
                                <th style="width:40%">Current No. of stalls</th>
                                </thead>
                                <tbody> </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript" src="<?php echo e(URL::asset('js/floor_js.js')); ?>"></script>
<script type="text/javascript">
    var obj;
    $(document).ready(function () {
        $.validator.addMethod(
                "regex",
                function(value, element, regexp) {
                    var re = new RegExp(regexp);
                    return this.optional(element) || re.test(value);
                },
                "Please check your input."
        );

        $('#prodtbl').DataTable({
            ajax: '/bldgTableTrashed'
            , responsive: true
            , "columns": [
                {
                    "data": "bldgName"
                    }
                    , {
                    "data": "bldgCode"
                    }
                    , {
                    "data": "floor.length"
                    }
                    , {
                    "data": "bldgDesc"
                    }
                    , {
                    "data": function(data, type, dataToSet){
                            return "<button class='btn btn-primary btn-flat' onclick='getInfo(this.value)' value = '"+data.bldgID+"' ><span class='glyphicon glyphicon-pencil'></span> Details</button><div class='btn-group'><button type='button' class='btn btn-success btn-flat dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-refresh'></span> Restore</button></button><ul class='dropdown-menu pull-right opensleft' role='menu'><center><h4>Are You Sure?</h4><li class='divider'></li><li><a href='#' onclick='restore("+data.bldgID+");return false;'>YES</a></li><li><a href='#' onclick='return false'>NO</a></li></center></ul></div>";
                        }
                    }
            ]
            , "columnDefs": [
                {
                    "searchable": false
                    , "sortable": false
                    , "targets": 4
                    }
            ]
        });

        $(".modal").on('hidden.bs.modal', function () {
            $(this).find('form')[0].reset();
            $('.removable').not('.first').remove();
            $('#removefloor').attr('disabled', false);
        })
    });

    function getInfo(id) {
        $.ajax({
            type: "POST"
            , url: '/getBuildingInfo'
            , data: {
                "_token": "<?php echo e(csrf_token()); ?>"
                , "id": id
            }
            , success: function (data) {
                obj = JSON.parse(data)[0];
                $("#idUp").val(obj.bldgID);
                $("#bldgNameUp").val(obj.bldgName);
                $("#bldgCodeUp").val(obj.bldgCode);
                $("#bldgDescUp").val(obj.bldgDesc);
                $("#curfloor").val(obj.noOfFloor);
                $('#update').modal('show');
            }
        });
        $.ajax({
            type: "POST"
            , url: '/getFloorsUp'
            , data: {
                "_token": "<?php echo e(csrf_token()); ?>"
                , "id": id
            }
            , success: function (data) {
                obj = JSON.parse(data);
                for (i = 0; i < obj.length; i++) {
                    $('#floorUpTbl tbody').append("<tr class='removable'><td>" + (i + 1) + "</td><td>" + obj[i].stall.length + "</td></tr>");
                }
            }
        });
    }

    function restore(id) {
        $.ajax({
            type: "POST"
            , url: '/restoreBldg'
            , data: {
                "_token": "<?php echo e(csrf_token()); ?>"
                , "id": id
            }
            , success: function (data) {
                $('#prodtbl').DataTable().ajax.reload();
                toastr.success('Successfully restored record');
            }
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>