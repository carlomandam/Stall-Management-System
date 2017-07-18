@extends('layout.app') @section('content-header')
<h1>
        Stall Type 
        
      </h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Maintenance</a></li>
    <li class="active">Stall Type</li>
</ol> @stop @section('content')
<div style="margin-top:2%;">
    <button class="btn btn-primary" data-toggle="modal" data-target="#new"><span class='glyphicon glyphicon-plus'></span>Add Stall Type </button>
</div>
<div style="border:2px solid black;">
    <div class="table-responsive">
        <table id="table" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
            <thead>
                <tr>
                    <th>Stall Type</th>
                    <th>Area</th>
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
                    <h4 class="modal-title">Add Stall Type</h4> </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="stypeName">Stall Type Name*</label>
                                <input type="text" class="form-control" id="stypeName" name="stypeName" placeholder="Stall Type Name" /> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stypeLength">Stall Type Length(meter)</label>
                                <input type="text" class="form-control" id="stypeLength" name="stypeLength" placeholder="Stall Type Length" /> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stypeWidth">Stall Type Width(meter)</label>
                                <input type="text" class="form-control" id="stypeWidth" name="stypeWidth" placeholder="Stall Type Width" /> </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="stypeDesc">Description</label>
                                <textarea class="form-control" id="stypeDesc" name="stypeDesc" placeholder="Stall Type Description"></textarea>
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
            <input type="hidden" id="_tokenUp" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="id" id="idUp">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Update Stall Type Information</h4> </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="stypeNameUp">Stall Type Name*</label>
                                <input type="text" class="form-control" id="stypeNameUp" name="stypeName" placeholder="Stall Type Name" /> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stypeLengthUp">Stall Type Length(meter)</label>
                                <input type="text" class="form-control" id="stypeLengthUp" name="stypeLength" placeholder="Length" /> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stypeWidthUp">Stall Type Width(meter)</label>
                                <input type="text" class="form-control" id="stypeWidthUp" name="stypeWidth" placeholder="Width" /> </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="stypeDescUp">Description</label>
                                <textarea class="form-control" id="stypeDescUp" name="stypeDesc" placeholder="Stall Type Description"></textarea>
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
<script>
    var obj;
    var chk;
    $(document).ready(function () {
        jQuery.validator.addMethod("length", function (value, element) {
            if ($(element).parent().parent().parent().find('input[name=stypeWidth]').val() != '' && element.value == '') return false;
            else return true;
        }, "Enter Length");
        jQuery.validator.addMethod("width", function (value, element) {
            if ($(element).parent().parent().parent().find('input[name=stypeLength]').val() != '' && element.value == '') return false;
            else return true;
        }, "Enter Width");
        $("#newform").validate({
            rules: {
                stypeName: {
                    required: true
                    , remote: {
                        url: '/checkSTypeName'
                        , type: 'post'
                        , data: {
                            stypeName: function () {
                                return $("#newform").find("input[name=stypeName]").val();
                            }
                            , _token: function () {
                                return $("#_token").val();
                            }
                        }
                    }
                }
                , stypeLength: {
                    length: true
                }
                , stypeWidth: {
                    width: true
                }
            }
            , messages: {
                stypeName: {
                    required: "Please enter Stall Type Name"
                    , remote: "Stall Type Name is taken"
                }
            }
            , errorClass: "error-class"
            , validClass: "valid-class"
        });
        $("#updateform").validate({
            rules: {
                stypeName: {
                    required: true
                    , remote: {
                        url: '/checkSTypeName'
                        , type: 'post'
                        , data: {
                            stypeName: function () {
                                return $("#newform").find("input[name=stypeName]").val();
                            }
                            , _token: function () {
                                return $("#_token").val();
                            }
                        }
                        , dataFilter: function (response) {
                            if (obj.stypeName == $("#stypeNameUp").val()) return true;
                            else return response;
                        }
                    }
                }
            }
            , messages: {
                stypeName: {
                    required: "Please enter Stall Type Name"
                    , remote: "Stall Type Name is taken"
                }
            }
            , errorClass: "error-class"
            , validClass: "valid-class"
        });
        $('#table').DataTable({
            ajax: '/stypeTable'
            , responsive: true
            , "columns": [{
                    "data": "stypeName"
                    }
                    , {
                    "data": function (data, type, dataToSet) {
                        if (data.stypeLength * data.stypeWidth == 0) return "N/A";
                        else return (data.stypeLength * data.stypeWidth) + "m" + "2".sup() + "(L: " + data.stypeLength + "m W: " + data.stypeWidth + "m)";
                    }
                    }
                    , {
                    "data": "stypeDesc"
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
                , url: '/addStallType'
                , data: formData
                , processData: false
                , contentType: false
                , context: this
                , success: function (data) {
                    toastr.success('Added New Stall Type');
                    $('#table').DataTable().ajax.reload();
                    $('#new').modal('hide');
                }
            });
        });
        $("#updateform").unbind('submit').bind('submit', function (e) {
            e.preventDefault();
            if (!$("#updateform").valid()) return;
            var hasChange = false;
            if ($("#stypeNameUp").val() != obj.stypeName) hasChange = true;
            if ($("#stypeLengthUp").val() != obj.stypeLength) hasChange = true;
            if ($("#stypeWidthUp").val() != obj.stypeWidth) hasChange = true;
            if ($("#stypeDescUp").val() != obj.stypeDesc) hasChange = true;
            if (!hasChange) return;
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST"
                , url: '/UpdateSType'
                , data: formData
                , processData: false
                , contentType: false
                , context: this
                , success: function (data) {
                    toastr.success('Updated Stall Type Information');
                    $('#table').DataTable().ajax.reload();
                    $('#update').modal('hide');
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
            , url: '/getSTypeInfo'
            , data: {
                "_token": "{{ csrf_token() }}"
                , "id": id
            }
            , success: function (data) {
                obj = JSON.parse(data)[0];
                $("#idUp").val(obj.stypeID);
                $("#stypeNameUp").val(obj.stypeName);
                $("#stypeLengthUp").val(obj.stypeLength);
                $("#stypeWidthUp").val(obj.stypeWidth);
                $("#stypeDescUp").val(obj.stypeDesc);
                $('#update').modal('show');
            }
        });
    }

    function deleteBuilding(id) {
        $.ajax({
            type: "POST"
            , url: '/deleteSType'
            , data: {
                "_token": "{{ csrf_token() }}"
                , "id": id
            }
            , success: function (data) {
                $('#table').DataTable().ajax.reload();
                toastr.success('Stall Type Deleted');
            }
        });
    }
</script> @stop