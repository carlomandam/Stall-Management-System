@extends('layout.app')

@section('title')
    {{ 'Building'}}
@stop
@section('content-header')

        <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> Maintenance</li>
            <li class="active">Building</li>
        </ol>
        @stop

        @section('content')

    <style>
      #floortbl td{
             padding-bottom:5px;
       }
      #floortbl th, #floortbl td{
        text-align: center;
      }




</style>
   
<div class = "box box-primary">
        <div class = "box-body">

            <div class="table-responsive">
             <div  class = "defaultNewButton">
                <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#new"><span class='fa fa-plus'></span>&nbspNew Building</button>
                    <div class = " pull-right" id = "archive">
                         <button class="btn btn-default btn-flat" onclick=""><span class='fa fa-archive'></span>&nbspArchive</button>
                    </div>
              </div>
                <table id="prodtbl" class="table table-bordered table-striped" role="grid" >
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
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="noOfFloor">No. of Floors</label><span class="required">&nbsp*</span>
                                        <input type="text" class="form-control" id="noOfFloor" name="noOfFloor" placeholder="No. of Floors" oninput="showTable('#floortbl')" /> </div>
                                        <table id='floortbl' style="display:none">
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
                             <p class="small text-danger">Fields with asterisks(*) are required</p>
                        </div>
                        <div class="modal-footer">
                            <!-- <label style="float:left">All labels with "*" are required</label> -->
                                <div class = "pull-right">

                                     <button class="btn btn-primary btn-flat"><span class='fa fa-save'></span>&nbspSave</button>

                                </div>
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
                            <h4 class="modal-title">Update Building</h4> </div>
                        <div class="modal-body">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="noOfFloorUp">No. of Floors</label><span class="required">&nbsp*</span>
                                        <input type="text" class="form-control" id="noOfFloorUp" name="noOfFloor" placeholder="No. of Floors" readonly/> </div>
                                </div>
                             
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="bldgDescUp">Description</label>
                                        <textarea class="form-control" id="bldgDescUp" name="bldgDesc" placeholder="Building Description"></textarea>
                                    </div>
                                </div>
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="noOfFloorUp">Add/Remove Floors</label><br>
                                        <input type="radio" value="1" name="addRemoveRadio"><label>Add</label>&emsp;
                                        <input type="radio" value="2" name="addRemoveRadio"><label>Remove</label>
                                        <input type="text" class="form-control" name="addRemove" id="addRemove" placeholder="No. of Floors" disabled/> 
                                        <table id='floortblup' style="display:none">
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
                            </div>
                             <p class="small text-danger">Fields with asterisks(*) are required</p>
                        </div>
                        <div class="modal-footer">
                            <!-- <label style="float:left">All labels with "*" are required</label> -->
                             <div class = "pull-right">

                                     <button class="btn btn-primary btn-flat"><span class='fa fa-save'></span>&nbspSave</button>

                                </div>
                        </div>
                    </div>
                </form>
            </div>
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
                    if(data){
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
            $('.removable').remove();
            $('#floortblup').css('display','none');
        })
        
        $('#addRemove').on('input',function(){
            if($("input[name='addRemoveRadio']:checked").val() == 1){
                showTable('#floortblup');
            }
        });
        
        $('input[name=addRemoveRadio]').on('mousedown',function(e){
            if($(this).is(':checked')){
                $(this).prop('checked',false);
                $(this).siblings('input[type=text]').prop('disabled',true);
                $(this).siblings('input[type=text]').val(null);
           }else {
               $(this).prop('checked',true);
               $(this).siblings('input[type=text]').prop('disabled',false);
           }
            if(this.value == 2){
                $(this).siblings('table').css('display', 'none');
                $('.removable').remove();
            }else{
                 if($(this).is(':checked') && $('input[name=addRemove]').val() > 0)
                    $('input[name=addRemove]').trigger('input');
                else{
                    $(this).siblings('table').css('display', 'none');
                    $('.removable').remove();
                }
            }
        });
        $('input[name=addRemoveRadio]').on('click',function(){return false;});
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

    function showTable(tbl) {
        $(tbl).css('display', 'inline');
        $('.removable').remove();
        $(tbl).attr('display','inline');
        for (var i = 0; i < parseInt($(tbl).parent().find('input[type=text]').val()); i++) {
            $(tbl + ' tbody').append('<tr class="removable"><td>' + (i + 1) + '</td><td><input type="text" name="noOfStall[]"></td></tr>')
        }
    }
    </script>
    @stop