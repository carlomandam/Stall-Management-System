@extends('layout.app') 
@section('title') 
{{ 'Stocks'}} 
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
<div class="panel panel-primary">
    <div class="panel-heading"><h4>List of Equipment</h4></div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="stocksList" class="table table-bordered table-striped" role="grid">
                <thead>
                    <tr>
                        <th>Equipment Name</th>
                        <th>Daily Rate</th>
                        <th>Equipment Limit per stall</th>
                        <th>Quantity</th>
                        <th style="width: 280px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($equips as $equip)
                    <tr>
                        <td>{{$equip->equipmentName}}</td>
                        <td>{{number_format($equip->rentDailyRate,2)}}</td>
                        <td>{{$equip->equipStallLimit}}</td>
                        <td class="text-right">
                            <?php $total=0;?>
                            @foreach($quantity as $quan)
                                <?php
                                    if($equip->equipmentID==$quan->equipmentID){
                                        $total = ($quan->stockStatus ? $total+$quan->stockQty : $total-$quan->stockQty);
                                    }
                                ?>
                            @endforeach
                            {{$total}}
                        </td>
                        
                        <td>
                            <button class='btn btn-success btn-flat' id="viewModal" data-id=''><span class='fa fa-eye'></span>View</button>
                            <button class='btn btn-info btn-flat' id="addModal" data-id='{{$equip->equipmentID}}'><span class='glyphicon glyphicon-plus'></span>Add</button>
                             <button class='btn btn-primary btn-flat' id="updateModal" data-id=''><span class='glyphicon glyphicon-pencil'></span>Update</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
<div class="modal fade" id="add" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form  action="" method="" id="">
            <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add Stocks</h4>
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
                                     placeholder="Equipment Name" required readonly id="Name" /> 
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <label for="bldgName">Daily Rate</label><span class="required">&nbsp*</span>
                                        <input type="text" name="newRate" class="form-control" onkeypress='validate(event)' readonly id="Rate">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                     <label for="bldgName">Equpment Limit Per Stall</label><span class="required">&nbsp*</span>
                                     <input type="text" name="newLimit" class="form-control" onkeypress='validate(event)' readonly id="Limit">
                                 </div>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bldgName">Quantity</label><span class="required">&nbsp*</span>
                                    <input type="text" class="form-control" name="quantity"
                                    placeholder="Enter Quantiy" required onkeypress='validate(event)' /> 
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
                                    <button class="btn btn-primary btn-flat" id="addSave"><span class='fa fa-save'></span>&nbspSave</button>
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
<script type="text/javascript" src="{{ URL::asset('js/stocks.js') }}"></script>


@stop