@extends('layout.app') @section('title') {{"Stall"}} @stop @section('content-header')
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Maintenance</a></li>
    <li class="active">Stall</li>
</ol> @stop @section('content')
<div class="box box-primary">
    <div class="box-body">
        <div class="table-responsive">
            <div class="defaultNewButton">
                <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#new"><span class='fa fa-plus'></span>&nbspNew Stall</button>
                <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#updatemultiple"><span class='fa fa-pencil'></span>&nbspUpdate Multiple Stall</button>
                <div class=" pull-right" id="archive"> <a href="{{ url('/StallArchive') }}" class="btn btn-primary btn-flat"><span class='fa fa-archive'></span>&nbsp Archive</a> </div>
            </div>
            <table id="table" class="table table-bordered table-striped" role="grid">
                <thead>
                    <tr>
                        <th style="width: 100px;">Stall Code</th>
                        <th style="width: 180px;">Type</th>
                        <th style="width: 280px;">Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="new" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form action="" method="post" id="newform">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Stall</h4> </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stallID">Stall Code</label><span class="required">&nbsp*</span>
                                <input type="text" class="form-control" id="stallID" name="stallID" placeholder="Stall ID" readonly /> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Stall Type</label><span class="required">&nbsp*</span>
                                <!--<div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Stall Type <span class="caret"></span></button>
                                                    <ul class="dropdown-menu stalltype">
                                                        
                                                    </ul>
                                                </div>-->
                                <select class='stalltype form-control' name="type"> </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Building</label><span class="required">&nbsp*</span>
                                <select class="form-control bldgSelect" style="width: 100%;" name="building"> </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Floor</label><span class="required">&nbsp*</span>
                                <select class="form-control floorSelect" name="floor" style="width: 100%;"> </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="stypeDesc">Description</label>
                                <textarea class="form-control" name="desc" placeholder="Stall Description"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <label style="float:left">All labels with "*" are required</label> -->
                    <button class="btn btn-primary btn-flat"><span class='fa fa-save'></span>&nbspSave</button>
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
                                <label for="stallID">Stall ID</label><span class="required">&nbsp*</span>
                                <input type="text" class="form-control" name="stallID" placeholder="Stall ID" readonly/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Stall Type</label><span class="required">&nbsp*</span>
                                <select class='stalltype form-control' name="type"> </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Building</label><span class="required">&nbsp*</span>
                                <input class="form-control" type="text" style="width: 100%;" name="building" readonly> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Floor</label><span class="required">&nbsp*</span>
                                <input name="floor" class="form-control" type="text" name="floor" style="width: 100%;" readonly> </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="stypeDesc">Description</label>
                                <textarea class="form-control" name="desc" placeholder="Stall Description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="checkbox" name="electricity">
                            <labe>Electrity</labe>
                        </div>
                        <div class="col-md-6">
                            <input type="checkbox" name="water">
                            <labe>Water</labe>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <label style="float:left">All labels with "*" are required</label> -->
                    <button class="btn btn-primary btn-flat"><span class='fa fa-save'></span>&nbspSave</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="updatemultiple" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form action="" method="post" id="updatemultiform">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Update Multiple Stall</h4> </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stallID">Stalls</label><span class="required">&nbsp*</span>
                                <select id='stallMulti' class="js-example-basic-multiple stypeSelect form-control" multiple='multiple' name="stalls[]" style="width:100%"> </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Stall Type</label><span class="required">&nbsp*</span>
                                <select class='stalltype form-control' name="type"> </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="stypeDesc">Description</label>
                                <textarea class="form-control" name="desc" placeholder="Stall Description"></textarea>
                            </div>
                        </div>
                    </div>
                    <label>Utilities</label>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="checkbox" name="electricity">
                            <labe>Electrity</labe>
                        </div>
                        <div class="col-md-6">
                            <input type="checkbox" name="water">
                            <labe>Water</labe>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <label style="float:left">All labels with "*" are required</label> -->
                    <button class="btn btn-primary btn-flat"><span class='fa fa-save'></span>&nbspSave</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop @section('script')
<script type="text/javascript">
    var obj;
    var building;
    var selected;
    $(document).ready(function () {
        getStallList();
        getBuildings();
        getStallTypes();
        $('.js-example-basic-multiple').select2({
            width: 'resolve'
        });
        $("#newform").validate({
            errorClass: "error-class"
            , validClass: "valid-class"
        });
        $("#updateform").validate({
            errorClass: "error-class"
            , validClass: "valid-class"
        });
        $('#table').DataTable({
            ajax: '/stallTable'
            , responsive: true
            , "columns": [
                {
                    "data": "stallID"
                    }
                    , {
                    "data": function (data, type, dataToSet) {
                        if (data.stypeName != null) {
                            return data.stypeName + "(" + data.stypeArea + "m&sup2;)";
                        }
                        else {
                            return "N/A";
                        }
                    }
                    }
                    , {
                    "data": function (data, type, dataToSet) {
                        return "Floor " + data.floorLevel + ", " + data.bldgName;
                    }
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
        $("#updatemultiform").unbind('submit').bind('submit', function (e) {
            e.preventDefault();
            if (!$("#updatemultiform").valid()) return;
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST"
                , url: '/UpdateStalls'
                , data: formData
                , processData: false
                , contentType: false
                , context: this
                , success: function (data) {
                    toastr.success('Updated Stalls');
                    $('#table').DataTable().ajax.reload();
                    $('#updatemultiple').modal('hide');
                }
            });
        });
        
        $(".modal").on('hidden.bs.modal', function () {
            $(this).find('form').validate().resetForm();
            $(this).find('form')[0].reset();
            $(".removable").remove();
        });
        
        $(".modal").on('shown.bs.modal', function () {
            $('#newform').find('.bldgSelect').trigger('change');
            $('#newform').find('.floorSelect').trigger('change');
            if ($(this)[0] == $('#update')[0]) {
                if (obj.stype_SizeID != null) $(this).find('select[name=type]').val(obj.stype_SizeID);
                else $(this).find('select[name=type]')[0].selectedIndex = -1;
                $(this).find('input[name=stallID]').val(obj.stallID);
                $(this).find('input[name=floor]').val(obj.floor.floorLevel);
                $(this).find('input[name=building]').val(obj.floor.building.bldgName);
                $(this).find('textarea[name=desc]').val(obj.stallDesc);
                
                for(var i = 0;i < obj.stall_utility.length; i++){
                    alert(obj.stall_utility[i].utilityType);
                    if(obj.stall_utility[i].utilityType == 1)
                         $(this).find('input[name=electricity]').click();
                    else if(obj.stall_utility[i].utilityType == 2)
                         $(this).find('input[name=water]').click();
                }
            }
        })
        
        $("#newform .bldgSelect").on("change", function () {
            selected = building[$(this).val()];
            if (selected == undefined)
                return;
            var option = "";
            for (var i = 0; i < selected.floor.length; i++) {
                option += "<option value='" + selected.floor[i].floorID + "'>" + selected.floor[i].floorLevel + "</option>";
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
                    opt += "<optgroup label='" + stype[i].stypeName + "'>";
                    for (var j = 0; j < stype[i].s_type_size.length; j++) {
                        opt += '<option value="' + stype[i].s_type_size[j].pivot.stype_SizeID + '">' + stype[i].s_type_size[j].stypeArea + 'm&sup2;</sup></option>';
                    }
                    opt += "</optgroup>";
                }
                $(".stalltype").each(function () {
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
    
    function getStallList(){
        $.ajax({
            type: "POST"
            , url: '/getStallList'
            , data: {
                "_token": "{{ csrf_token() }}"
            }
            , success: function (data) {
                var stalls = JSON.parse(data);
                var opt = '';
                for(var i = 0;i<stalls.length;i++){
                    opt += "<optgroup label='"+stalls[i].bldgName+"'>";
                    
                    for(var j = 0;j < stalls[i].floor.length; j++){
                        for(var k = 0;k < stalls[i].floor[j].stall.length; k++){
                            opt += "<option value='"+ stalls[i].floor[j].stall[k].stallID +"'>"+ stalls[i].floor[j].stall[k].stallID +"</option>";
                        }
                    }
                    opt += "</optgroup>";
                }
                $('#stallMulti').html(opt);
            }
        });
    }
</script> @stop