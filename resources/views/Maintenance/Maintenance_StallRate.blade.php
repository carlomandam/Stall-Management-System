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
                <!--<div class=" pull-right" id="archive"> <a href="{{ url('/StallRateArchive') }}" class="btn btn-primary btn-flat"><span class='fa fa-archive'></span>&nbspArchive</a> </div>-->
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
                        <div class="col-md-12 errordiv"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="stype">Stall Type</label><span class="required">&nbsp*</span>
                                <br>
                                <select class="js-example-basic-multiple stypeSelect form-control" multiple='multiple' name="stype[]" style="width:100%"> </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Regular Rate</h4>
                            <div class="form-group ratediv">
                                <div class="input-group"> <span class="input-group-addon">Php.</span>
                                    <input type="text" class="form-control" name="rate"> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>Peak Day Additional Rate</h4>
                            <div class="form-group ratediv">
                                <div class="input-group"> <span class="input-group-addon">Php.</span>
                                    <input type="text" class="form-control" name="prate"> 
                                </div>
                            </div>
                            <h5>Type</h5>
                            <input type="radio" name='prtype' value="1"><label>Fixed</label>&nbsp;<input type="radio" name='prtype' value="2"><label>Percent</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="stype">Date of Effect</label><span class="required">&nbsp*</span>
                            <div class="input-group date datepicker">
                                <input type="text" class="form-control" name="effect">
                                <div class="input-group-addon"> <span class="glyphicon glyphicon-th"></span></div>
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
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Stall Rate</h4> </div>
            <div class="modal-body">
                <div id="tabcontroll" class="container" style="width:100%">
                    <ul class="nav nav-pills">
                        <li class="active"> <a href="#1" data-toggle="tab">Current Stall Rate</a> </li>
                        <li><a href="#2" data-toggle="tab" onclick="getPrevRates()">Previous/Future Stall Rates</a> </li>
                        <li style="display:none"><a href="#3" data-toggle="tab"></a></li>
                        <li style="display:none"><a href="#4" data-toggle="tab"></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="1">
                            <form action="" method="post" id="updateform">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <input type="hidden" name="id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stype">Stall Type:
                                                <h4 id="typename"></h4></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stype">Stall Size:
                                                <h4 id="typesize"></h4> </label>
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
                                            <div class="input-group-addon"> <span class="glyphicon glyphicon-th"></span> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Rate</h4>
                                        <div class="form-group ratediv">
                                            <div class="input-group"> <span class="input-group-addon">Php.</span>
                                                <input type="text" class="form-control" name="rate[]"> </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="small text-danger">Fields with asterisks(*) are required</p>
                            </form>
                        </div>
                        <div class="tab-pane" id="2">
                            <br>
                            <div class="row">
                            <center>
                                <h4>Previous Rates</h4></center>
                            </div>
                            <div class="row">
                                <br>
                                <table class="table table-bordered table-striped" role="grid" id='prevRatesTbl' style="width:100% !important">
                                    <thead>
                                        <tr>
                                        <th style="width:40%;text-align:center">Date of Effect</th>
                                        <th style="width:40%;text-align:center">Collection Type</th>
                                        <th style="width:20%;text-align:center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody> </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <center>
                                    <h4>Future Rate</h4></center>
                            </div>
                            <div class="row">
                                <br>
                                <button class="btn btn-primary btn-flat" onclick="$('.nav a[href=&quot;#4&quot;]').tab('show').trigger('click'); $('#upform input[name=id').val('new')" style="margin-bottom:5px;"><span class='fa fa-plus'></span>&nbsp New Stall Rate </button>
                                <table class="table table-bordered table-striped" role="grid" id='upRatesTbl' style="width:100% !important">
                                    <thead>
                                        <tr>
                                        <th style="width:40%;text-align:center">Date of Effect</th>
                                        <th style="width:40%;text-align:center">Collection Type</th>
                                        <th style="width:20%;text-align:center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody> </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="3">
                            <button class="btn btn-primary btn-flat" onclick="$('.nav a[href=&quot;#2&quot;]').tab('show').trigger('click');">Back</button>
                            <form action="" method="post" id="prevform">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <input type="hidden" name="id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stype">Stall Type:
                                                <h4 id="prevtypename"></h4></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stype">Stall Size:
                                                <h4 id="prevtypesize"></h4> </label>
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
                                        <label for="stype">Date of Effectivity</label><span class="required">&nbsp*</span>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="effect">
                                            <div class="input-group-addon"> <span class="glyphicon glyphicon-th"></span> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Rate</h4>
                                        <div class="form-group ratediv">
                                            <div class="input-group"> <span class="input-group-addon">Php.</span>
                                                <input type="text" class="form-control" name="rate[]"> </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="small text-danger">Fields with asterisks(*) are required</p>
                            </form>
                        </div>
                        <div class="tab-pane" id="4">
                            <button class="btn btn-primary btn-flat" onclick="$('.nav a[href=&quot;#2&quot;]').tab('show').trigger('click'); $('#upform')[0].reset(); $(&quot;#upform .datepicker&quot;).datepicker(&quot;update&quot;,getToday());">Back</button>
                            <form action="" method="post" id="upform">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <input type="hidden" name="id">
                                <input type="hidden" name="stype[]">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stype">Stall Type:
                                                <h4 id="uptypename"></h4></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stype">Stall Size:
                                                <h4 id="uptypesize"></h4> </label>
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
                                            <div class="input-group-addon"> <span class="glyphicon glyphicon-th"></span> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Rate</h4>
                                        <div class="form-group ratediv">
                                            <div class="input-group"> <span class="input-group-addon">Php.</span>
                                                <input type="text" class="form-control" name="rate[]"> </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="small text-danger">Fields with asterisks(*) are required</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <label style="float:left">All labels with "*" are required</label> -->
                <button class="btn btn-primary btn-flat" onclick="$(this.value).submit();" id="submit"><span class='fa fa-save'></span>&nbspSave</button>
            </div>
        </div>
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
        $('.js-example-basic-multiple').select2({
            width: 'resolve'
        });
        getStallTypes();
        $('#table').DataTable({
            ajax: '/rateTable'
            , responsive: true
            , "columns": [
                {
                    "data": "type_size.stall_type.stypeName"
                }
                    , {
                    "data": function (data, type, dataToSet) {
                        return data.type_size.stall_type_size.stypeArea + "m<sup>2</sup>";
                    }
                }
                , {
                    "data": function (data, type, dataToSet) {
                        if(data.peakRateType == '1')
                            return '₱' + data.dblRate + ' ( Additional  ₱' + data.dblPeakRate + ' on peak days)';
                        else{
                            if(data.peakRateType == '2')
                            return '₱' + data.dblRate + ' ( Additional ' + data.dblPeakRate + '% (₱'+ Math.floor((data.dblRate * data.dblPeakRate) / 100) +') on peak days)';
                        }
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
        $("#newform").validate({
            rules: {
                "stype[]": 'required'
                , "rate[]": {
                    required: true
                    , number: true
                }
                , collection: 'required'
                , effect: 'required'
            }
            , messages: {
                "rate[]": {
                    required: "*Please Enter Amount"
                    , number: "*Invalid Amount"
                }
                , "stype[]": "*Select Stall Type"
                , "effect": "*Select Date of effect"
            }
            , errorClass: "error-class"
            , validClass: "valid-class"
            , errorElement: "div"
            , errorPlacement: function (error) {
                error.appendTo('.errordiv');
            }
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
                    toastr.success('Added New Stall Rate');
                    $('#table').DataTable().ajax.reload();
                    $('#new').modal('hide');
                    getStallTypes();
                }
            });
        });
        
        $("#upform").submit(function (e) {
            e.preventDefault();
            if (!$("#upform").valid()) return;
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST"
                , url: '/updateStallRate'
                , data: formData
                , processData: false
                , contentType: false
                , context: this
                , success: function (data) {
                    if (data == 'exist') {
                        toastr.warning('Stall Rate is already set');
                        return;
                    }
                    toastr.success('Updated Stall Rate');
                    $('#table').DataTable().ajax.reload();
                    $('.nav a[href=&quot;#2&quot;]').tab('show').trigger('click');
                    getStallTypes();
                }
            });
        });

        $(".modal").on('hidden.bs.modal', function () {
            $(this).find('form').validate().resetForm();
            $(this).find('form').reset();
            $('.js-example-basic-multiple').select2("val", "");
            $('.nav a[href="#1"]').tab('show');
        })
        
        $('#prevRatesTbl').DataTable({
            ajax: {
                url: '/prevRatesTable'
                , type: 'POST'
                , data: function(d){
                    d._token = "{{ csrf_token() }}";
                    d.id = $("#updateform input[name=id]").val();
                }
            }
            , responsive: true
            , "columns": [
                {
                    "data": "stallRateEffectivity"
                }
                    , {
                    "data": function (data, type, dataToSet) {
                        var collection = ''
                        switch(data.frequencyID){
                            case 1 : 
                                collection = 'Monthly';
                                break;
                            case 2 : 
                                collection = 'Weekly';
                                break;
                            case 3 : 
                                collection = 'Daily';
                                break;
                            case 4 : 
                                collection = 'Daily (Different rates per day)';
                                break;
                        }
                        return collection;
                    }
                }
                , {
                    "data": "actions"
                }
			]
            , "columnDefs": [
                {
                    "searchable": false
                    , "sortable": false
                    , "targets": 2
                    }
  ]
        });
        
        $('#upRatesTbl').DataTable({
            ajax: {
                url: '/upRatesTable'
                , type: 'POST'
                , data: function(d){
                    d._token = "{{ csrf_token() }}";
                    d.id = $("#updateform input[name=id]").val();
                }
            }
            , responsive: true
            , "columns": [
                {
                    "data": "stallRateEffectivity"
                }
                    , {
                    "data": function (data, type, dataToSet) {
                        var collection = ''
                        switch(data.frequencyID){
                            case 1 : 
                                collection = 'Monthly';
                                break;
                            case 2 : 
                                collection = 'Weekly';
                                break;
                            case 3 : 
                                collection = 'Daily';
                                break;
                            case 4 : 
                                collection = 'Daily (Different rates per day)';
                                break;
                        }
                        return collection;
                    }
                }
                , {
                    "data": "actions"
                }
			]
            , "columnDefs": [
                {
                    "searchable": false
                    , "sortable": false
                    , "targets": 2
                    }
  ]
        });
        
        $('.nav a[href="#4"]').on('click',function(){
            $('#submit').val('#upform');
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
                obj = JSON.parse(data);
                $("#updateform").find('input[name=id]').val(obj.stallRateID);
                $("#upform").find('input[name=stype\\[\\]]').val(obj.stype_SizeID);
                $('#typename, #uptypename').html(obj.type_size.stall_type.stypeName);
                $('#typesize, #uptypesize').html(obj.type_size.stall_type_size.stypeArea + 'm&sup2');
                $("#updateform").find('select').val(obj.frequencyDesc).trigger('change');
                var parts = obj.stallRateEffectivity.split('-');
                var ds = parts[1]+'-'+parts[2]+'-'+parts[0];
                alert(ds);
                $("#updateform .datepicker").datepicker("update",ds);
                var i = 0;
                $("#updateform input[name='rate\\[\\]']").each(function () {
                    $(this).val(obj.rate_detail[i].dblRate);
                    i++;
                });
                
                getForbidden(obj.stype_SizeID);
                $('#update').modal('show');
            }
        });
    }
    
    function getToday(){
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!

        var yyyy = today.getFullYear();
        if(dd<10){
            dd='0'+dd;
        } 
        if(mm<10){
            mm='0'+mm;
        }
        
        return dd+'/'+mm+'/'+yyyy;
    }
    
    function getForbidden(id){
        $.ajax({
            type: "POST"
            , url: '/getForbidden'
            , data: {
                "_token": "{{ csrf_token() }}"
                , "id": id
            }
            , success: function (data) {
                var forbidden = data;
                $('#upform .datepicker').datepicker('setDatesDisabled',data);
            }
        });
    }
    
    function getPrevInfo(id) {
        $.ajax({
            type: "POST"
            , url: '/getPrevRateInfo'
            , data: {
                "_token": "{{ csrf_token() }}"
                , "id": id
            }
            , success: function (data) {
                obj = JSON.parse(data)[0];
                $("#prevform").find('input[name=id]').val(obj.stallRateID);
                $('#prevtypename').html(obj.type_size.stall_type.stypeName);
                $('#prevtypesize').html(obj.type_size.stall_type_size.stypeArea + 'm&sup2');
                $("#prevform").find('select').val(obj.frequencyID).trigger('change');
                $("#prevform input[name=effect]").val(obj.stallRateEffectivity);
                var i = 0;
                $("#prevform input[name='rate\\[\\]']").each(function () {
                    $(this).val(obj.rate_detail[i].dblRate);
                    i++;
                });
                $("#prevform input").attr('readonly',true);
                $("#prevform select").attr('disabled',true);
                $('.nav a[href="#3"]').tab('show');
            }
        });
    }
    
    function getUpInfo(id) {
        $.ajax({
            type: "POST"
            , url: '/getUpRateInfo'
            , data: {
                "_token": "{{ csrf_token() }}"
                , "id": id
            }
            , success: function (data) {
                obj = JSON.parse(data)[0];
                $("#upform").find('input[name=id]').val(obj.stallRateID);
                $('#uptypename').html(obj.type_size.stall_type.stypeName);
                $('#uptypesize').html(obj.type_size.stall_type_size.stypeArea + 'm&sup2');
                $("#upform").find('select').val(obj.frequencyID).trigger('change');
                var parts = obj.stallRateEffectivity.split('-');
                $("#upform .datepicker").datepicker("update",parts[1]+'/'+parts[2]+'/'+parts[0]);
                var i = 0;
                $("#upform input[name='rate\\[\\]']").each(function () {
                    $(this).val(obj.rate_detail[i].dblRate);
                    i++;
                });
                $('.nav a[href="#4"]').tab('show').trigger('click');
            }
        });
    }

    function getStallTypes() {
        $.ajax({
            type: "POST"
            , url: '/stypeRate'
            , data: {
                "_token": "{{ csrf_token() }}"
            }
            , success: function (data) {
                stype = JSON.parse(data);
                var opt = "";
                for (var i = 0; i < stype.length; i++) {
                    opt += "<optgroup label='" + stype[i].stypeName + "'>";
                    for (var j = 0; j < stype[i].typesize.length; j++) {
                        if (stype[i].typesize[j].stall_rate == null)
                            opt += '<option value="' + stype[i].typesize[j].stype_SizeID + '">' + stype[i].stypeName + "(" + stype[i].typesize[j].stall_type_size.stypeArea + 'm&sup2; )</option>';
                    }
                    opt += "</optgroup>";
                }
                $(".stypeSelect").each(function () {
                    $(this).html(opt);
                });
                $("optgroup").each(function () {
                    if($(this).html() == '')
                        $(this).remove();
                });
            }
        });
    }

    function getPrevRates() {
        //$('#prevRatesTbl').DataTable().destroy();
        $('#prevRatesTbl').DataTable().ajax.reload();
        $('#upRatesTbl').DataTable().ajax.reload();
    }
</script>
<style>
    .input-group-addon {
        background-color: gray !important;
        color: white;
    }
    
    .errordiv {
        color: #D8000C;
        background-color: #FFBABA;
    }
</style> @stop