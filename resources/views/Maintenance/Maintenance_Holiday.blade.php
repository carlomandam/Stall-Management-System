@extends('layout.app') @section('title') {{ 'Building'}} @stop @section('content-header')
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Maintenance</li>
    <li class="active">Holidays</li>
</ol> @stop @section('content')
<style>
    #floortbl td {
        padding-bottom: 5px;
    }
    
    #floortbl th,
    #floortbl td {
        text-align: center;
    }
</style>
<div class="box box-primary">
    <div class="box-body">
        <div class="table-responsive">
            <div class="defaultNewButton">
                <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#new"><span class='fa fa-plus'></span>&nbspNew Holiday</button>
                <div class=" pull-right" id="archive"> <a href="{{ url('/BuildingArchive') }}" class="btn btn-primary btn-flat"><span class='fa fa-archive'></span>&nbspArchive</a> </div>
            </div>
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
            <form class="building" action="" method="post" id="newform">
                <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">New Holiday</h4> </div>
                    <div class="modal-body">
                        <input type="hidden" id="_tokenUp" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type="hidden" name="id" id="idUp">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="bldgNameUp">Holiday Name</label><span class="required">&nbsp*</span>
                                    <input type="text" class="form-control" id="bldgNameUp" name="Name" placeholder="Holiday Name" /> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="stype">Date</label><span class="required">&nbsp*</span>
                                <div class="input-group date datepicker">
                                    <input type="text" class="form-control" name="Date">
                                    <div class="input-group-addon"> <span class="glyphicon glyphicon-th"></span></div>
                                </div>
                            </div>
                        </div>
                        <p class="small text-danger">Fields with asterisks(*) are required</p>
                    </div>
                    <p class="small text-danger">Fields with asterisks(*) are required</p>
                    <div class="modal-footer">
                        <!-- <label style="float:left">All labels with "*" are required</label> -->
                        <div class="pull-right">
                            <button class="btn btn-primary btn-flat"><span class='fa fa-save'></span>&nbspSave</button>
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
                <h4 class="modal-title">Update Building</h4> </div>
            <div class="modal-body">
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <form class="building" action="" method="post" id="updateform">
                    <input type="hidden" id="_tokenUp" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id" id="idUp">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="bldgNameUp">Holiday Name</label><span class="required">&nbsp*</span>
                                <input type="text" class="form-control" id="bldgNameUp" name="Name" placeholder="Holiday Name" /> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="stype">Date</label><span class="required">&nbsp*</span>
                            <div class="input-group date datepicker">
                                <input type="text" class="form-control" name="Date">
                                <div class="input-group-addon"> <span class="glyphicon glyphicon-th"></span></div>
                            </div>
                        </div>
                    </div>
                    <p class="small text-danger">Fields with asterisks(*) are required</p>
                </form>
            </div>
            <div class="modal-footer">
                <!-- <label style="float:left">All labels with "*" are required</label> -->
                <div class="pull-right">
                    <button class="btn btn-primary btn-flat" onclick="$($('#updateform').submit();"><span class='fa fa-save'></span>&nbsp Save</button>
                </div>
            </div>
        </div>
    </div>
</div> @stop @section('script')
<script type="text/javascript" src="{{ URL::asset('js/floor_js.js') }}"></script>
<script type="text/javascript">
    var obj;
    $(document).ready(function () {
        $("#newform").validate({
            rules: {
                Name: {
                    required: true
                    , remote: {
                        url: '/CheckHolidayName'
                        , type: 'post'
                        , data: {
                            bldgName: function () {
                                return $("#newform").find("input[name=Name]").val();
                            }
                            , _token: function () {
                                return $("#_token").val();
                            }
                        }
                    }
                }
                , Date: {
                    required: true
                    , remote: {
                        type: "POST"
                        , url: '/CheckHolidayDate'
                        , data: {
                            Name: function () {
                                return $("#Date").val();
                            }
                            , _token: function () {
                                return $("#_token").val();
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
                , Date: {
                    required: "Please enter Date"
                    , remote: "Date is taken"
                }
            }
            , errorClass: "error-class"
            , validClass: "valid-class"
            , highlight: function (element, errorClass, validClass) {
                $(element).css('color', 'red');
                $(element).removeClass(validClass).addClass(errorClass);
                $('#new .print-error-msg').css('display', 'block');
                if ($('#new .print-error-msg ul').html() == '') $('#new .print-error-msg').css('display', 'none');
            }
            , unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass(errorClass).addClass(validClass);
            }
            , errorElement: "li"
            , errorPlacement: function (error) {
                error.appendTo('#new .print-error-msg ul');
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
                            bldgName: function () {
                                return $("#updateform").find("input[name=Name]").val();
                            }
                            , _token: function () {
                                return $("#_token").val();
                            }
                        }
                    }
                }
                , Date: {
                    required: true
                    , remote: {
                        type: "POST"
                        , url: '/CheckHolidayDate'
                        , data: {
                            bldgName: function () {
                                return $("#bldgCode").val();
                            }
                            , _token: function () {
                                return $("#_token").val();
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
                , Date: {
                    required: "Please enter Date"
                    , remote: "Date is taken"
                }
            }
            , errorClass: "error-class"
            , validClass: "valid-class"
            , errorElement: "li"
            , errorPlacement: function (error) {
                error.appendTo('#update .print-error-msg ul');
            }
            , invalidHandler: function () {
                $('#update .print-error-msg').css('display', 'block');
            }
            , successHandler: function () {
                $('#update .print-error-msg').css('display', 'none');
            }
        });
        $('#prodtbl').DataTable({
            ajax: '/holidayTable'
            , responsive: true
            , "columns": [
                {
                    "data": "HName"
                    }
                    , {
                    "data": "HDate"
                    }
                    , {
                    "data": "actions"
                    }
            ]
            , "columnDefs": [
                {
                    "searchable": false
                    , "sortable": false
                    , "targets": 2
                    }
            ]
        });
        $("#newform").submit(function (e) {
            e.preventDefault();
            if (!$("#newform").valid()) return;
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST"
                , url: '/addHoliday'
                , data: formData
                , processData: false
                , contentType: false
                , context: this
                , success: function (data) {
                    toastr.success('Added New Holiday');
                    $('#prodtbl').DataTable().ajax.reload();
                    $('#new').modal('hide');
                }
            });
        });

        $("#updateform").unbind('submit').bind('submit', function (e) {
            e.preventDefault();
            if (!$("#updateform").valid()) return;
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST"
                , url: '/updateHoliday'
                , data: formData
                , processData: false
                , contentType: false
                , context: this
                , success: function (data) {
                    if (data) {
                        toastr.success('Updated Holiday Information');
                        $('#prodtbl').DataTable().ajax.reload();
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
            , url: '/getHolidayInfo'
            , data: {
                "_token": "{{ csrf_token() }}"
                , "id": id
            }
            , success: function (data) {
                obj = JSON.parse(data)[0];
                $("#idUp").val(obj.HID);
                $("#NameUp").val(obj.Name);
                $("#DateUp").val(obj.Date);
            }
        });
    }

    function deleteHoliday(id) {
        $.ajax({
            type: "POST"
            , url: '/deleteHoliday'
            , data: {
                "_token": "{{ csrf_token() }}"
                , "id": id
            }
            , success: function (data) {
                $('#prodtbl').DataTable().ajax.reload();
                toastr.success('Building Deleted');
            }
        });
    }
</script> @stop