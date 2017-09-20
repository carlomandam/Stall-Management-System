@extends('layout.app') @section('title') {{ 'Holiday'}} @stop @section('content-header')
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
    .valid-class {
        color: black !important;
    }
</style>
<div class="box box-primary">
    <div class="box-body">
        <div class="table-responsive">
            <div class="defaultNewButton">
                <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#new"><span class='fa fa-plus'></span>&nbspNew Holiday</button>
                <div class=" pull-right" id="archive"> <a href="{{ url('/HolidayArchive') }}" class="btn btn-primary btn-flat"><span class='fa fa-archive'></span>&nbspArchive</a> </div>
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
            <form method="post" id="newform"> {{csrf_field()}}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">New Holiday</h4> </div>
                    <div class="modal-body">
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul id="error-new"></ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Name">Holiday Name</label><span class="required">&nbsp*</span>
                                    <input type="text" class="form-control" id="Name" name="Name" placeholder="Holiday Name" /> </div>
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
                <h4 class="modal-title">Update Holiday</h4> </div>
            <div class="modal-body">
                <form method="post" id="updateform">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <input type="hidden" id="_tokenUp" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id" id="idUp">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="NameUp">Holiday Name</label><span class="required">&nbsp*</span>
                                <input type="text" class="form-control" id="NameUp" name="Name" placeholder="Holiday Name" /> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="stype">Month</label><span class="required">&nbsp*</span>
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
                    <button class="btn btn-primary btn-flat" onclick="$('#updateform').submit();"><span class='fa fa-save'></span>&nbsp Save</button>
                </div>
            </div>
        </div>
    </div>
</div> @stop @section('script')
<script type="text/javascript" src="{{ URL::asset('js/floor_js.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var today = new Date(Date.now()).toLocaleString()
        for (var i = 1; i < 32; i++) $('.day').append("<option value='" + i + "'>" + i + "</option>");
        $("#newform").validate({
            rules: {
                Name: {
                    required: true
                    , maxlength: 200
                    , remote: {
                        url: '/CheckHolidayName'
                        , type: 'post'
                        , data: {
                            Name: function () {
                                return $("#newform").find("input[name=Name]").val();
                            }
                            , _token: "{{csrf_token()}}"
                        }
                    }
                }
                , Day: {
                    required: true
                    , remote: {
                        type: "POST"
                        , url: '/CheckHolidayDate'
                        , data: {
                            _token: "{{csrf_token()}}"
                            , Day: function () {
                                return $("#Day").val();
                            }
                            , Month: function () {
                                return $("#Month").val();
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
            , highlight: function (element, errorClass, validClass) {
                $(element).removeClass(validClass).addClass(errorClass);
                $('#new .print-error-msg').css('display', 'block');
            }
            , unhighlight: function (element, errorClass, validClass) {
                var i = 0;
                $('#newform .print-error-msg ul').find('li').each(function(){
                    if($(this).css('display') != 'none')
                        i++;
                });
                if(i == 0)
                    $('#newform .print-error-msg').css('display', 'none');
                $(element).removeClass(errorClass).addClass(validClass);
            }
            , errorElement: "li"
            , errorPlacement: function (error) {
                error.appendTo('#new .print-error-msg ul');
            }
            , submitHandler: function(form){
                var formData = new FormData(form);
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
                            , _token: "{{csrf_token()}}"
                        }
                    }
                }
                , Day: {
                    required: true
                    , remote: {
                        type: "POST"
                        , url: '/CheckHolidayDate'
                        , data: {
                            _token: "{{csrf_token()}}"
                            , Day: function () {
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
            , highlight: function (element, errorClass, validClass) {
                $(element).css('color', 'red','important');
                $(element).removeClass(validClass).addClass(errorClass);
                $('#update .print-error-msg').css('display', 'block');
            }
            , unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass(errorClass).addClass(validClass);
                var i = 0;
                $('#updateform .print-error-msg ul').find('li').each(function(){
                    if($(this).css('display') != 'none')
                        i++;
                });
                if(i == 0)
                    $('#updateform .print-error-msg').css('display', 'none');
            }
            , errorElement: "li"
            , errorPlacement: function (error) {
                error.appendTo('#update .print-error-msg ul');
            }
            , submitHandler: function(form){
                var formData = new FormData(form);
                $.ajax({
                    type: "POST"
                    , url: '/updateHoliday'
                    , data: formData
                    , processData: false
                    , contentType: false
                    , context: this
                    , success: function (data) {
                        if (data == 'true') {
                            toastr.success('Updated Holiday Information');
                            $('#prodtbl').DataTable().ajax.reload();
                            $('#update').modal('hide');
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
                        return "<button class='btn btn-primary btn-flat' onclick='getInfo(this.value)' value = '" + data.ID + "' ><span class='glyphicon glyphicon-pencil'></span> Update</button><div class='btn-group'><button type='button' class='btn btn-danger btn-flat dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-trash'></span> Deactivate</button></button><ul class='dropdown-menu pull-right opensleft' role='menu'><center><h4>Are You Sure?</h4><li class='divider'></li><li><a href='#' onclick='deleteHoliday(" + data.ID + ");return false;'>YES</a></li><li><a href='#' onclick='return false'>NO</a></li></center></ul></div>"
                    }
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
        $(".modal").on('hidden.bs.modal', function () {
            $(this).find('form').validate().resetForm();
            $(this).find('form')[0].reset();
        });
        $('.month').change(function () {
            if ($(this).val() == 4 || $(this).val() == 6 || $(this).val() == 9 || $(this).val() == 11) {
                $(this).parent().find('select').find('option[value =31]').remove();
                if ($(this).parent().find('select').find("option[value='30']").length == 0) {
                    $(this).parent().find('select').append('<option value="' + 30 + '">' + 30 + '</option>');
                }
            }
            else if ($(this).val() == 2) {
                $(this).parent().find('select').find('option[value =30]').remove();
                $(this).parent().find('select').find('option[value =31]').remove();
            }
            else {
                if ($(this).parent().find('select').find("option[value='30']").length == 0) {
                    $(this).parent().find('select').append('<option value="' + 30 + '">' + 30 + '</option>');
                    $(this).parent().find('select').append('<option value="' + 31 + '">' + 31 + '</option>');
                }
                else if ($(this).next().next().find("option[value = '31']").length == 0) {
                    $(this).parent().find('select').append('<option value="' + 31 + '">' + 31 + '</option>');
                }
            }
        });
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
                var obj = JSON.parse(data);
                $("#idUp").val(obj.ID);
                $("#NameUp").val(obj.Name);
                $("#DayUp").val(obj.Day);
                $("#MonthUp").val(obj.Month);

                $('#update').modal('show');
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
                toastr.success('Holiday Deleted');
            }
        });
    }
</script> @stop