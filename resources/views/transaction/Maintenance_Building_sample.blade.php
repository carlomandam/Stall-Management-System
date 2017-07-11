@extends('layout.app')
@section('content-header')

 <h1>
        Building 
       
      </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Maintenance</a></li>
            <li class="active">Building</li>
        </ol>
        @stop

        @section('content')

<div style="margin-top:2%;">
            <button class="btn btn-primary" data-toggle="modal" data-target="#new"><span class='glyphicon glyphicon-plus'></span>Add New Building</button>
        </div>
        <div style="border:2px solid black;">
            <div class="table-responsive">
                <table id="prodtbl" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Description</th>
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
                            <h4 class="modal-title">Add Building</h4> </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="bldgName">Building Name*</label>
                                        <input type="text" class="form-control" id="bldgName" name="bldgName" placeholder="Building Name" /> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bldgCode">Building Code*</label>
                                        <input type="text" class="form-control" id="bldgCode" name="bldgCode" placeholder="Building Code" /> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="noOfFloor">No. of Floors*</label>
                                        <input type="text" class="form-control" id="noOfFloor" name="noOfFloor" placeholder="No. of Floors" oninput="showTable()" /> </div>
                                    <table id='floortbl'>
                                        <thead>
                                            <tr>
                                                <th width='50%'>Floor</th>
                                                <th width='50%'>No. Of Stalls</th>
                                            </tr>
                                        </thead>
                                        <tbody> </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="bldgDesc">Description</label>
                                        <textarea class="form-control" id="bldgDesc" name="bldgDesc" placeholder="Building Description"></textarea>
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
                <form class="building" action="" method="post" id="updateform">
                    <input type="hidden" id="_tokenUp" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id" id="idUp">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Update Building Information</h4> </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="bldgNameUp">Building Name*</label>
                                        <input type="text" class="form-control" id="bldgNameUp" name="bldgName" placeholder="Building Name" /> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bldgCodeUp">Building Code*</label>
                                        <input type="text" class="form-control" id="bldgCodeUp" name="bldgCode" placeholder="Building Code" /> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="noOfFloorUp">No. of Floors*</label>
                                        <input type="text" class="form-control" id="noOfFloorUp" name="noOfFloor" placeholder="No. of Floors" /> </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="bldgDescUp">Description</label>
                                        <textarea class="form-control" id="bldgDescUp" name="bldgDesc" placeholder="Building Description"></textarea>
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
          @stop

  @section('script')
  <script type="text/javascript">
    var obj;
    $(document).ready(function () {
        $("#newform").validate({
            rules: {
                bldgName: {
                    required: true
                    , remote: {
                        url: '/checkBldgName'
                        , type: 'post'
                        , data: {
                            bldgName: function () {
                                return $("#newform").find("input[name=bldgName]").val();
                            }
                            , _token: function () {
                                return $("#_token").val();
                            }
                        }
                    }
                }
                , bldgCode: {
                    required: true
                    , remote: {
                        url: '/checkBldgCode'
                        , type: 'post'
                        , data: {
                            bldgCode: function () {
                                return $("#newform").find("input[name=bldgCode]").val();
                            }
                            , _token: function () {
                                return $("#_token").val();
                            }
                        }
                    }
                }
                , noOfFloor: "required"
            }
            , messages: {
                bldgName: {
                    required: "Please enter Building Name"
                    , remote: "Building Name is taken"
                }
                , bldgCode: {
                    required: "Please enter Building Code"
                    , remote: "Building Code is taken"
                }
                , noOfFloor: "Please enter number of floors"
            }
            , errorClass: "error-class"
            , validClass: "valid-class"
        });
        $("#updateform").validate({
            rules: {
                bldgName: {
                    required: true
                    , remote: {
                        type: "POST"
                        , url: '/checkBldgName'
                        , data: {
                            bldgName: function () {
                                return $("#bldgNameUp").val();
                            }
                            , _token: function () {
                                return $("#_token").val();
                            }
                        }
                        , dataFilter: function (response) {
                            if (obj.bldgName == $("#bldgNameUp").val()) return true;
                            else return response;
                        }
                    }
                }
                , bldgCode: {
                    required: true
                    , remote: {
                        type: "POST"
                        , url: '/checkBldgCode'
                        , data: {
                            bldgName: function () {
                                return $("#bldgCodeUp").val();
                            }
                            , _token: function () {
                                return $("#_token").val();
                            }
                        }
                        , dataFilter: function (response) {
                            if (obj.bldgCode == $("#bldgCodeUp").val()) return true;
                            else return response;
                        }
                    }
                }
                , noOfFloor: "required"
            }
            , messages: {
                bldgName: {
                    required: "Please enter Building Name"
                    , remote: "Building Name is taken"
                }
                , bldgCode: {
                    required: "Please enter Building Code"
                    , remote: "Building Code is taken"
                }
                , noOfFloor: "Please enter number of floors"
            }
            , errorClass: "error-class"
            , validClass: "valid-class"
        });
        $('#prodtbl').DataTable({
            ajax: '/bldgTable'
            , responsive: true
            , "columns": [
                 {
                    "data": "bldgName"
                    }
                    , {
                    "data": "bldgCode"
                    }
                    , {
                    "data": "bldgDesc"
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
                , url: '/AddBuilding'
                , data: formData
                , processData: false
                , contentType: false
                , context: this
                , success: function (data) {
                    toastr.success('Added New Building');
                    $('#prodtbl').DataTable().ajax.reload();
                    $('#new').modal('hide');
                }
            });
        });
        $("#updateform").unbind('submit').bind('submit', function (e) {
            e.preventDefault();
            if (!$("#updateform").valid()) return;
            var hasChange = false;
            if ($("#bldgNameUp").val() != obj.bldgName) hasChange = true;
            if ($("#bldgCodeUp").val() != obj.bldgCode) hasChange = true;
            if ($("#bldgDesceUp").val() != obj.bldgDesc) hasChange = true;
            if (!hasChange) return;
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST"
                , url: '/UpdateBuilding'
                , data: formData
                , processData: false
                , contentType: false
                , context: this
                , success: function (data) {
                    toastr.success('Updated Building Information');
                    $('#prodtbl').DataTable().ajax.reload();
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
            , url: '/getBuildingInfo'
            , data: {
                "_token": "{{ csrf_token() }}"
                , "id": id
            }
            , success: function (data) {
                obj = JSON.parse(data)[0];
                $("#idUp").val(obj.bldgID);
                $("#bldgNameUp").val(obj.bldgName);
                $("#bldgCodeUp").val(obj.bldgCode);
                $("#bldgDescUp").val(obj.bldgDesc);
                $("#noOfFloorUp").val(obj.noOfFloor);
                $('#update').modal('show');
            }
        });
    }

    function deleteBuilding(id) {
        $.ajax({
            type: "POST"
            , url: '/deleteBuilding'
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

    function showTable() {
        $('#floortbl').css('display', 'inline');
        $('.removable').remove();
        for (var i = 0; i < parseInt($('#floortbl').parent().find('input[name=noOfFloor]').val()); i++) {
            $('#floortbl tbody').append('<tr class="removable"><td>' + (i + 1) + '</td><td><input type="text" name="noOfStall[]"></td></tr>')
        }
    }
    </script>
    @stop