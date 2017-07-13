@extends('layout.app') @section('content-header')
<h1>
        Penalties 
        
      </h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Maintenance</a></li>
    <li class="active">Penalties</li>
</ol> @stop @section('content')
<div style="margin-top:2%;">
    <button class="btn btn-primary" data-toggle="modal" data-target="#new"><span class='glyphicon glyphicon-plus'></span>Add New Penalty </button>
</div>
<div style="border:2px solid black;">
    <div class="table-responsive">
        <table id="table" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
            <thead>
                <tr>
                    <th>Penalty Name</th>
                    <th>For</th>
                    <th>No of Days</th>
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
                    <h4 class="modal-title">Add Penalty</h4> </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="penName">Penalty Name*</label>
                                <input type="text" class="form-control" name="penName" placeholder="Fee Name" /> </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="for">For*</label>
                                <select class="form-control feeSelect" name="for"> </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stypeWidth">Penalty*</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="penAmount" /> </div>
                                <input type="radio" name="type" value="1"/>&nbsp;<label>Amount</label>
                                &nbsp;&nbsp;
                                <input type="radio" name="type" value="2"/>&nbsp;<label>Percent</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stypeWidth">Days Delayed*</label>
                                <input type="text" class="form-control" name="days" /> </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="days">Description</label>
                                <textarea class="form-control" name="desc" placeholder="Fee Description"></textarea>
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
                    <h4 class="modal-title">Update Penalty</h4> </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="penName">Penalty Name*</label>
                                <input type="text" class="form-control" name="penName" placeholder="Fee Name" /> </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="for">For*</label>
                                <select class="form-control feeSelect" name="for"> </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stypeWidth">Penalty*</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="penAmount" /> </div>
                                <input type="radio" name="type" value="1"/>&nbsp;<label>Amount</label>
                                &nbsp;&nbsp;
                                <input type="radio" name="type" value="2"/>&nbsp;<label>Percent</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stypeWidth">Days Delayed*</label>
                                <input type="text" class="form-control" name="days" /> </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="days">Description</label>
                                <textarea class="form-control" name="desc" placeholder="Fee Description"></textarea>
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
</div> @stop @section('script')
<script type="text/javascript">
    var obj;
    var chk;
    $(document).ready(function () {
        getFees();
        $("#newform").validate({
            rules: {
                penName: {
                    required: true
                }
                , penAmount: {
                    required: true
                    , number: true
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
            }
            , errorClass: "error-class"
            , validClass: "valid-class"
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
            }
            , messages: {
                penName: {
                    required: "Please enter Penalty Name"
                }
                , penAmount: {
                    required: "Please enter Amount"
                    , number: "Invalid Amount"
                }
            }
            , errorClass: "error-class"
            , validClass: "valid-class"
        });
        $('#table').DataTable({
            ajax: '/penTable'
            , responsive: true
            , "columns": [
                {
                    "data": "penName"
                    }
                    , {
                    "data": function(data, type, dataToSet){
                        if(data.fee == null)
                            return "Overdue Payment";
                        else
                            return data.fee.feeName;
                    }
                    }
                    , {
                    "data": "penDays"
                    }
                    , {
                    "data": function(data, type, dataToSet){
                        if(data.penType == 1)
                            return "Php." + data.penAmount;
                        else 
                            return data.penAmount + "%";
                        
                    }
                    }
                    , {
                    "data": "penDesc"
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
                    , "targets": 5
                    }
  ]
        });
        $("#newform").submit(function (e) {
            e.preventDefault();
            if (!$("#newform").valid()) return;
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST"
                , url: '/addPenalty'
                , data: formData
                , processData: false
                , contentType: false
                , context: this
                , success: function (data) {
                    toastr.success('Added New Penalty');
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
                , url: '/updatePenalty'
                , data: formData
                , processData: false
                , contentType: false
                , context: this
                , success: function (data) {
                    if (data) {
                        toastr.success('Updated Penalty');
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
            , url: '/getPenaltyInfo'
            , data: {
                "_token": "{{ csrf_token() }}"
                , "id": id
            }
            , success: function (data) {
                obj = JSON.parse(data)[0];
                $('#update').find('input[name=id]').val(obj.penID);
                $('#update').find('input[name=penName]').val(obj.penName);
                if(obj.feeID !== null)
                    $('#update').find('select[name=for]').val(obj.feeID);
                else
                    $('#update').find('select[name=for]').val(0);
                $('#update').find('input[name=days]').val(obj.penDays);
                $('#update').find('input[name=penAmount]').val(obj.penAmount);
                $('#update').find('input[name=type][value='+obj.penType+']').attr('checked',true);
                $('#update').find('textarea[name=desc]').val(obj.penDesc);
                $('#update').modal('show');
            }
        });
    }

    function deleteBuilding(id) {
        $.ajax({
            type: "POST"
            , url: '/deletePenalty'
            , data: {
                "_token": "{{ csrf_token() }}"
                , "id": id
            }
            , success: function (data) {
                $('#table').DataTable().ajax.reload();
                toastr.success('Penalty Deleted');
            }
        });
    }

    function getFees(){
        $.ajax({
            type: "POST"
            , url: '/getFees'
            , data: {
                "_token": "{{ csrf_token() }}"
            }
            , success: function (data) {
                fees = JSON.parse(data);
                var opt = "<option value='0'>Overdue Payment</option>";
                for (var i = 0; i < fees.length; i++) {
                    opt += '<option value="' + fees[i].feeID + '">' + fees[i].feeName + '</option>';
                }
                
                $('.feeSelect').each(function(){
                    $(this).html(opt);
                });
            }
        });
    }
</script> @stop