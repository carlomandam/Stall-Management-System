@extends('layout.app')

@section('title')
{{ 'Payment'}}
@stop
@section('content-header')

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i>Transactions</li>
  <li class="active">Payment and Collections</li>
</ol>
@stop

@section('content')

<div class="box box-solid box-default">
  <div class="box-body" >
    <div class="col-md-12">
      <div class="box box-solid box-primary">
        <div class="box-header with-border">
          <div class="col-md-12">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1-1" data-toggle="tab" style="color:black">Current Statement</a></li>
              <li><a href="#tab_2-2" data-toggle="tab" style="color:black">Payment History</a></li>
            </ul>
          </div>
        </div>
        <div class="box-body">

          <div class="col-xs-12">
            
              <div class="table-responsive">
                <div class="tab-content">

                  <div class="tab-pane active" id="tab_1-1">

                    <div class="col-md-12">  
                      <div class="box box-primary">
                        <div class="box-header with-border">

                        </div>
                        <div class="box-body">
                          <div class="col-md-12">
                            <label class="col-md-3">Payment No.</label>
                            <div class="col-md-4"> 
                              <input type="text" disabled="" class="form-control">
                            </div>
                            <br style="line-height: 40px">
                          </div>
                          <div class="col-md-12">
                            <label class="col-md-3">StallHolder No.</label>
                            <div class="col-md-4">
                              <input type="text" class="form-control">
                            </div>
                            <label class="col-md-1">Date</label>
                            <div class="col-md-4">
                             
                                <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask/>
                             
                            </div>
                            <br style="line-height: 40px">
                          </div>

                          <div class="col-md-12">
                            <label class="col-md-3">StallHolder Name</label>
                            <div class="col-md-9">
                              <input type="text" class="form-control">
                            </div>
                            <br style="line-height: 40px">
                          </div>
                        </div>
                      </div>
                      <div class="box  box-primary">
                        <div class="box-header with-border">
                          <label>Stall Status</label>
                        </div>
                        <div class="box-body">

                          <div class="table-responsive">
                            <table id="" class="table table-bordered table-striped" style="font-size:15px;">
                              <thead>
                                <tr>
                                  <th>Stall Code</th>
                                  <th>Stall Balance</th>
                                  <th>Status</th>
                                </tr>
                              </thead>
                              <tr>
                                <th>A001</th>
                                <th>3000</th>
                                <th><span class="label label-warning">Warning</span></th>
                              </tr>

                              <tr>
                                <th>A002</th>
                                <th>3000</th>
                                <th><span class="label label-warning">Warning</span></th>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="box  box-primary">
                        <div class="box-header with-border">
                          <label>Accounts Payable</label>
                        </div>
                        <div class="box-body">

                          <div class="table-responsive">
                            <table id="prodtbl" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
                              <thead>
                                <tr>
                                  <th style="width: 20px"><input type="checkbox" ></th>
                                  <th style="width: 100px">Stall Code</th>
                                  <th>Description</th>
                                  <th>Due Date</th>
                                  <th>Amount</th>
                                  <th>Action/s</th>
                                </tr>
                              </thead>
                              <tr>
                                <th><input type="checkbox" ></th>
                                <th>A001</th>
                                <th>Stall Rate</th>
                                <th>03/21/2017</th>
                                <th>Php 100.00</th>
                                <th><button type="" class="btn btn-warning">Void</button>
                                </th>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </div>

                      <div class="box box-primary">
                        <div class="box-header with-border">
                          <label>Accounts Payable</label>
                        </div>
                        <div class="box-body">
                          <div class="col-md-12">
                            <div class="col-md-12">
                              <label class="col-md-3">Total Payable:</label>
                              <div class="col-md-6">
                                <div class="input-group">
                                  <div class="input-group-addon"><i>Php</i></div>
                                  <input type="text" class="form-control" name="" style="text-align: right" /> 
                                </div>
                              </div>
                            </div>
                            <br style="line-height: 40px">
                          </div>
                          <div class="col-md-12">
                            <div class="col-md-12">
                              <label class="col-md-3">Payment Type:</label>
                              <div class="col-md-6">
                                <select class="form-control">
                                  <option>Full-Payment</option>
                                  <option>Partial-Payment</option>
                                </select>
                              </div>
                              <br style="line-height: 40px">
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="col-md-12">
                              <label class="col-md-3">Total Paid:</label>
                              <div class="col-md-6">
                                <div class="input-group">
                                  <div class="input-group-addon"><i>Php</i></div>
                                  <input type="text" class="form-control" name="" style="text-align: right" /> 
                                </div>
                              </div>
                            </div>
                            <br style="line-height: 40px">
                          </div>
                          <div class="col-md-12">
                            <div class="col-md-12">
                              <label class="col-md-3">Amount Due:</label>
                              <div class="col-md-6">
                                <div class="input-group">
                                  <div class="input-group-addon"><i>Php</i></div>
                                  <input type="text" class="form-control" name="" style="text-align: right" /> 
                                </div>
                              </div>
                            </div>
                            <br style="line-height: 40px">
                          </div>
                          <button type="Submit" class="btn btn-primary pull-right">Confirm</button>
                          <button type="Submit" class="btn btn-default pull-right">Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  


                  



                  <div class="tab-pane" id="tab_2-2">
                    <button type="submit" class="btn btn-primary pull-left" style="margin-right: 2% ; width: 120px;" data-toggle="modal" data-target="#new"><span class='fa fa-print'></span>&nbspPrint</button>
                    <table id="prodtbl" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
                      <thead>
                        <tr>
                          <th>Date Paid</th>
                          <th>For</th>
                          <th>Period/Description</th>
                          <th>Amount</th>
                          <th>Action/s</th>
                        </tr>
                      </thead>
                      <tr>
                        <th>Brixter Kim</th>
                        <th>A001</th>
                        <th>12/29/2016</span></th>
                        <th>1000.00</th>
                        <th>
                          <button type="" class="btn btn-warning">Refund</button>
                            <button type="" class="btn btn-danger">Remove</button>
                            </th>
                          </tr>
                        </table>
                      </div>


                    </div>

                  </div>
                </div>

              </div>
           
          </div>
        </div>
      </div>
    </div>
  </div>

  @stop