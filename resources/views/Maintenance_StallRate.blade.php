@extends('layout.app') @section('title') {{'Stall Rate'}} @stop @section('content-header')
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Maintenance</a></li>
    <li class="active">Stall Rate</li>
</ol> @stop @section('content')
<div class="box box-primary">
    <div class="box-body">
        <div class="table-responsive">
            <div class="defaultNewButton">
                <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#new"><span class='fa fa-plus'></span>&nbsp New Stall Rate </button>
                <div class=" pull-right" id="archive"> <a href="{{ url('/StallRateArchive') }}" class="btn btn-primary btn-flat"><span class='fa fa-archive'></span>&nbspArchive</a> </div>
            </div>
            <table id="table" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
                <thead>
                    <tr>
                        <th>Stall Type</th>
                        <th>Size</th>
                        <th>Rate</th>
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
                    <h4 class="modal-title">Add Stall Rate</h4> </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="stype">Stall Type</label><span class="required">&nbsp*</span><br>
                                <select class="js-example-basic-multiple stypeSelect form-control" multiple='multiple' name="stype[]" style="width:100%"> </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stype">Collection Type</label><span class="required">&nbsp*</span>
                                <select class="form-control collection" name="collection">
                                    <option value="1">Monthly</option>
                                    <option value="2">Weekly</option>
                                    <option value="3">Daily</option>
                                    <option value="4">Daily (Different rates per day)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="stype">Date of Effect</label><span class="required">&nbsp*</span>
                            <div class="input-group date datepicker">
                                <input type="text" class="form-control" name="effect">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Rate</h4>
                            <div class="form-group ratediv">
                                <div class="input-group">
                                    <span class="input-group-addon">Php.</span>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                       <p class="small text-danger">Fields with asterisks(*) are required</p>
                </div>
                <div class="modal-footer">
                     <button class="btn btn-primary btn-flat"><span class='fa fa-save'></span>&nbspSave</button>
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="stype">Stall Type: </label>
                                <h3 class="typename"></h3> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Sizes</label>
                        </div>
                    </div>
                    <div class="row sizerow"> </div>
                    <p class="small text-danger">Fields with asterisks(*) are required</p>
                </div>
                <div class="modal-footer">
                    <!-- <label style="float:left">All labels with "*" are required</label> -->
                    <button class="btn btn-primary btn-flat"><span class='fa fa-save'></span>&nbspSave</button>
                </div>
            </div>
        </form>
    </div>
</div> @stop @section('script')
<script type="text/javascript">
    var obj;
    var chk;
    var today = new Date(Date.now()).toLocaleString();
    $('.datepicker').datepicker({
       startDate: today
        , todayHighlight: true
     });
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2({width: 'resolve'});
        getStallTypes();
        getBuildings();
        $('#table').DataTable({
            ajax: '/stypeTable'
            , responsive: true
            , "columns": [
                {
                    "data": "stypeName"
                }
                    , {
                    "data": function (data, type, dataToSet) {
                        var string = data.s_type_size[0].stypeArea + "m<sup>2</sup>";
                        for (var i = 1; i < data.s_type_size.length; i++) {
                            string += ", " + data.s_type_size[i].stypeArea + "m<sup>2</sup>";
                        }
                        return string;
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
                    , "targets": 2
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
        
        $('.collection').on('change',function(){
            if($(this).val() == 4){
                $(this).parents('.row').next().find('.ratediv').html(
                "<div class='form-group'><label>Sunday</label><div class='input-group'><span class='input-group-addon'>Php.</span><input type='text' class='form-control' name='rate[]'></div>"
                + "<label>Monday</label><div class='input-group'><span class='input-group-addon'>Php.</span><input type='text' class='form-control' name='rate[]'></div>"
                + "<label>Tuesday</label><div class='input-group'><span class='input-group-addon'>Php.</span><input type='text' class='form-control' name='rate[]'></div>"
                + "<label>Wednesday</label><div class='input-group'><span class='input-group-addon'>Php.</span><input type='text' class='form-control' name='rate[]'></div>"
                + "<label>Thursday</label><div class='input-group'><span class='input-group-addon'>Php.</span><input type='text' class='form-control' name='rate[]'></div>"
                + "<label>Friday</label><div class='input-group'><span class='input-group-addon'>Php.</span><input type='text' class='form-control' name='rate[]'></div>"
                + "<label>Saturday</label><div class='input-group'><span class='input-group-addon'>Php.</span><input type='text' class='form-control' name='rate[]'></div></div>"
                );
            }else{
                $(this).parents('.row').next().find('.ratediv').html(
                "<div class='form-group'><div class='input-group'><span class='input-group-addon'>Php.</span><input type='text' class='form-control' name='rate[]'></div>");
            }
        });
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
                    opt += "<optgroup label='" + stype[i].stypeName + "'>";
                    for (var j = 0; j < stype[i].s_type_size.length; j++) {
                        opt += '<option value="' + stype[i].s_type_size[j].pivot.stype_SizeID + '">' + stype[i].stypeName + "(" + stype[i].s_type_size[j].stypeArea + 'm&sup2; )</option>';
                    }
                    opt += "</optgroup>";
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
</script>
<style>
    .input-group-addon{
        background-color: gray !important;
        color: white;
    }
</style>
@stop