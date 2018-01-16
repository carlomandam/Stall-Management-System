 <?php $__env->startSection('title'); ?> <?php echo e('Holiday'); ?> <?php $__env->stopSection(); ?> <?php $__env->startSection('content-header'); ?>
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Maintenance</li>
    <li class="active">Holidays</li>
</ol> <?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>
<style>
    #floortbl td {
        padding-bottom: 5px;
    }
    
    #floortbl th,
    #floortbl td {
        text-align: center;
    }
    .valid-class {
        color: black !important;
    }
</style>
<div class="defaultNewButton">
    <button style="padding: 1px 10px 4px 3px; border-radius:50px;" class="btn icon-btn btn-primary" data-toggle="modal" data-target="#new"><span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-primary" style="padding:7px; background:#ffffff; margin-right:4px;"></span>&nbsp;New Holiday</button>

    <div class=" pull-right" id="archive"> <a style="padding: 2px 10px 3px 3px; border-radius:50px;" href="<?php echo e(url('/HolidayArchive')); ?>" class="btn btn-primary btn-flat"><span span style="padding:7px; background:#ffffff; margin-right:4px;" class='fa fa-archive img-circle text-primary'></span>&nbsp;Archive</a> </div>
</div>
<div class="box box-primary">
    <div class="box-body">
        <div class="table-responsive">
            <table id="prodtbl" class="table table-responsive table-bordered table-striped" role="grid">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="modal fade" id="new" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <form method="post" id="newform"> <?php echo e(csrf_field()); ?>

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">New Holiday</h4> </div>
                    <div class="modal-body">
                        <div id="newEC" class="alert alert-danger print-error-msg" style="display:none">
                            <ul id="error-new"></ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Name">Holiday Name</label><span class="required">&nbsp*</span>
                                    <input type="text" class="form-control" id="Name" name="Name" placeholder="ex. New Year" /> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="stype">Month</label><span class="required">&nbsp*</span>
                                <select name="Month" id="Month" class="month">
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                                <label for="Day">Day</label><span class="required">&nbsp*</span>
                                <select name="Day" id="Day" class="day"> </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="small text-danger">Fields with asterisks(*) are required</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <label style="float:left">All labels with "*" are required</label> -->
                        <div class="pull-right">
                            <button style="padding: 2px 10px 4px 3px; border-radius:50px;" class="btn btn-primary btn-flat"><span class='glyphicon btn-glyphicon fa fa-save img-circle text-primary' style="padding:7px; background:#ffffff; margin-right:4px;"></span>&nbspSave</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="update" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Holiday</h4> </div>
            <div class="modal-body">
                <form method="post" id="updateform">
                    <div id="upEC" class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <input type="hidden" name="id" id="idUp">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="NameUp">Holiday Name</label><span class="required">&nbsp;*</span>
                                <input type="text" class="form-control" id="NameUp" name="Name" placeholder="Holiday Name" /> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="stype">Month</label><span class="required">&nbsp;*</span>
                            <select name="Month" id="MonthUp" class="month">
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            <label for="DayUp">Day</label><span class="required">&nbsp*</span>
                            <select name="Day" id="DayUp" class="day"> </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="small text-danger">Fields with asterisks(*) are required</p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- <label style="float:left">All labels with "*" are required</label> -->
                <div class="pull-right">
                    <button style="padding: 2px 10px 4px 3px; border-radius:50px;" class="btn btn-primary btn-flat"><span class='glyphicon btn-glyphicon fa fa-save img-circle text-primary' style="padding:7px; background:#ffffff; margin-right:4px;"></span>&nbspSave</button>
                </div>
            </div>
        </div>
    </div>
</div> <?php $__env->stopSection(); ?> <?php $__env->startSection('script'); ?>
<script type="text/javascript" src="<?php echo e(URL::asset('js/floor_js.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var today = new Date(Date.now()).toLocaleString()
        for (var i = 1; i < 32; i++) $('.day').append("<option value='" + i + "'>" + i + "</option>");
        $validator = $("#newform").validate({
            rules: {
                Day: {
                    required: true
                    , remote: {
                        type: "POST"
                        , url: '/CheckHolidayDate'
                        , data: {
                            Day: function () {
                                return $("#Day").val();
                            }
                            , Month: function () {
                                return $("#Month").val();
                            }
                        }
                    }
                }
                , Name: {
                    required: true
                    , maxlength: 200
                    , remote: {
                        url: '/CheckHolidayName'
                        , type: 'post'
                        , data: {
                            Name: function () {
                                return $("#newform").find("input[name=Name]").val();
                            }
                        }
                    }
                }
            }
            , messages: {
                Name: {
                    required: "Please enter Holiday Name"
                    , remote: "Holiday Name is taken"
                }
                , Day: {
                    remote: "Date is taken"
                }
            }
            , errorClass: "error-class"
            , validClass: "valid-class"
            , errorContainer: "#newEC"
            , errorElement: "li"
            , errorPlacement: function (error) {
                error.appendTo('#new .print-error-msg ul');
            }
            , submitHandler: function(form){
                $body.addClass("loading");
                $(form).find(":submit").attr('disabled',true);
                var formData = new FormData(form);
                $.ajax({
                    type: "POST"
                    , url: '/addHoliday'
                    , data: formData
                    , processData: false
                    , contentType: false
                    , context: this
                    , success: function (data) {
                        $body.removeClass("loading");
                        toastr.success('Added New Holiday');
                        $('#prodtbl').DataTable().ajax.reload();
                        $('#new').modal('hide');
                        $(form).find(":submit").attr('disabled',false);
                        $validator.resetForm();
                    }
                });
            }
        });
        $("#updateform").validate({
            rules: {
                Name: {
                    required: true
                    , remote: {
                        url: '/CheckHolidayName'
                        , type: 'post'
                        , data: {
                            Name: function () {
                                return $("#updateform").find("input[name=Name]").val();
                            }
                            , ID: function () {
                                return $("#idUp").val();
                            }
                        }
                    }
                }
                , Day: {
                    required: true
                    , remote: {
                        type: "POST"
                        , url: '/CheckHolidayDate'
                        , data: {
                            Day: function () {
                                return $("#DayUp").val();
                            }
                            , Month: function () {
                                return $("#MonthUp").val();
                            }
                            , ID: function () {
                                return $("#idUp").val();
                            }
                        }
                    }
                }
            }
            , messages: {
                Name: {
                    required: "Please enter Holiday Name"
                    , remote: "Holiday Name is taken"
                }
                , Day: {
                    required: "Please enter Date"
                    , remote: "Date is taken"
                }
            }
            , errorClass: "error-class"
            , validClass: "valid-class"
            , errorElement: "li"
            , errorContainer: "#upEC"
            , errorPlacement: function (error) {
                error.appendTo('#update .print-error-msg ul');
            }
            , submitHandler: function(form){
                $body.addClass("loading");
                $(form).find(":submit").attr('disabled',true);
                var formData = new FormData(form);
                $.ajax({
                    type: "POST"
                    , url: '/updateHoliday'
                    , data: formData
                    , processData: false
                    , contentType: false
                    , context: this
                    , success: function (data) {
                        $body.removeClass("loading");
                        if (data.trim() == 'true') {
                            toastr.success('Updated Holiday Information');
                            $('#prodtbl').DataTable().ajax.reload();
                            $('#update').modal('hide');
                            $(form).find(":submit").attr('disabled',false);
                        }
                    }
                });
            }
        });
        $('#prodtbl').DataTable({
            ajax: '/holidayTable'
            , responsive: true
            , "columns": [
                {
                    "data": "Name"
                    }
                    , {
                    "data": function (data, type, dataToSet){
                            var month = "";
                            switch(data.Month){
                                case 1: 
                                    month = 'January';
                                    break;
                                case 2: 
                                    month = 'February';
                                    break;
                                case 3: 
                                    month = 'March';
                                    break;
                                case 4: 
                                    month = 'April';
                                    break;
                                case 5: 
                                    month = 'May';
                                    break;
                                case 6: 
                                    month = 'June';
                                    break;
                                case 7: 
                                    month = 'July';
                                    break;
                                case 8: 
                                    month = 'August';
                                    break;
                                case 9: 
                                    month = 'September';
                                    break;
                                case 10: 
                                    month = 'October';
                                    break;
                                case 11: 
                                    month = 'November';
                                    break;
                                case 12: 
                                    month = 'December';
                                    break;
                            }

                            return month+" "+data.Day;
                        }
                    }
                    , {
                    "data": function (data, type, dataToSet) {
                        return "<button style='padding: 2px 10px 4px 3px; border-radius:50px;' class='btn btn-primary btn-flat' onclick='getInfo(this.value)' value = '" + data.ID + "' ><span class='glyphicon btn-glyphicon fa fa-pencil img-circle text-primary'  style='padding:7px; background:#ffffff; margin-right:4px;'></span> Update</button>&nbsp<div class='btn-group'><button type='button' style='padding: 2px 10px 4px 3px; border-radius:50px;' class='btn btn-danger btn-flat dropdown-toggle' data-toggle='dropdown'><span class='glyphicon btn-glyphicon fa fa-trash img-circle text-danger' style='padding:7px; background:#ffffff; margin-right:4px;'></span> Deactivate</button></button><ul class='dropdown-menu pull-right opensleft' role='menu'><center><h4>Are You Sure?</h4><li class='divider'></li><li><a href='#' onclick='deleteHoliday(" + data.ID + ");return false;'>YES</a></li><li><a href='#' onclick='return false'>NO</a></li></center></ul></div>"
                    }
                    }
            ]
            , "columnDefs": [
                {
                    "searchable": false
                    , "sortable": false
                    , "targets": 2
                    , "width": "25%"
                }
            ]
        });
        $(".modal").on('hidden.bs.modal', function () {
            $(this).find('form').validate().resetForm();
            $(this).find('form')[0].reset();
        });
        $('.month').change(function () {
            if ($(this).val() == 4 || $(this).val() == 6 || $(this).val() == 9 || $(this).val() == 11) {
                $(this).parent().find('select').find('option[value =31]').remove();
                if ($(this).parent().find('select[name=Day]').find("option[value='30']").length == 0) {
                    $(this).parent().find('select[name=Day]').append('<option value="' + 30 + '">' + 30 + '</option>');
                }
            }
            else if ($(this).val() == 2) {
                $(this).parent().find('select[name=Day]').find('option[value =30]').remove();
                $(this).parent().find('select[name=Day]').find('option[value =31]').remove();
            }
            else {
                if ($(this).parent().find('select[name=Day]').find("option[value='30']").length == 0) {
                    $(this).parent().find('select[name=Day]').append('<option value="' + 30 + '">' + 30 + '</option>');
                    $(this).parent().find('select[name=Day]').append('<option value="' + 31 + '">' + 31 + '</option>');
                }
                else if ($(this).parent().find('select[name=Day]').find("option[value = '31']").length == 0) {
                    $(this).parent().find('select[name=Day]').append('<option value="' + 31 + '">' + 31 + '</option>');
                }
            }
        });
    });

    function getInfo(id) {
        $body.addClass("loading");
        $.ajax({
            type: "POST"
            , url: '/getHolidayInfo'
            , data: {
                "id": id
            }
            , success: function (data) {
                var obj = JSON.parse(data);
                $("#idUp").val(obj.ID);
                $("#NameUp").val(obj.Name);
                $("#DayUp").val(obj.Day);
                $("#MonthUp").val(obj.Month);

                $body.removeClass("loading");
                $('#update').modal('show');
            }
        });
    }

    function deleteHoliday(id) {
        $.ajax({
            type: "POST"
            , url: '/deleteHoliday'
            , data: {
                "id": id
            }
            , success: function (data) {
                $('#prodtbl').DataTable().ajax.reload();
                toastr.success('Holiday Deleted');
            }
        });
    }
</script> <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>