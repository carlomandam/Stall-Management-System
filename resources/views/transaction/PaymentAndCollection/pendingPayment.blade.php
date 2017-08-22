@extends('layout.app')

@section('title')
{{ 'Pending Payments'}}
@stop
@section('content-header')

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i> Payment and Collections</li>
</ol>
@stop

@section('content')

<div class="box box-solid box-default">
  <div class="box-body" >
    <div class="col-md-12">
      <div class="box box-solid box-primary">
        <div class="box-header with-border">
         <h4 class="box-title">Payments</h4>
        </div>
        <div>

          <div class="box-body">
            <div class="col-xs-12">

             <button type="submit" class="btn btn-primary pull-left" style="margin-right: 2%" data-toggle="modal" data-target="#new"><span class='glyphicon glyphicon-plus'></span>Charge StallHolders</button>
              
                <div class="table-responsive">
                  <table id="prodtbl" class="table table-bordered table-striped" role="grid" style="font-size:15px;">

                      <thead>
                        <tr>
                          <th>StallHolder Name</th>
                          <th>Stall Code</th>
                          <th>Status</th>
                          <th>Current Balance</th>
                          <th>Action/s</th>
                        </tr>
                      </thead>
                      <tr>
                        <th>Brixter Kim</th>
                        <th>A001</th>
                        <th><span class="label label-warning">Warning</span></th>
                        <th>Php 1000.00</th>
                        <th>
                          <button type="" class="btn btn-primary" onclick="window.location='{{ url('/ViewPayment') }}'">View
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