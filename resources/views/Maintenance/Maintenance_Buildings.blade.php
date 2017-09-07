@extends('layout.app') @section('title') {{ 'Building'}} @stop @section('content-header')
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Maintenance</li>
    <li class="active">Building</li>
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
                <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#new"><span class='fa fa-plus'></span>&nbspNew Building</button>
                <div class=" pull-right" id="archive"> <a href="{{ url('/BuildingArchive') }}" class="btn btn-primary btn-flat"><span class='fa fa-archive'></span>&nbspArchive</a> </div>
            </div>
            <table id="prodtbl" class="table table-responsive table-bordered table-striped" role="grid">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th style="width: 100px;">No. of Floors</th>
                        <th>Description</th>
                        <th style="width: 280px;">Actions</th>
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
                        <h4 class="modal-title">New Building</h4> </div>
                    <div class="modal-body">
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="bldgName">Building Name</label><span class="required">&nbsp*</span>
                                    <input type="text" class="form-control" id="bldgName" name="bldgName" placeholder="Building Name" /> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bldgCode">Building Code</label><span class="required">&nbsp*</span>
                                    <input type="text" class="form-control" id="bldgCode" name="bldgCode" placeholder="Building Code" /> </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="bldgDesc">Description</label>
                                    <textarea class="form-control" id="bldgDesc" name="bldgDesc" placeholder="Building Description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <label for="bldgDesc">No. of Floors</label>
                                            <div class="input-group"> <span class="input-group-btn">
                                          <button type="button" class="btn btn-default btn-number" data-type="minus" data-field="noOfFloor" disabled>
                                          <span class="glyphicon glyphicon-minus"></span> </button>
                                                </span>
                                                <input type="text" name="noOfFloor" class="form-control input-number" value="1" min="1" max="100" oninput="showTable('#floortbl')" onchange="showTable('#floortbl')"> <span class="input-group-btn">
                                              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="noOfFloor">
                                                  <span class="glyphicon glyphicon-plus"></span> </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="errordiv" style="width:200%"> </div>
                                        <table class="table table-bordered table-striped" role="grid" id='floortbl'>
                                            <thead>
                                                <th style="width:40%">Floor No.</th>
                                                <th style="width:60%">No. of stalls
                                                    <button class="btn btn-default" onclick="resetNoOfStall()" type="button">reset</button>
                                                </th>
                                            </thead>
                                            <tbody>
                                                <tr class="removable first">
                                                    <td>1</td>
                                                    <td>
                                                        <input type="text" name="noOfStall[]" onchange="addNoOfStall(this)">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                <div id="tabcontroll" class="container" style="width:100%">
                    <ul class="nav nav-pills">
                        <li class="active"> <a href="#1" data-toggle="tab">Building</a> </li>
                        <li><a href="#2" data-toggle="tab">Floors</a> </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="1">
                            <form class="building" action="" method="post" id="updateform">
                                <input type="hidden" id="_tokenUp" name="_token" value="<?php echo csrf_token(); ?>">
                                <input type="hidden" name="id" id="idUp">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="bldgNameUp">Building Name</label><span class="required">&nbsp*</span>
                                            <input type="text" class="form-control" id="bldgNameUp" name="bldgName" placeholder="Building Name" /> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bldgCodeUp">Building Code</label><span class="required">&nbsp*</span>
                                            <input type="text" class="form-control" id="bldgCodeUp" name="bldgCode" placeholder="Building Code" /> </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="bldgDescUp">Description</label>
                                            <textarea class="form-control" id="bldgDescUp" name="bldgDesc" placeholder="Building Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="bldgDescUp">Current No Of Floor</label>
                                            <input type="text" id="curfloor" style="text-align:center" readonly> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bldgDesc">Add Floor(/s)</label>
                                            <div class="input-group"> <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default btn-number" data-type="minus" data-field="noOfFloorUp" disabled>
                                                        <span class="glyphicon glyphicon-minus"></span> </button>
                                                </span>
                                                <input type="text" name="noOfFloorUp" id="#noOfFloorUp" class="form-control input-number" value="0" min="0" max="100" oninput="showTable('#floortblup')" onchange="showTable('#floortblup')"> <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="noOfFloorUp">
                                                  <span class="glyphicon glyphicon-plus"></span> </button>
                                                </span>
                                            </div>
                                            <table class="table table-bordered table-striped" role="grid" id='floortblup'>
                                                <thead>
                                                    <tr>
                                                        <th width='50%'>Floor</th>
                                                        <th width='50%'>No. Of Stalls</th>
                                                    </tr>
                                                </thead>
                                                <tbody> </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bldgDesc">Remove Floor(/s)</label>
                                            <input id="removefloor" type="text" class="form-control input-number" name="remove" placeholder="Enter number of floors"> </div>
                                    </div>
                                </div>
                                <p class="small text-danger">Fields with asterisks(*) are required</p>
                            </form>
                        </div>
                        <div class="tab-pane" id="2">
                            <table class="table table-bordered table-striped" role="grid" id='floorUpTbl'>
                                <thead>

                                <th style="width:40%">Floor No.</th>
                                <th style="width:40%">Current No. of stalls</th>
                                <th>Capacity</th>

                                    <th style="width:40%">Floor No.</th>
                                    <th style="width:40%">Current No. of stalls</th>
                                    <th>Capacity</th>

                                </thead>
                                <tbody> </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <label style="float:left">All labels with "*" are required</label> -->
                <div class="pull-right">
                    <button class="btn btn-primary btn-flat" onclick="$($('#tabcontroll li.active').find('a').attr('href')).find('form').submit();"><span class='fa fa-save'></span>&nbsp Save</button>
                </div>
            </div>
        </div>
    </div>
</div> @stop @section('script')
<script type="text/javascript" src="{{ URL::asset('js/floor_js.js') }}"></script>
<script type="text/javascript">
    var obj;
    $(document).ready(function () {
        /*jQuery.validator.addMethod("capacity", function (value, element) {
            if (parseInt($(element).val()) > parseInt($(element).parent().next().find('input[type=text]').val())) return false;
            else return true;
        }, "Number of stall can't be more than the capacity");*/
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
                        type: "POST"
                        , url: '/checkBldgCode'
                        , data: {
                            bldgName: function () {
                                return $("#bldgCode").val();
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
                , "noOfStall[]": {
                    number: true
                    //, capacity: true
                }
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
            , highlight: function(element, errorClass, validClass) {
                $(element).css('color','red');
                $(element).removeClass(validClass).addClass(errorClass);
                $('#new .print-error-msg').css('display','block');
                if($('#new .print-error-msg ul').html() == '')
                    $('#new .print-error-msg').css('display','none');
              }
            , unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass(errorClass).addClass(validClass);
              }
            , errorElement: "li"
            , errorPlacement: function (error) {
                error.appendTo('#new .print-error-msg ul');
            }
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
                            , id: function () {
                                return $("#idUp").val();
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
                            , id: function () {
                                return $("#idUp").val();
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
                    "data": "floor"
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
                    "searchable": false
                    , "sortable": false
                    , "targets": 4
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
                    if (data) {
                        toastr.success('Updated Building Information');
                        $('#prodtbl').DataTable().ajax.reload();
                        $('#update').modal('hide');
                    }
                }
            });
        });
        $(".modal").on('hidden.bs.modal', function () {
            $(this).find('form').validate().resetForm();
            $(this).find('form')[0].reset();
            $('.removable').not('.first').remove();
            $('#removefloor').attr('disabled', false);
        })

        $('#bldgName').on('change', function () {
            if ($('#bldgName').val().length > 4) $.ajax({
                type: "POST"
                , url: '/getCode'
                , data: {
                    "_token": "{{ csrf_token() }}"
                    , "name": $("#newform").find("input[name=bldgName]").val().replace(/\s/g, '').toUpperCase()
                }
                , success: function (data) {
                    $('#bldgCode').val(data);
                }
            });
        });
        
        $('#removefloor').on('input', function () {
            if ($(this).val() > 0) {
                $('#noOfFloorUp').val(0);
                $('#noOfFloorUp').attr('disabled', true);
                $('#floortblup').find('.removable').each(function(){
                    $(this).fadeOut(function() { $(this).remove(); });
                });
            }
            else $('#noOfFloorUp').attr('disabled', false);
        });
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
                $("#curfloor").val(obj.noOfFloor);
                $('#update').modal('show');
            }
        });
        $.ajax({
            type: "POST"
            , url: '/getFloorsUp'
            , data: {
                "_token": "{{ csrf_token() }}"
                , "id": id
            }
            , success: function (data) {
                obj = JSON.parse(data);
                for (i = 0; i < obj.length; i++) {
                    $('#floorUpTbl tbody').append("<tr class='removable'><td>" + (i + 1) + "</td><td>" + obj[i].stall.length + "</td><td>" + obj[i].floorCapacity + "</td></tr>");
                }
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

    function showTable(tbl) {
        $('.fadeout').remove();
        var input = $(tbl).parent().find('input[type=text]').first();
        input.parent().find('button[data-type=minus]').prop('disabled', false);
        input.parent().find('button[data-type=plus]').prop('disabled', false);
        if (parseInt(input.val()) > input.attr('max')) {
            input.val(input.attr('max'));
        }
        else if (parseInt(input.val()) < input.attr('min')) {
            input.val(input.attr('min'));
        }
        if (parseInt(input.val()) == input.attr('min')) {
            input.parent().find('button[data-type=minus]').prop('disabled', true);
        }
        else if (parseInt(input.val()) == input.attr('max')) {
            input.parent().find('button[data-type=plus]').prop('disabled', true);
        }
        else {
            input.parent().find('button[data-type=minus]').prop('disabled', false);
            input.parent().find('button[data-type=plus]').prop('disabled', false);
        }

        var count = $(tbl).parent().find('.removable').length;
        var val = parseInt(input.val());
        var times = 0;
        var add = false;
        if (val > count) {
            times = val - count;
            add = true;
        }
        else {
            times = count - val;
        }
        if (add) {
            for (var i = count+1; i <= val; i++) {
                /*var stall = '';
                var cap = '';
                if (noOfStalls[i] != undefined) stall = noOfStalls[i];
                if (capacity[i] != undefined) cap = capacity[i];*/
                
                $(tbl + ' tbody').append('<tr class="removable" style="display:none"><td>' + i + '</td><td><input type="text" name="noOfStall[]"></td></tr>')
                
                $('.removable').fadeIn();
            }
        }
        else{
            for(i = 0;i < times;i++){
                $(tbl+' .removable').not('.fadeout').last().addClass('fadeout');
                //$('.removable').last('.fadeout').fadeOut('');
                //$('.removable').last().remove();
            }
            
            if(parseInt(input.val()) == 0){
                //$('floortblup .removable').not('.fadeout').addClass('fadeout');
                $('#floortblup .removable').fadeOut(function() { $(this).remove(); });
            }
            
            console.log(input.val());
        }
        
        $('.fadeout').fadeOut(function() { $(this).remove(); });
    }

    function addNoOfStall(e) {
        var elem = $(e);
        $('input[name="noOfStall[]"').each(function () {
            if (!$(this).is(elem) && $(this).val().length == 0) {
                $(this).val(elem.val());
            }
        });
    }

    /*function addCapacity(e) {
        var elem = $(e);
        $('input[name="capacity[]"').each(function () {
            if (!$(this).is(elem) && $(this).val().length == 0) {
                $(this).val(elem.val());
            }
        });
    }*/

    function resetNoOfStall() {
        $('input[name="noOfStall[]"').val('');
    }

    /*function resetCapacity() {
        $('input[name="capacity[]"').val('');
    }*/
</script> @stop