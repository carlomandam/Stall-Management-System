@extends('layout.app') @section('title') {{'Charges'}} @stop @section('content-header')
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Maintenance</a></li>
    <li class="active">Charges</li>
</ol> @stop @section('content')
<div class="box box-primary">
    <div class="box-body">
        <div class="table-responsive">
            <div class="defaultNewButton">
                <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#new"><span class='fa fa-plus'></span>&nbspNewCharge</button>
                <div class=" pull-right" id="archive"> <a href="{{ url('/StallTypeArchive') }}" class="btn btn-primary btn-flat"><span class='fa fa-archive'></span>&nbspArchive</a> </div>
            </div>
            <table id="table" class="table table-bordered table-striped" role="grid">
                <thead>
                    <tr>
                        <th>Charge Name</th>
                        <th>Amount/Rate</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="new" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form action="" method="post" id="newform">
            <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Charge</h4> </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="penName">Charge Name*</label>
                                <input type="text" class="form-control" name="Name" placeholder="Charge Name" /> 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stypeWidth">Amount*</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="Amount" /> </div>
                                <input type="radio" name="Type" value="1" />&nbsp;
                                <label>Amount</label> &nbsp;&nbsp;
                                <input type="radio" name="Type" value="2" />&nbsp;
                                <label>Percent</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="days">Description</label>
                                <textarea class="form-control" name="Desc" placeholder="Fee Description"></textarea>
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
        <form action="" method="post" id="updateform">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Update Charge</h4> </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="penName">Charge Name*</label>
                                <input type="text" class="form-control" name="Name" placeholder="Charge Name" /> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stypeWidth">Amount*</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="Amount" /> </div>
                                <input type="radio" name="Type" value="1" />&nbsp;
                                <label>Amount</label> &nbsp;&nbsp;
                                <input type="radio" name="Type" value="2" />&nbsp;
                                <label>Percent</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="days">Description</label>
                                <textarea class="form-control" name="Desc" placeholder="Fee Description"></textarea>
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
@stop @section('script')
<script type="text/javascript">
    var obj;
    var chk;
    $(document).ready(function () {
        $("#newform").validate({
            rules: {
                Name: {
                    required: true
                    , remote: {
                        url: '/checkChargeName'
                        , type: 'post'
                        , data: {
                            Name: function () {
                                return $("#newform").find("input[name=Name]").val();
                            }
                            , _token: function () {
                                return $("#_token").val();
                            }
                        }
                    }
                }
                , Amount: {
                    required: true
                }
            }
            , messages: {
                Name: {
                    required: "Please enter Charge Name"
                    , remote: "Charge name is already taken"
                }
                , Amount: {
                    required: "Please enter amount"
                    , number: "Invalid amount"
                }
            }
            , errorClass: "error-class"
            , validClass: "valid-class"
            , errorElement: "li"
            , errorPlacement: function (error) {
                error.appendTo('#new .print-error-msg ul');
            }
            , invalidHandler : function() {
                $('#new .print-error-msg').css('display','block');
            }
        });
        $("#updateform").validate({
            rules: {
                penName: {
                    required: true
                }
                , penAmount: {
                    required: true
                    , number: true
                }
                , days: {
                    required: true
                    , digits: true
                }
            }
            , messages: {
                penName: {
                    required: "Please enter Penalty Name"
                }
                , penAmount: {
                    required: "Please enter Amount"
                    , number: "Invalid Amount"
                }
                , days: {
                    required: "Please enter numbe of days"
                    , digits: "Please enter a valid number of days"
                }
            }
            , errorClass: "error-class"
            , validClass: "valid-class"
            , errorElement: "li"
            , errorPlacement: function (error) {
                error.appendTo('#update .print-error-msg ul');
            }
            , invalidHandler : function() {
                $('#update .print-error-msg').css('display','block');
            }
            , successHandler : function() {
                $('#update .print-error-msg').css('display','none');
            }
        });
        $('#table').DataTable({
            ajax: '/chargeTable'
            , responsive: true
            , "columns": [
                {
                    "data": "chargeName"
                    }
                    , {
                    "data": "chargeAmount"
                    }
                    , {
                    "data": "chargeDesc"
                    }
                    , {
                    "data": "actions"
                    }
			]
            , "columnDefs": [
                {
                    "width": "20%"
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
                , url: '/addCharge'
                , data: formData
                , processData: false
                , contentType: false
                , context: this
                , success: function (data) {
                    toastr.success('Added New Charge');
                    $('#table').DataTable().ajax.reload();
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
                , url: '/updateCharge'
                , data: formData
                , processData: false
                , contentType: false
                , context: this
                , success: function (data) {
                    if (data) {
                        toastr.success('Updated Charge');
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
            , url: '/chargeInfo'
            , data: {
                "_token": "{{ csrf_token() }}"
                , "id": id
            }
            , success: function (data) {
                obj = JSON.parse(data);
                $('#update').find('input[name=id]').val(obj.chargeID);
                $('#update').find('input[name=Name]').val(obj.chargeName);
                $('#update').find('input[name=Amount]').val(obj.chargeAmount);
                $('#update').find('input[name=Type][value=' + obj.chargeType + ']').attr('checked', true);
                //$('#update').find('textarea[name=desc]').val(obj.penDesc);
                $('#update').modal('show');
            }
        });
    }

    function deleteBuilding(id) {
        $.ajax({
            type: "POST"
            , url: '/deleteCharge'
            , data: {
                "_token": "{{ csrf_token() }}"
                , "id": id
            }
            , success: function (data) {
                $('#table').DataTable().ajax.reload();
                toastr.success('Charge Deleted');
            }
        });
    }
</script> @stop