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
                                          <a class="btn btn-primary btn-flat" href="{{ url('/CreateBill')}}" disabled><span class='fa fa-plus'></span>&nbspRecord Utilities Bill</a>
                                         
                                      </div>
                                        <table id="tblBills" class="table table-striped" role="grid" style="width:100%">
                                            <thead>
                                                <th>Bill Number</th>
                                                <th>Bill Date</th>
                                                <th>Bill To</th>
                                                <th>Billing Period</th>
                                                <th>Amount Due</th>
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
                                          <a class="btn btn-primary btn-flat" data-toggle="modal" data-target="#new_payment" disabled ><span class='fa fa-plus'></span>&nbspAdd Bulk Payments</a>
                                         
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

<div class = "modal fade" id = "new_payment"  role="dialog">
  <div class="modal-dialog modal-md" role="document">
   <form class="billing" action="" method="post" id="bulk_payment">
     <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
     <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Bulk Payments</h4> </div>
                    <div class="modal-body">
              

                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class = "col-md-3">
                                    <label for="billto">Select Stallholder</label>
                                    </div>
                                    <div class = "col-md-9">
                                         <select class="js-example-placeholder-multiple" style="width: 100%;  " id="ven_name" name="ven_name"> </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class = "col-md-3">
                                    <label for="billperiod">Amount Paid</label>
                                    </div>
                                    <div class = "col-md-9">
                                          <input type='text' class='form-control money' name='' >
                                    </div>
                                </div>
                            </div>
                        </div>
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
@section('script')
<script src ="{{ URL::asset('js/jquery.inputmask.bundle.js')}}"></script>
<script src ="{{ URL::asset('js/phone-ru.js')}}"></script>
<script src ="{{ URL::asset('js/phone-be.js')}}"></script>
<script src ="{{ URL::asset('js/phone.js')}}"></script>
    <script type="text/javascript">
     
     $(document).ready(function(){
        $('.js-example-placeholder-multiple').select2({
            width: 'resolve'
        });

    Inputmask().mask(document.querySelectorAll("input"));

    $(".money").inputmask("currency",{radixPoint: '.', 
                                      prefix: "₱ "});
    
   
   
       
          $.get('/getBills', function(data){
                var table = $('#tblBills').DataTable().clear();
                console.log(data);
               
                $.each(data, function(i,data){
                    var str =  "" + data.billNo;
                    var ans = 'BILL'+('00000'+str).substring(str.length);
                    var fromDate = new Date(data.billFrom);
                    var fromDay = fromDate.getDate();
                    var toDate = new Date(data.billTo);
                    var toDay = toDate.getDate();
                    var total = 0;
                    for(i =fromDay; i <= toDay; i++)
                    {
                        total+= data.rate;
                    }
                    table.row.add([
                       ans,
                       data.billDate,
                        data.stallHolderName + " <p>(Stall "+ data.StallID+")</p>",
                        (new Date(data.billFrom)).toString().split(' ').splice(1,3).join(' ') + " - " +  (new Date(data.billTo)).toString().split(' ').splice(1,3).join(' '),
                      total,
                        "<button class='btn btn-flat btn-success' onclick='window.location="+'"'+"http://127.0.0.1:8000/ViewBill/&quot;+this.value+&quot;"+'"'+"' class='btn btn-flat btn-primary' value = '"+data.billNo+"'  target ='_blank'><span class = 'fa  fa-print'></span>&nbspPrint Bill</button> "
                        
                    
                        
                        ]).draw();
                });
            });

         
     $.ajax({
            url: '/CheckBillingRecords',
            success: function (response) {
              
                }
            
            });




     });
    


    </script>
@stop