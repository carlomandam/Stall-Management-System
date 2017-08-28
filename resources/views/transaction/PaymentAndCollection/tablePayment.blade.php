@extends('layout.app')

@section('title')
{{ 'Payment'}}
@stop
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/bootstrap/css/panel-tab.css')}}">
<style type="text/css">
    .col-md-12{
        margin-top: 10px;
    }
</style>
@stop
@section('content-header')

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i> Payment and Collections</li>
</ol>
@stop


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel with-nav-tabs panel-primary">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1primary" data-toggle="tab">Bills</a></li>
                    <li><a href="#tab2primary" data-toggle="tab">Payments</a></li>
                                   
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1primary">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="col-xs-12">
                                  <div class="table-striped-responsive">
                                      <div class="defaultNewButton">
                                          <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#new_billing"><span class='fa fa-plus'></span>&nbspCreate a Bill</button>
                                         
                                      </div>
                                        <table id="tblstall" class="table table-striped" role="grid" style="width:100%">
                                            <thead>
                                                <th>Bill Number</th>
                                                <th>Bill Date</th>
                                                <th>StallHolder Name</th>
                                                <th>Billing Period</th>
                                                <th>Billed By</th>
                                                <th>Actions</th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- box box-primary -->
                    </div>
                    <!-- tab1primary -->
                    <div class="tab-pane fade" id="tab2primary">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="col-xs-12">
                                    <div class="table-striped-responsive">
                                       <div class="defaultNewButton">
                                          <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#new_billing"><span class='fa fa-plus'></span>&nbspAdd Bulk Payments</button>
                                         
                                      </div>
                                        <table id="tblreg" class="table table-striped" role="grid" style="width:100%">
                                            <thead>
                                                <th>StallHolder Name</th>
                                                <th>Stall Code</th>
                                                <th>Collection Status</th>
                                                <th>Current Balance</th>
                                                <th>Actions</th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                    <!-- tab2primary -->
                </div>
                <!-- tab content-->
            </div>
            <!-- panel body-->
        </div>
        <!-- panel with-nav-tabs-->
    </div>
    <!-- col-md-12 -->
</div>
<!-- row -->

<div class = "modal fade" id = "new_billing"  role="dialog">
  <div class="modal-dialog modal-lg" role="document">
   <form class="billing" action="" method="post" id="new_billing">
     <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
     <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Billing Information</h4> </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class = "col-md-3">
                                    <label for="billno">Bill Number</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="billno" name="billno" readonly="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class = "col-md-3">
                                    <label for="billto">Select Stallholder</label><span class="required">&nbsp*</span>
                                    </div>
                                    <div class = "col-md-6">
                                        <input type="text" class="form-control" id="billto" name="billto" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class = "col-md-2">
                                    <label for="billperiod">Billing Period</label>
                                    </div>
                                    <div class = "col-md-6">
                                        <select>
                                            <option>Week</option>
                                            <option>Month</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                      <p class="small text-danger">Fields with asterisks(*) are required</p>
                    </div>
                  
                    <div class="modal-footer">
                        <!-- <label style="float:left">All labels with "*" are required</label> -->
                        <div class="pull-right">
                            <button class="btn btn-primary btn-flat"><span class='fa fa-save'></span>&nbspSave</button>
                        </div>
                    </div>
                </div>
   </form>
  </div>
@stop