@extends('layout.app') @section('content-header')
<h1>
        Stall Rate 
      </h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Maintenance</a></li>
    <li class="active">Stall Rate</li>
</ol> @stop @section('content')
<div style="margin-top:2%;">
    <button class="btn btn-primary" data-toggle="modal" data-target="#new"><span class='glyphicon glyphicon-plus'></span>Add New Stall Rate</button>
</div>
<div style="border:2px solid black;">
    <div class="table-responsive">
        <table id="table" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Stall Type</th>
                    <th>Building</th>
                    <th>Collection</th>
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
                    <h4 class="modal-title">Add Stall Rate</h4> </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stype">Stall Type*</label>
                                <select class="form-control stypeSelect" name="stypeID"> </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stype">Building*</label>
                                <select class="form-control bldgSelect" name="bldgID"> </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stype">Amount*</label>
                                <div class="input-group">
                                    <div class="input-group-addon"> <i>Php</i> </div>
                                    <input type="text" class="form-control" name="amt" placeholder="Php." /> </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Collection*</label>
                                <select class="form-control" name="collection">
                                    <option value='1'>Daily</option>
                                    <option value='2'>Weekly</option>
                                    <option value='3'>Monthly</option>
                                </select>
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
                    <h4 class="modal-title">Update Stall Rate</h4> </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stype">Stall Type*</label>
                                <input class="form-control" name="stype" readonly>
                                <input type="hidden" name="stypeID" /> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stype">Building*</label>
                                <select class="form-control bldgSelect" name="bldgID"> </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stype">Amount*</label>
                                <div class="input-group">
                                    <div class="input-group-addon"> <i>Php</i> </div>
                                    <input type="text" class="form-control" name="amt" placeholder="Php." /> </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Collection*</label>
                                <select class="form-control" name="collection">
                                    <option value='1'>Daily</option>
                                    <option value='2'>Weekly</option>
                                    <option value='3'>Monthly</option>
                                </select>
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
        getStallTypes();
        getBuildings();
        $('#table').DataTable({
            ajax: '/rateTable'
            , responsive: true
            , "columns": [
                {
                    "data": "srateID"
                }
                    , {
                    "data": "stall_type.stypeName"
                }
                    , {
                    "data": function (data, type, dataToSet) {
                        if (data.building !== null) return data.building.bldgName;
                        else return "All";
                    }
                }
                    , {
                    "data": "collection"
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
                    , "targets": 4
                    }
  ]
        });
        $("#newform").validate({
            rules: {
                amt: 'required'
            }
            , messages: {
                amt: "Please Enter Amount"
            }
            , errorClass: "error-class"
            , validClass: "valid-class"
        });
        $("#updateform").validate({
            rules: {
                amt: 'required'
                , bldgID: {
                    remote: {
                        url: '/checkRate'
                        , type: 'post'
                        , data: {
                            bldgID: function () {
                                return $("#updateform").find("select[name=bldgID]").val();
                            }
                            , _token: function () {
                                return $("#_token").val();
                            }
                            , stype: function () {
                                return $("#updateform").find("input[name=stypeID]").val();
                            }
                            , id: function () {
                                return $("#updateform").find("input[name=id]").val();
                            }
                        }
                    }
                }
            }
            , submitHandler: function () {
                var formData = new FormData($("#updateform")[0]);
                $.ajax({
                    type: "POST"
                    , url: '/updateRate'
                    , data: formData
                    , processData: false
                    , contentType: false
                    , context: this
                    , success: function (data) {
                        if (data == 'true') {
                            toastr.success('Updated Stall Rate');
                            $('#table').DataTable().ajax.reload();
                            $('#update').modal('hide');
                            getStallTypes()
                        }
                    }
                });
            }
            , messages: {
                amt: "Please Enter Amount"
                , bldgID: "Stall rate for selected building is set"
            }
            , errorClass: "error-class"
            , validClass: "valid-class"
        });
        $("#newform").submit(function (e) {
            e.preventDefault();
            if (!$("#newform").valid()) return;
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST"
                , url: '/addStallRate'
                , data: formData
                , processData: false
                , contentType: false
                , context: this
                , success: function (data) {
                    if (data == 'exist') {
                        toastr.warning('Stall Rate is already set');
                        return;
                    }
                    toastr.success('Added New Stall Type');
                    $('#table').DataTable().ajax.reload();
                    $('#new').modal('hide');
                    getStallTypes();
                }
            });
        });
        /*$("#updateform").unbind('submit').bind('submit', function (e) {
            e.preventDefault();
            if (!$("#updateform").valid()) return;
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST"
                , url: '/updateRate'
                , data: formData
                , processData: false
                , contentType: false
                , context: this
                , success: function (data) {
                    toastr.success('Updated Stall Rate');
                    $('#table').DataTable().ajax.reload();
                    $('#update').modal('hide');
                    getStallTypes()
                }
            });
        });*/
        $(".modal").on('hidden.bs.modal', function () {
            $(this).find('form').validate().resetForm();
            $(this).find('form')[0].reset();
        })
    });

    function getInfo(id) {
        $.ajax({
            type: "POST"
            , url: '/getRateInfo'
            , data: {
                "_token": "{{ csrf_token() }}"
                , "id": id
            }
            , success: function (data) {
                obj = JSON.parse(data)[0];
                $("#update").find('input[name=id]').val(obj.srateID);
                $("#update").find('input[name=stype]').val(obj.stall_type.stypeName);
                if (obj.building != null) $("#update").find('select[name=bldgID]').val(obj.building.bldgID);
                else $("#update").find('select[name=bldgID]').val(0);
                $("#update").find('input[name=amt]').val(obj.sratePrice);
                $("#update").find('select[name=collection]').val(obj.collection);
                $("#update").find('select[name=id]').val(obj.srateID);
                $("#update").find('input[name=stypeID]').val(obj.stypeID);
                $('#update').modal('show');
            }
        });
    }

    function getStallTypes() {
        $.ajax({
            type: "POST"
            , url: '/stypeOptions'
            , data: {
                "_token": "{{ csrf_token() }}"
            }
            , success: function (data) {
                stype = JSON.parse(data);
                var opt = "";
                for (var i = 0; i < stype.length; i++) {
                    var rate = null;
                    if (stype[i].stall_rate.length > 0) {
                        rate = _.find(stype[i].stall_rate, {
                            'bldgID': null
                        });
                    }
                    if (rate == null) opt += '<option value="' + stype[i].stypeID + '">' + stype[i].stypeName + '</option>';
                }
                $(".stypeSelect").each(function () {
                    $(this).html(opt);
                });
            }
        });
    }

    function getBuildings() {
        $.ajax({
            type: "POST"
            , url: '/bldgOptions'
            , data: {
                "_token": "{{ csrf_token() }}"
            }
            , success: function (data) {
                var building = JSON.parse(data);
                var opt = "<option value='0'>All</option>";
                for (var i = 0; i < building.length; i++) {
                    opt += '<option value="' + building[i].bldgID + '">' + building[i].bldgName + '</option>';
                }
                $(".bldgSelect").each(function () {
                    $(this).html(opt)
                });
            }
        });
    }
</script> @stop