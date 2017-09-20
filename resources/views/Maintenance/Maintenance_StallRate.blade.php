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
            </div>
            <table id="table" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
                <thead>
                    <tr>
                        <th>Stall Type</th>
                        <th>Size</th>
                        <th>Rate</th>
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
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul id="error-new"></ul>
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
</div> @stop @section('script')
<script type="text/javascript">
    var obj;
    var chk;
    var today = new Date(Date.now()).toLocaleString()
    $(document).ready(function () {
        $(".datepicker").datepicker({
            showOtherMonths: true
            , selectOtherMonths: true
            , changeMonth: true
            , changeYear: true
            , autoclose: true
            , startDate: "dateToday"
            , todayHighlight: true
            , orientation: 'bottom'
            , format: 'mm/dd/yyyy'
        });
        $('.js-example-basic-multiple').select2({
            width: 'resolve'
            , closeOnSelect: false
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
			]
        });
        $("#newform").validate({
            rules: {
                "stype[]": 'required'
                , rate: {
                    required: true
                    , number: true
                }
                , prate: {
                    required: true
                    , number: true
                }
                , collection: 'required'
                , effect: 'required'
            }
            , messages: {
                rate: {
                    required: "Please Enter Daily Rate"
                    , number: "Invalid Amount"
                }
                , prate: {
                    required: "Please Enter Peak Rate"
                    , number: "Invalid Amount"
                }
                , "stype[]": "Select Stall Type"
                , "effect": "Select Date of effect"
            }
            , errorClass: "error-class"
            , validClass: "valid-class"
            , highlight: function (element, errorClass, validClass) {
                $(element).removeClass(validClass).addClass(errorClass);
                $('#new .print-error-msg').css('display', 'block');
            }
            , unhighlight: function (element, errorClass, validClass) {
                var i = 0;
                $('#newform .print-error-msg ul').find('li').each(function(){
                    if($(this).css('display') != 'none')
                        i++;
                });
                if(i == 0)
                    $('#newform .print-error-msg').css('display', 'none');
                $(element).removeClass(errorClass).addClass(validClass);
            }
            , errorElement: "li"
            , errorPlacement: function (error) {
                error.appendTo('#new .print-error-msg ul');
            }
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

        $(".modal").on('hidden.bs.modal', function () {
            $(this).find('form').validate().resetForm();
            $(this).find('form')[0].reset();
            $('.js-example-basic-multiple').select2("val", "");
            $('.nav a[href="#1"]').tab('show');
        })

    });
    
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