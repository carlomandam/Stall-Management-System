@extends('layout.app') 
@section('title') 
{{ 'Equipments'}} 
@stop 
@section('content-header')
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Maintenance</li>
    <li class="active">Equipments</li>
</ol> 
@stop 
@section('content')
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
                <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#new"><span class='fa fa-plus'></span>&nbspNew Equipments</button>
                
                <div class=" pull-right" id="archive"> <a href="" class="btn btn-primary btn-flat"><span class='fa fa-archive'></span>&nbspArchive</a> </div>
            </div>
            <table id="equipList" class="table table-bordered table-striped" role="grid">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Daily Rate</th>
                        <th>Equipment Limit per stall</th>
                        <th style="width: 280px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($equips as $equip)
                    <tr>
                        <td>{{$equip->equipmentName}}</td>
                        <td>{{number_format($equip->rentDailyRate,2)}}</td>
                        <td>{{$equip->equipStallLimit}}</td>
                        <td>
                            <button class='btn btn-primary btn-flat' id="updateModal" data-id='{{$equip->equipmentID}}'><span class='glyphicon glyphicon-pencil'></span> Update</button>

                            <div class='btn-group'>
                                <button type='button' class='btn btn-danger btn-flat dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-trash'></span> Deactivate</button></button>
                                <ul class='dropdown-menu pull-right opensleft' role='menu'>
                                    <center>
                                        <h4>Are You Sure?</h4>
                                        <li class='divider'></li>
                                        <li><a href='#'>YES</a></li>
                                        <li><a href='#'>NO</a></li>
                                    </center>
                                </ul>
                            </div>
                        </td>
                    </tr>
                 @endforeach
                </tbody>
            </table>
        </div>
    </div>
<div class="modal fade" id="new" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form  action="" method="" id="">
            <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">New Equipment</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="bldgName">Name</label><span class="required">&nbsp*</span>
                                    <input type="text" class="form-control" name="newEquipment"
                                     placeholder="Equipment Name" required /> 
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <label for="bldgName">Daily Rate</label><span class="required">&nbsp*</span>
                                        <input type="text" name="newRate" class="form-control" onkeypress='validate(event)' >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                     <label for="bldgName">Equpment Limit Per Stall</label><span class="required">&nbsp*</span>
                                     <input type="text" name="newLimit" class="form-control" onkeypress='validate(event)'>
                                 </div>
                                </div>
                                
                            </div>

                            <div class="col-md-12">
                                <p class="small text-danger">Fields with asterisks(*) are required</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                                <!-- <label style="float:left">All labels with "*" are required</label> -->
                                <div class="pull-right">
                                    <button class="btn btn-primary btn-flat" id="newSave"><span class='fa fa-save'></span>&nbspSave</button>
                                </div>
                            </div>
                    
                </div>

        </form>
    </div>
</div>


<div class="modal fade" id="update" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form class="building" action="" method="" id="">
            <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Update Equipment</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="bldgName">Name</label><span class="required">&nbsp*</span>
                                    <input type="text" class="form-control" name="uEquipment" id="uName" 
                                     placeholder="Equipment Name" required /> 
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <label for="bldgName">Daily Rate</label><span class="required">&nbsp*</span>
                                        <input type="text" name="uRate" class="form-control" onkeypress='validate(event)' id="uRate" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                     <label for="bldgName">Equpment Limit Per Stall</label><span class="required">&nbsp*</span>
                                     <input type="text" name="uLimit" class="form-control" onkeypress='validate(event)' id="uLimit">
                                 </div>
                                </div>
                                
                            </div>

                            <div class="col-md-12">
                                <p class="small text-danger">Fields with asterisks(*) are required</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                                <!-- <label style="float:left">All labels with "*" are required</label> -->
                                <div class="pull-right">
                                    <button class="btn btn-primary btn-flat" id="uSave"><span class='fa fa-save'></span>&nbspSave</button>
                                </div>
                            </div>
                    
                </div>

        </form>
    </div>
</div>

@stop 
@section('script')
<script type="text/javascript" src="{{ URL::asset('js/floor_js.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/equipment.js') }}"></script>


@stop