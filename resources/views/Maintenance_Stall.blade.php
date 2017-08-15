@extends('layout.app')
@section('title')
    {{"Stall"}}
@stop
@section('content-header')
 
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Maintenance</a></li>
                    <li class="active">Stall</li>
                </ol>
@stop

@section('content')
<div class = "box box-primary">
    <div class = "box-body">             
                    <div class="table-responsive">
                        <div class = "defaultNewButton">
                            <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#new"><span class='fa fa-plus'></span>&nbspNew Stall</button>
                              <div class = " pull-right" id = "archive">
                                          <a href="{{ url('/StallArchive') }}" class="btn btn-primary btn-flat" ><span class='fa fa-archive'></span>&nbspArchive</a>
                             </div>
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
                                                <select class='stalltype form-control' name="type">
                                                    
                                                </select>
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
                                                <input type="text" class="form-control" name="stallID" placeholder="Stall ID" readonly/> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Stall Type</label><span class="required">&nbsp*</span>
                                                <!--<div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Stall Type <span class="caret"></span></button>
                                                    <ul class="dropdown-menu stalltype">
                                                        
                                                    </ul>
                                                </div>-->
                                                <select class='stalltype form-control' name="type">
                                                    
                                                </select>
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
                                </div>
                                <div class="modal-footer">
                                    <!-- <label style="float:left">All labels with "*" are required</label> -->
                                <button class="btn btn-primary btn-flat"><span class='fa fa-save'></span>&nbspSave</button>
                                </div>
                                  
                            </div>
                        </form>
                    </div>
                </div>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript">
	  var obj;
        var building;
        var selected;
        $(document).ready(function () {
            getBuildings();
            getStallTypes();
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
                            if(data.stypeName != null){
                                return data.stypeName + "("+data.stypeArea+"m&sup2;)";
                            }
                            else{
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
                        if(data){
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
                getUtilities(this);
                $('#newform').find('.bldgSelect').trigger('change');
                $('#newform').find('.floorSelect').trigger('change');
                if ($(this)[0] == $('#update')[0]) {
                    if(obj.stype_SizeID != null)
                        $(this).find('select[name=type]').val(obj.stype_SizeID);
                    else
                        $(this).find('select[name=type]')[0].selectedIndex = -1;
                    $(this).find('input[name=stallID]').val(obj.stallID);
                    $(this).find('input[name=floor]').val(obj.floor.floorLevel);
                    $(this).find('input[name=building]').val(obj.floor.building.bldgName);
                }
            })
            document.getElementById('update').addEventListener('utilready', function (e) {
                for (var i = 0; i < obj.stall_util.length; i++) {
                    $(this).find('input[name=util\\[\\]][value='+obj.stall_util[i].utilID+']').trigger('click');
                    
                    $(this).find('input[name=utilRadio'+obj.stall_util[i].utilID+'][value='+obj.stall_util[i].RateType+']').trigger('click');
                    
                    if(obj.stall_util[i].Rate != 0)
                        $(this).find('input[name=utilAmount'+obj.stall_util[i].utilID+']').val(obj.stall_util[i].Rate);
                    
                    $(this).find('input[name=meter'+obj.stall_util[i].utilID+']').val(obj.stall_util[i].meterID);
                }
                $(this).find('.stypeSelect').val(obj.stypeID);
            }, false);
            $("#newform .bldgSelect").on("change", function () {
                selected = building[$(this).val()];
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
            
            $('form').on('click','input[type=checkbox]',function(e){
                if($(this).prop('checked')){
                    $(this).parent().find('*').not(this).prop('disabled',false);
                }else{
                    $(this).parent().find('*').not(this).prop('disabled',true);
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
                        opt += "<optgroup label='"+stype[i].stypeName+"'>";
                        for(var j = 0; j < stype[i].s_type_size.length; j++){
                            opt += '<option value="'+stype[i].s_type_size[j].pivot.stype_SizeID+'">' + stype[i].s_type_size[j].stypeArea + 'm&sup2;</sup></option>';   
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

        function getUtilities(elem) {
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
                        if (i % 2 == 0)
                            utilities += "<div class='col-md-12 removable'>";
                        utilities += "<div class='col-md-6'><div class='form-group'><input type='checkbox' value='" + id + "' name='util[]'><label>" + name.toUpperCase() + "</label><br><ul><li><input type='radio' name='utilRadio"+id+"' value='1' onclick='$(this).parent().next().find(&#039input[type=text]&#039).prop(&#039disabled&#039, true);' value='1' disabled><label>Monthly Reading</label></li><li><input type='radio' value='2' name='utilRadio"+id+"' onclick='$(this).siblings(&#039input[type=text]&#039).prop(&#039disabled&#039, false);' disabled><label>Fixed Rate</label><input class='rate' type='text' name='utilAmount"+id+"' disabled></li>";
                        if(response[i].isMetered == 1)
                            utilities += "<li><label>Meter ID</label><input type='text' name='meter"+id+"' disabled></li>";
                        utilities += "</ul></div></div>";
                        if (i % 2 != 0) utilities += '</div>';
                    }
                    
                    $('.modal-body').each(function () {
                        $(this).append(utilities);
                    });
                    
                    $('.rate').each(function() {
                        $(this).rules("add", 
                            {
                                required: true
                            })
                    });
                    
                    if(elem == $('#update')[0]){
                        var evt = new CustomEvent('utilready',{detail:{ message : "yow"}});
                        $('#update')[0].dispatchEvent(evt);
                    }
                }
            })
        }
</script>
@stop