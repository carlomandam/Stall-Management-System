 <?php $__env->startSection('title'); ?> <?php echo e('Stall Type Archive'); ?>

<style type="text/css">

</style> <?php $__env->stopSection(); ?> <?php $__env->startSection('content-header'); ?>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Maintenance</a></li>
    <li class="active">Stall Type</li>
</ol> <?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>
<div class="box box-primary">
    <div class="box-body">
        <div class="table-responsive">
            <div class="defaultNewButton"> <a href="<?php echo e(url('/StallType')); ?>" class="btn btn-primary btn-flat"><span class='fa fa-arrow-left'></span>&nbspBack</a> </div>
            <table id="table" class="table table-bordered table-striped" role="grid">
                <thead>
                    <tr>
                        <th style="width: 200px;">Stall Type</th>
                        <th style="width: 120px;">Sizes</th>
                        <th style="width: 300px;">Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="modal fade" id="update" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <form action="" method="post" id="updateform">
                <input type="hidden" id="_tokenUp" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="id" id="idUp">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Update Stall Type</h4> </div>
                    <div class="modal-body">
                        <div id="upEC" class="alert alert-danger print-error-msg" style="display:none">
                            <ul id="error-new"></ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="stypeNameUp">Stall Type Name</label> <span class="required">&nbsp*</span>
                                    <input type="text" class="form-control" id="stypeNameUp" name="stypeName" placeholder="Stall Type Name" /> </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="stypeDescUp">Description</label>
                                    <textarea class="form-control" id="stypeDescUp" name="stypeDesc" placeholder="Stall Type Description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group sizediv">
                                    <label for="stypeLength">Stall Type Area</label>
                                </div>
                            </div>
                        </div>
                        <p class="small text-danger">Fields with asterisks(*) are required</p>
                    </div>
                    <div class="modal-footer">
                        <!-- <label style="float:left">All labels with "*" are required</label> -->
                        <button class="btn btn-primary btn-flat" type="submit"><span class='fa fa-save'></span>&nbspSave</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> <?php $__env->stopSection(); ?> <?php $__env->startSection('script'); ?>
<script type="text/javascript" src="<?php echo e(URL::asset('js/multipleAddinArea.js')); ?>"></script>
<script>
    var obj;
    var chk;
    $(document).ready(function () {
        $('#table').DataTable({
            ajax: '/stypeTableTrashed'
            , responsive: true
            , "columns": [{
                    "data": "stypeName"
                    }
                    , {
                    "data": function (data, type, dataToSet) {
                        var string = data.s_type_size[0].stypeArea + "m<sup>2</sup>";
                        for (var i = 1; i < data.s_type_size.length; i++) {
                            string += ", " + data.s_type_size[i].stypeArea + "m<sup>2</sup>";
                        }
                        return string;
                    }
                    }
                    , {
                    "data": "stypeDesc"
                    }
                    , {
                    "data": function (data, type, dataToSet) {
                            return "<button class='btn btn-primary btn-flat' onclick='getInfo(this.value)' value = '"+data.stypeID+"' ><span class='glyphicon glyphicon-pencil'></span> Details</button><div class='btn-group'><button type='button' class='btn btn-success btn-flat dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-refresh'></span> Restore</button></button><ul class='dropdown-menu pull-right opensleft' role='menu'><center><h4>Are You Sure?</h4><li class='divider'></li><li><a href='#' onclick='restore("+data.stypeID+");return false;'>YES</a></li><li><a href='#' onclick='return false'>NO</a></li></center></ul></div>";
                        }
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
        $(".modal").on('hidden.bs.modal', function () {
            $(this).find('form').validate().resetForm();
            $(this).find('form')[0].reset();
            $(this).find('.removable').not(':last').remove();
            getSizes();
        })
    });

    function getInfo(id) {
        $.ajax({
            type: "POST"
            , url: '/getSTypeInfo'
            , data: {
                "_token": "<?php echo e(csrf_token()); ?>"
                , "id": id
            }
            , success: function (data) {
                obj = JSON.parse(data)[0];
                $("#idUp").val(obj.stypeID);
                $("#stypeNameUp").val(obj.stypeName);
                $("#stypeLengthUp").val(obj.stypeLength);
                $("#stypeWidthUp").val(obj.stypeWidth);
                $("#stypeDescUp").val(obj.stypeDesc);
                var sizes = '';
                for (var i = 0; i < obj.s_type_size.length; i++) {
                    sizes += '<div class="form-group input-group removable existingsize"><input type="text" name="size[]" class="form-control" placeholder="Area" list="sizesoptions" value="' + obj.s_type_size[i].stypeArea + '" disabled> <span class="input-group-addon">meter<sup>2</sup></span> <span class="input-group-btn"></div>';
                    $('#sizesoptions').find('option[value=' + obj.s_type_size[i].stypeArea + ']').attr('disabled', true);
                }
                $('.sizediv').append(sizes);
                $('#update').modal('show');
            }
        });
    }

    function restore(id) {
        $.ajax({
            type: "POST"
            , url: '/restoreSType'
            , data: {
                "_token": "<?php echo e(csrf_token()); ?>"
                , "id": id
            }
            , success: function (data) {
                $('#table').DataTable().ajax.reload();
                toastr.success('Stall Type Deleted');
            }
        });
    }
</script> <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>