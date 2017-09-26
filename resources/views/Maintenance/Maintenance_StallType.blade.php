@extends('layout.app')
@section('title')
    {{'Stall Type'}}
@stop
@section('content-header')

<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Maintenance</a></li>
    <li class="active">Stall Type</li>
</ol> @stop @section('content')

<div class="box box-primary">
    <div class="box-body">
        <div class="table-responsive">
            <div class="defaultNewButton">
                <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#new"><span class='fa fa-plus'></span>&nbspNew Stall Type </button>
                <div class=" pull-right" id="archive"> <a href="{{ url('/StallTypeArchive') }}" class="btn btn-primary btn-flat"><span class='fa fa-archive'></span>&nbspArchive</a> </div>
            </div>
            <table id="table" class="table table-bordered table-striped" role="grid">
                <thead>
                    <tr>
                        <th style="width: 200px;">Stall Type</th>
                        <th style="width: 120px;">Sizes</th>
                        <th style="width: 300px;">Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
            <div class="modal fade" id="new" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-md" role="document">
                    <form action="" method="post" id="newform">
                        <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">New Stall Type</h4> </div>
                            <div class="modal-body">
                                <div id="newEC" class="alert alert-danger print-error-msg" style="display:none">
                                    <ul id="error-new"></ul>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="stypeName">Stall Type Name</label><span class="required">&nbsp*</span>
                                            <input type="text" class="form-control" id="stypeName" name="stypeName" placeholder="Stall Type Name" /> </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="stypeDesc">Description</label>
                                            <textarea class="form-control" id="stypeDesc" name="stypeDesc" placeholder="Stall Type Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stypeLength">Sizes</label>
                                            <div class="form-group input-group removable">
                                                <input type="text" name="size[]" class="form-control" placeholder="Area" list='sizesoptions' required>
                                                <datalist id="sizesoptions" class="sizes">
                                                </datalist>
                                                <span class="input-group-addon">
                                                meter<sup>2</sup>
                                         </span> <span class="input-group-btn"><button type="button" class="btn btn-primary btn-add">+
                                        </button></span> </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="small text-danger">Fields with asterisks(*) are required</p>
                            </div>
                            <div class="modal-footer">
                                <!-- <label style="float:left">All labels with "*" are required</label> -->
                                <button class="btn btn-primary btn-flat"><span class='fa fa-save'></span>&nbspSave</button>
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
                                <h4 class="modal-title">Update Stall Type</h4> </div>
                            <div class="modal-body">
                                <div id="upEC" class="alert alert-danger print-error-msg" style="display:none">
                                    <ul id="error-new"></ul>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="stypeNameUp">Stall Type Name</label> <span class="required">&nbsp*</span>
                                            <input type="text" class="form-control" id="stypeNameUp" name="stypeName" placeholder="Stall Type Name" /> </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="stypeDescUp">Description</label>
                                            <textarea class="form-control" id="stypeDescUp" name="stypeDesc" placeholder="Stall Type Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group sizediv">
                                            <label for="stypeLength">Stall Type Area</label>
                                            <div class="form-group input-group removable">
                                                <input type="text" name="newSize[]" class="form-control" placeholder="Area" list='sizesoptions'> <span class="input-group-addon">
                                         meter<sup>2</sup>   
                                         </span> <span class="input-group-btn"><button type="button" class="btn btn-primary btn-add">+
                                        </button></span> </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="small text-danger">Fields with asterisks(*) are required</p>
                            </div>
                            <div class="modal-footer">
                                <!-- <label style="float:left">All labels with "*" are required</label> -->
                                <button class="btn btn-primary btn-flat" type="submit"><span class='fa fa-save'></span>&nbspSave</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> @stop @section('script')
        <script type="text/javascript" src="{{ URL::asset('js/multipleAddinArea.js') }}"></script>
        <script>
            var obj;
            var chk;
            $(document).ready(function () {
                getSizes();
                jQuery.validator.addMethod("unique", function (value, element) {
                    var unique = true;
                    if($(element).attr('name') == 'size[]')
                        $('input[name="size[]"]').each(function(){
                            if($(this).val() == $(element).val() && !$(this).is($(element)))
                                unique = false;
                        });
                    else{
                        $('.existingsize input').each(function(){
                            if($(this).val() == $(element).val() && !$(this).is($(element)))
                                unique = false;
                        });
                        $('input[name="newSize[]"').each(function(){
                            if($(this).val() == $(element).val() && !$(this).is($(element)))
                                unique = false;
                        });
                    }
                    return unique;
                }, "Sizes must be unique");
                
                $("#newform").validate({
                    rules: {
                        stypeName: {
                            required: true
                            , maxlength: 200
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
                        , "size[]": {
                            unique: true
                            , number: true
                            , required: true
                        }
                    }
                    , messages: {
                        stypeName: {
                            required: "Please enter Stall Type Name"
                            , remote: "Stall Type Name is taken"
                            , maxlength: "Stall type name cant't be more than 200 characters"
                        }
                        , "size[]": {
                            unique: "Size must be unique"
                            , number: "Invalid Size"
                            , required: "Please enter size"
                        }
                    }
                    , errorClass: "error-class"
                    , validClass: "valid-class"
                    , errorElement: "li"
                    , errorContainer: "#newEC"
                    , errorPlacement: function (error) {
                        error.appendTo('#new .print-error-msg ul');
                    }
                    , submitHandler: function(form){
                        $(form).find(":submit").attr('disabled',true);
                        var formData = new FormData(form);
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
                                $(form).find(":submit").attr('disabled',false);
                            }
                        });
                    }
                });
                $("#updateform").validate({
                    rules: {
                        stypeName: {
                            required: true
                            , maxlength: 200
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
                        , "newSize[]":{
                            unique: true
                            , number: true
                        }
                    }
                    , messages: {
                        stypeName: {
                            required: "Please enter Stall Type Name"
                            , remote: "Stall Type Name is taken"
                            , maxlength: "Stall type name cant't be more than 200 characters"
                        }
                        , "newSize[]":{
                            unique: "Sizes must be unique"
                            , number: "Invalid size"
                        }
                    }
                    , errorClass: "error-class"
                    , validClass: "valid-class"
                    , errorElement: "li"
                    , errorContainer: "#upEC"
                    , errorPlacement: function (error) {
                        error.appendTo('#update .print-error-msg ul');
                    }
                    , submitHandler: function(form){
                        $(form).find(":submit").attr('disabled',true);
                        var formData = new FormData(form);
                        $.ajax({
                            type: "POST"
                            , url: '/UpdateSType'
                            , data: formData
                            , processData: false
                            , contentType: false
                            , context: this
                            , success: function (data) {
                                $(form).find(":submit").attr('disabled',false);
                                if(data == false)
                                    return;
                                toastr.success('Updated Stall Type');
                                $('#table').DataTable().ajax.reload();
                                $('#update').modal('hide');
                            }
                        });
                    }
                });
                $('#table').DataTable({
                    ajax: '/stypeTable'
                    , responsive: true
                    , "columns": [{
                            "data": "stypeName"
                    }
                    , {
                            "data": function (data, type, dataToSet) {
                                var string = data.s_type_size[0].stypeArea + "m<sup>2</sup>";
                                for(var i = 1;i < data.s_type_size.length; i++){
                                    string += ", "+data.s_type_size[i].stypeArea + "m<sup>2</sup>";
                                }
                                return string;
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
                $(".modal").on('hidden.bs.modal', function () {
                    $(this).find('form').validate().resetForm();
                    $(this).find('form')[0].reset();
                    $(this).find('.removable').not(':last').remove();
                    getSizes();
                })
            });

            function getSizes(){
                $.ajax({
                    type: "POST"
                    , url: '/getSizes'
                    , data: {
                        _token: function () {
                            return $("#_token").val();
                        }
                    }
                    , success: function (data) {
                        obj = JSON.parse(data);
                        var opt = '';
                        for(var i = 0;i < obj.length; i++){
                            opt += "<option value="+obj[i].stypeArea+">"+obj[i].stypeArea+"</option>";
                        }
                        $('.sizes').html(opt);
                    }
                });
            }
            
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
                        var sizes = '';
                        for(var i = 0;i < obj.s_type_size.length;i++){
                            sizes += '<div class="form-group input-group removable existingsize"><input type="text" name="size[]" class="form-control" placeholder="Area" list="sizesoptions" value="'+obj.s_type_size[i].stypeArea+'" disabled> <span class="input-group-addon">meter<sup>2</sup></span> <span class="input-group-btn"><button type="button" class="btn btn-danger removesize dropdown-toggle" data-toggle="dropdown">-</button>'+ "<ul class='dropdown-menu pull-right opensleft' role='menu' data-container='body'><center><h4>Are You Sure?</h4><li class='divider'></li><li><a href='#' onclick='deleteSize("+obj.s_type_size[i].pivot.stypeID+","+obj.s_type_size[i].pivot.stypeSizeID+",this);return false;'>YES</a></li><li><a href='#' onclick='return false'>NO</a></li></center></ul>"+'</span></div>';
                        }
                        $('.sizediv .form-group').before(sizes);
                        $('#update').modal('show');
                    }
                });
            }

            function deleteSize(type,size,elem){
                if($('.existingsize').length < 2){
                    toastr.warning('Stall type must have atleast one size');
                    return;
                }
                $.ajax({
                    type: "POST"
                    , url: '/deleteStypeSize'
                    , data: {
                        "_token": "{{ csrf_token() }}"
                        , "type": type
                        , "size": size
                    }
                    , success: function (data) {
                        if(data == "success"){
                            $(elem).closest('div').remove();
                            $('#table').DataTable().ajax.reload();
                        }else if(data == "rental"){
                            toastr.warning('Unable to delete stall type size. A stall is currently rented');
                        }
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
                        if(data == ""){
                        $('#table').DataTable().ajax.reload();
                        toastr.success('Stall Type Deleted');
                        }else if(data == "rental"){
                            toastr.warning('Unable to delete stall type. A stall is currently rented');
                        }
                    }
                });
            }
        </script> @stop