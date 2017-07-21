@extends('layout.app') @section('content-header')
<h1>List of Stall Holders</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">List</li>
</ol> @stop @section('content')
<div class="box box-primary">
    <div class="box-header"> </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table id="tblmember" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Stall Holder No.</th>
<<<<<<< HEAD
                        <th>Organization Name / Full Name</th>
                        <th>Mobile Number</th>
=======
                        <th>Name</th>
                        <th>Contact</th>
>>>>>>> 4293ab81339785a1f4f24c6ea939ed4ec7caf038
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody> </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
<!-- MODAL -->
<!-- Modal -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete</h4> </div>
            <div class="modal-body">
                <h2>Are you sure?</h2> </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success">Yes</button>
            </div>
        </div>
    </div>
</div>
<!--modal view-->
<div class="modal fade" tabindex="-1" id="update" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" id="updateform">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Update Stall Holder Details</h4> </div>
                <div class="modal-body">
                    <div class="col-md-12 form-group row">
                        <div class="col-md-6">
                            <label><b>Stall Holder No:</b></label>
                            <input type="text" class="form-control" id="vendor_no" name="vendor_no" value="" disabled="" /> </div>
                    </div>
                    <div class="col-md-12 form-group row">
                        <div class="col-md-12">
                            <label for="org">Name of Group/Organization<i><b>&nbsp&nbsp(If Applicable)</i></b>
                            </label>
                            <input type="text" class="form-control" id="orgname" name="orgname" /> </div>
                    </div>
                    <div class="col-md-12 form-group row">
                        <div class="col-md-4">
                            <label for="firstName"><b>*First Name:</b></label>
                            <input type="text" class="form-control" id="fname" name="fname" required> </div>
                        <div class="col-md-4">
                            <label for="middleName"><b>Middle Name:</b></label>
                            <input type="text" class="form-control" id="mname" name="mname"> </div>
                        <div class="col-md-4">
                            <label for="lastname"><b>*Last Name:</b></label>
                            <input type="text" class="form-control" id="lname" name="lname" required> </div>
                    </div>
                    <div class=" col-md-12 form-group row">
                        <div class="col-md-6">
                            <label for="sex"><b>*Sex:</b></label>
                            <div class="radio" style="margin-left: 30px;">
                                <label>
                                    <input type="radio" name="sex" value="1"><b>Male</b></label>
                                <label>
                                    <input type="radio" name="sex" value="0"><b>Female</b></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="bday"><b>*Birthday:</b></label>
                            <div class="form-inline">
                                <select name="DOBMonth" id="DOBMonth">
                                    <option> - Month - </option>
                                    <option value="01">January</option>
                                    <option value="02">Febuary</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                                <select name="DOBDay" id="DOBDay">
                                    <option> - Day - </option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                                <select name="DOBYear" id="DOBYear">
                                    <option> - Year - </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-group row">
                        <div class="col-md-6">
                            <label for="email">*Email Address:</label>
                            <input type="email" class="form-control" id="email" name="email" /> </div>
                        <div class="col-md-6">
                            <label for="phone"><b>* Mobile:</b></label>
                            <input type="text" class="form-control" id="mob" name="mob" required> </div>
                    </div>
                    <div class="col-md-12 form-group row">
                        <div class="col-md-12">
                            <label for="address"><b>*Home Address:</b></label>
                            <textarea rows="4" class="form-control" id="address" name="address"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info pull-right" style="background-color:#191966" id="btn-submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--end of modal view-->@stop @section('script')
<script>
    var obj;
    $(document).ready(function () {
        //POPULATE YEAR DROPDOWN FOR BIRTHDAY///
        var select = $('#DOBYear');
        var leastYr = 1960;
        var nowYr = 2017;
        for (var v = nowYr; v >= leastYr; v--) {
            $('#DOBYear').append('<option value ="' + v + '">' + v + '</option');
        }
    });
    $('#DOBMonth').change(function () {
        if ($(this).val() == 4 || $(this).val() == 6 || $(this).val() == 9 || $(this).val() == 11) {
            $('#DOBDay option[value =31]').remove();
            if ($("#DOBDay option[value='30']").length == 0) {
                $('#DOBDay').append('<option value="' + 30 + '">' + 30 + '</option>');
            }
        }
        else if ($(this).val() == 2) {
            $('#DOBDay option[value =30]').remove();
            $('#DOBDay option[value =31]').remove();
        }
        else {
            if ($("#DOBDay option[value='30']").length == 0) {
                $('#DOBDay').append('<option value="' + 30 + '">' + 30 + '</option>');
                $('#DOBDay').append('<option value="' + 31 + '">' + 31 + '</option>');
            }
            else if ($("#DOBDay option[value = '31']").length == 0) {
                $('#DOBDay').append('<option value="' + 31 + '">' + 31 + '</option>');
            }
        }
    });

    function getInfo(id) {
        $.ajax({
            type: "POST"
            , url: '/getVendorInfo'
            , data: {
                "_token": "{{ csrf_token() }}"
                , "id": id
            }
            , success: function (data) {
                obj = JSON.parse(data)[0];
                $('modal').appendTo("body");
                $(".modal").on('shown.bs.modal', function () {
                    $leftval = "SH-" + 2017;
                    $stallholderno = $leftval + String("00000" + obj.venID).slice(-5);
                    $('#vendor_no').val($stallholderno);
                    $('#update').find('input[name=id]').val(id);
                    $('#update').find('input[name=orgname]').val(obj.venOrgName);
                    $('#update').find('input[name=fname]').val(obj.venFName);
                    $('#update').find('input[name=mname]').val(obj.venMName);
                    $('#update').find('input[name=lname]').val(obj.venLName);
                    if (obj.venSex == 1) {
                        $('#update').find('input[name=sex][value = 1]').attr('checked', true);
                    }
                    else {
                        $('#update').find('input[name=sex][value = 0]').attr('checked', true);
                    }
                    $('#update').find('input[name = email]').val(obj.venEmail);
                    $('#update').find('input[name = mob]').val(obj.venContact);
                    var bday = obj.venBDay;
                    $splitDate = bday.split("-");
                    $('#DOBYear').val($splitDate[0]).attr('selected', true).siblings('option').removeAttr('selected');
                    //  $('#DOBYear').selectmenu('refresh',true);
                    $('#DOBMonth').val($splitDate[1]).attr('selected', true).siblings('option').removeAttr('selected');
                    $('#DOBDay').val($splitDate[2]).attr('selected', true).siblings('option').removeAttr('selected');
                    $('#address').val(obj.venAddress);
                });
            }
        });
    }
    // $('#updateform').modal('hide');
    //VALIDATE UPDATE DETAILS//
    $('#updateform').validate({
        rules: {
            fname: {
                required: true
            }
            , lname: {
                required: true
            }
            , sex: {
                required: true
            }
            , address: {
                required: true
            }
            , mob: {
                required: true
                , number: true
            }
            , email: {
                required: true
                , email: true
            }
        }
        , messages: {
            fname: {
                required: "First Name is required"
            }
            , lname: {
                required: "Last Name is required"
            }
            , address: {
                required: "Home Address is required"
            }
            , mob: {
                required: "Mobile No. is required"
                , number: "Numbers only"
            }
            , email: {
                required: "Email Address is required"
                , remote: "Email is already taken"
            }
        }
        , errorClass: "error-class"
        , validClass: "valid-class"
    });
    $("#updateform").unbind('submit').bind('submit', function (e) {
        e.preventDefault();
        if (!$("#updateform").valid()) return;
        var formData = new FormData($(this)[0]);
        $.ajax({
            type: "POST"
            , url: '/UpdateVendor'
            , data: formData
            , processData: false
            , contentType: false
            , context: this
            , success: function (data) {
                toastr.success('Successfully Updated!');
                $('#tblmember').DataTable().ajax.reload();
                $('#update').modal('hide');
            }
        });
    });
    $(".modal").on('hidden.bs.modal', function () {
            $(this).find('form').validate().resetForm();
            $(this).find('form')[0].reset();
        })
        //POPULATE DATATABLE//
    $('#tblmember').DataTable({
        ajax: '/getVendor'
        , responsive: true
        , "columns": [
            {
                "data": function (data, type, dataToSet) {
                    $leftval = "SH-" + 2017;
                    $stallholderno = $leftval + String("00000" + data.venID).slice(-5);
                    return ($stallholderno);
                }
                    }
                    
            , {
                "data": function (data, type, dataToSet) {
<<<<<<< HEAD
                    if(data.venOrgName != null)
                    {
                        return (data.venOrgName+" / "+data.venFName + " " +data.venMName+ " "+data.venLName);
                    }
                    else{
                    return (data.venFName + " " +data.venMName+ " "+data.venLName);}
=======
                    return (data.venFName + " " + data.venLName);
>>>>>>> 4293ab81339785a1f4f24c6ea939ed4ec7caf038
                }
                    }
            , {
                "data": "venContact"
                    }
            , {
                "data": "venEmail"
                    },

            {
                "data": "actions"
                    }
            ]
        , "columnDefs": [
            {
                "width": "30%"
                , "searchable": false
                , "sortable": false
                , "targets": 4
                    }
  ]
    });
</script> @stop