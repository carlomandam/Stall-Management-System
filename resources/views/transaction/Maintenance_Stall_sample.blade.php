@extends('layout.app') @section('content-header')
<h1>
        Stall 
        
      </h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Maintenance</a></li>
    <li class="active">Stall</li>
</ol> @stop @section('content')
<div style="margin-top:2%;">
    <button class="btn btn-primary" data-toggle="modal" data-target="#new"><span class='glyphicon glyphicon-plus'></span>Add New Stall</button>
    <button class="btn btn-primary" data-toggle="modal" data-target="#multiupdate"><span class='glyphicon glyphicon-plus'></span>Update Multiple</button>
</div>
<div style="border:2px solid black;">
    <div class="table-responsive">
        <table id="table" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
            <thead>
                <tr>
                    <th>Stall</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="new" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form action="" method="post" id="newform">
            <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Stall</h4> </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stallID">Stall ID*</label>
                                <input type="text" class="form-control" id="stallID" name="stallID" placeholder="Stall ID" readonly /> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Stall Type*</label>
                                <select class="form-control stypeSelect" style="width: 100%;" name="type"> </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Building*</label>
                                <select class="form-control bldgSelect" style="width: 100%;" name="building"> </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Floor*</label>
                                <select class="form-control floorSelect" name="floor" style="width: 100%;"> </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="stypeDesc">Description</label>
                                <textarea class="form-control" id="stypeDesc" name="desc" placeholder="Stall Type Description"></textarea>
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
<div class="modal fade" tabindex="-1" id="update" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form action="" method="post" id="updateform">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Stall</h4> </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stallID">Stall ID*</label>
                                <input type="text" class="form-control" name="stallID" placeholder="Stall ID" readonly/> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Stall Type*</label>
                                <select class="form-control stypeSelect" style="width: 100%;" name="type"> </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Building*</label>
                                <input class="form-control" type="text" style="width: 100%;" name="building" readonly> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Floor*</label>
                                <input name="floor" class="form-control" type="text" name="floor" style="width: 100%;" readonly> </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="stypeDesc">Description</label>
                                <textarea class="form-control" id="stypeDesc" name="desc" placeholder="Stall Type Description"></textarea>
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
    var building;
    var selected;
    $(document).ready(function () {
        $('#table').DataTable({
            ajax: '/stallTable'
            , responsive: true
            , "columns": [
                {
                    "data": "stallID"
                    }
                    , {
                    "data": "stall_type.stypeName"
                    }
                    , {
                    "data": function (data, type, dataToSet) {
                        return "Floor " + data.floor.floorNo + ", " + data.floor.building.bldgName;
                    }
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
        $("#newform").unbind('submit').bind('submit', function (e) {
            e.preventDefault();
            if (!$("#newform").valid()) return;
            $(this).find('.bldgSelect').val(selected.bldgID);
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST"
                , url: '/addStall'
                , data: formData
                , processData: false
                , contentType: false
                , context: this
                , success: function (data) {
                    toastr.success('Added New Stall');
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
                , url: '/UpdateStall'
                , data: formData
                , processData: false
                , contentType: false
                , context: this
                , success: function (data) {
                    if (data) {
                        toastr.success('Updated Stall Type Information');
                        $('#table').DataTable().ajax.reload();
                        $('#update').modal('hide');
                    }
                }
            });
        });
        $(".modal").on('hidden.bs.modal', function () {
            $(this).find('form').validate().resetForm();
            $(this).find('form')[0].reset();
            $(".removable").remove();
        })
        $(".modal").on('shown.bs.modal', function () {
            getBuildings();
            getStallTypes();
            getUtilities();
            if ($(this)[0] == $('#update')[0]) {
                $(this).find('input[name=stallID]').val(obj.stallID);
                $(this).find('input[name=floor]').val(obj.floor.floorNo);
                $(this).find('input[name=building]').val(obj.floor.building.bldgName);
            }
        })
        document.getElementById('update').addEventListener('utilready', function (e) {
            for (var i = 0; i < obj.stall_util.length; i++) {
                $(this).find('input[name=util\\[\\]][value=' + obj.stall_util[i].utilID + ']').trigger('click');
                $(this).find('input[name=utilRadio' + obj.stall_util[i].utilID + '][value=' + obj.stall_util[i].RateType + ']').trigger('click');
                $(this).find('input[name=utilAmount' + obj.stall_util[i].utilID + ']').val(obj.stall_util[i].Rate);
            }
        }, false);
        $("#newform .bldgSelect").on("change", function () {
            selected = building[$(this).val()];
            var option = "";
            for (var i = 0; i < selected.floor.length; i++) {
                option += "<option value='" + selected.floor[i].floorID + "'>" + selected.floor[i].floorNo + "</option>";
            }
            $(this).parent().parent().next().find('.floorSelect').html(option).trigger('change');
        })
        $('#newform .floorSelect').on('change', function () {
            $.ajax({
                type: "post"
                , url: "/getStallID"
                , data: {
                    "code": building[$(this).parent().parent().prev().find(".bldgSelect")[0].selectedIndex].bldgCode
                    , "floor": this.selectedIndex + 1
                    , "_token": "{{ csrf_token() }}"
                }
                , context: this
                , success: function (data) {
                    $(this).parent().parent().prev().prev().prev().find('input[name=stallID]').val(data);
                }
            });
        });
        $('form').on('click', 'input[type=checkbox]', function (e) {
            if ($(this).prop('checked')) {
                $(this).parent().find('*').not(this).prop('disabled', false);
            }
            else {
                $(this).parent().find('*').not(this).prop('disabled', true);
            }
        });
    });

    function getInfo(id) {
        $.ajax({
            type: "POST"
            , url: '/getStallInfo'
            , data: {
                "_token": "{{ csrf_token() }}"
                , "id": id
            }
            , success: function (data) {
                obj = JSON.parse(data);
                $('#update').modal('show');
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
                building = JSON.parse(data);
                var opt = "";
                for (var i = 0; i < building.length; i++) {
                    opt += '<option value="' + i + '">' + building[i].bldgName + '</option>';
                }
                $(".bldgSelect").each(function () {
                    $(this).html(opt).trigger('change');
                });
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
                    opt += '<option value="' + stype[i].stypeID + '">' + stype[i].stypeName + '</option>';
                }
                $(".stypeSelect").each(function () {
                    $(this).html(opt);
                });
            }
        });
    }

    function deleteStall(id) {
        $.ajax({
            type: "POST"
            , url: '/deleteStall'
            , data: {
                "_token": "{{ csrf_token() }}"
                , "id": id
            }
            , success: function (data) {
                $('#table').DataTable().ajax.reload();
                toastr.success('Stall Deleted');
            }
        });
    }

    function getUtilities() {
        $.ajax({
            type: "POST"
            , url: '/getUtilities'
            , data: {
                "_token": "{{ csrf_token() }}"
            }
            , success: function (data) {
                var response = JSON.parse(data);
                if (response.length == 0) return;
                var utilities = "<div class='col-md-12 removable'><h3>Utilities</h3></div>";
                for (var i = 0; i < response.length; i++) {
                    var id = response[i].utilID;
                    var name = response[i].utilName;
                    var rate = response[i].utilDefaultMR;
                    if (i % 2 == 0) utilities += "<div class='col-md-12 removable'>";
                    utilities += "<div class='col-md-6'><div class='form-group'><input type='checkbox' value='" + id + "' name='util[]'><lable>" + name.toUpperCase() + "</lable><br><ul><li><input type='radio' name='utilRadio" + id + "' value='1' onclick='$(this).parent().next().find(&#039input[type=text]&#039).prop(&#039disabled&#039, true);' value='1' disabled><lable>Monthly Reading</lable></li><li><input type='radio' value='2' name='utilRadio" + id + "' onclick='$(this).siblings(&#039input[type=text]&#039).prop(&#039disabled&#039, false);' disabled><lable>Fixed Rate</lable><input type='text' name='utilAmount" + id + "' disabled></li></ul></div></div>";
                    if (i % 2 != 0) utilities += '</div>';
                }
                $('.modal-body').each(function () {
                    $(this).append(utilities);
                });
                var evt = new CustomEvent('utilready', {
                    detail: {
                        message: "yow"
                    }
                });
                $('#update')[0].dispatchEvent(evt);
            }
        })
    }
</script> @stop