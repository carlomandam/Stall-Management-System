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


<div class="col-md-6 pull-right">
  <div class="box box-solid box-default">
    <div class="box-body">
      <div class="col-xs-12">
        <div class="box">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <div class="col-md-12 pull-left">
                  <div class="form-group">
                    <div>
                      <label for="">Vendor Name: Brixter Kim Duenas</label>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                 <table id="" class="table table-bordered table-striped" style="font-size:12px;">
                  <thead>
                    <tr>
                      <th>Stall Code</th>
                      <th>Security Bank</th>
                      <th>Stall Balance</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tr>
                    <th>A001</th>
                    <th>4000</th>
                    <th>3000</th>
                    <th><span class="label label-warning">Warning</span></th>
                  </tr>

                  <tr>
                    <th>A001</th>
                    <th>4000</th>
                    <th>3000</th>
                    <th><span class="label label-warning">Warning</span></th>
                  </tr>
                </table>
              </div>
            </div>
            <div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<div class="col-md-6 pull-right">
  <div class="box box-solid box-default">
    <div class="box-body">
      <div class="box">
        <div class="row">
          <div class="col-md-12">
           <div class="col-md-12">
            <label>
              <input type="checkbox" onclick="AddCharges()">Add Charges</input>
            </label>

            <div class="col-md-12" id="Amount" style="display: none">
            <div class="pull-right">
              <button  class="btn btn-danger btn-xs"><span class="fa fa-fw fa-remove"></span></button>
              </div>
              <label>Amount</label>
              <input type="text" class="form-control"/>
              <div class="input-group" id="Description" style="display: none">
              <label>Description</label>
              <div class="col-sm-12">
                <textarea type="" class="form-control" id="" placeholder=""></textarea> 
              </div>
              <div class="pull-right">
              <button  class="btn btn-primary btn-xs"><span class="fa fa-fw fa-plus"></span></button>
              </div>
              
            </div>
            </div>





            <div class="col-md-12">
             <label > Total Amount</label>
             <input type="text" class="form-control" id="" name="" placeholder="" /> 
           </div>
           <div class="col-md-12">
             <label >Amount Receive</label>
             <input type="text" class="form-control" id="" name="" placeholder="" /> 
           </div>
          </div>
          <div class="col-md-3 pull-right">
           <button class="btn btn-primary">Pay</button> 
         </div>


         <div>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
</div>

<div class="col-md-12">
  <div class="box box-solid box-primary">
    <div class="box-header with-border">
      <button type="submit" class="btn btn-default pull-left" style="margin-right: 2%" data-toggle="modal" data-target="#new"><span class='glyphicon glyphicon-plus'></span>New Billing</button>

      <a href="#demo" class="btn btn-primary pull-right" data-toggle="collapse">Pay</a>
    </div>
    <div>

      <div class="box-body" style="height:450px; overflow-y: scroll;">


        <div class="col-xs-12">

          <div class="box">
           <div>

            <div class="table-responsive">
              <table id="prodtbl" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
                <thead>
                  <tr>
                    <th style="width: 20px"><input type="checkbox" ></th>
                    <th style="width: 100px">Stall Code</th>
                    <th>Description</th>
                    <th>Date Created</th>
                    <th>Status</th>
                    <th>Amount</th>
                    <th>Action/s</th>
                  </tr>
                </thead>
                <tr>
                  <th><input type="checkbox" ></th>
                  <th>A001</th>
                  <th>Stall Rate</th>
                  <th>03/21/2017</th>
                  <th><span class="label label-danger">Unpaid</span></th>
                  <th>100</th>
                  <th><button type="" class="btn btn-warning">Void
                    <button type="" class="btn btn-success">Refund
                    </th>
                  </tr>

                  <tr>
                    <th><input type="checkbox" ></th>
                    <th>A001</th>
                    <th>Stall Rate</th>
                    <th>03/21/2017</th>
                    <th><span class="label label-danger">Unpaid</span></th>
                    <th>100</th>
                    <th><button type="" class="btn btn-warning">Void
                      <button type="" class="btn btn-success">Refund
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

  <div class="modal fade" id="new" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
      <form class="building" action="" method="post" id="newform">
        <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="modal-content">
          <div class="modal-header">
            <div class="col-md-12">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Add Billing</h4> 
            </div>

          </div>

          <div class="modal-body">
            <div class="row">
              <div class="col-md-12 pull-right">
                <div class="nav nav-tabs pull-left">
                  <button class="btn btn-default active" href="#tab_1-1" data-toggle="tab">Stall Rate</button>
                  <button class="btn btn-default" href="#tab_2-2" data-toggle="tab">Utilities</button>
                  <button class="btn btn-default"  href="#tab_3-2" data-toggle="tab">Aditional Charges</button>

                </div>
              </div>
              <form class="form-horizontal">
                <div class="box-body">

                  <div class="row">

                    <div class="col-md-12">

                      <div class="tab-content">
                        <div class="tab-pane active" id="tab_1-1">

                          <div class="form-group">

                            <label for="" class="col-sm-3 control-label">Stall Code</label>

                            <div class="col-sm-9">
                              <input type="" class="form-control" id="" placeholder="">
                            </div>
                          </div>

                          <br>
                          <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Date</label>

                            <div class="col-sm-9">
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask/>
                              </div>
                            </div>
                          </div>

                          <br>

                          <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Amount</label>

                            <div class="col-sm-9">
                              <div class="input-group">
                                <span class="input-group-addon">P</span>
                                <input type="text" class="form-control" style="text-align: right">
                              </div>
                            </div>

                            <br>
                          </div>
                          <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Description</label>

                            <div class="col-sm-9">
                              <textarea type="" class="form-control" id="" placeholder=""></textarea> 
                            </div>
                          </div>
                          <br>
                          <div class="form-group">
                           <button type="submit" class="btn btn-primary pull-right">Record</button>
                           <button type="submit" class="btn btn-default pull-right">Cancel</button>

                         </div>
                         <br>

                       </div>
                       <div class="tab-pane" id="tab_2-2">
                         <div class="form-group">

                          <label for="" class="col-sm-3 control-label">Stall Code</label>

                          <div class="col-sm-9">
                            <input type="" class="form-control" id="" placeholder="">
                          </div>
                        </div>

                        <br>
                        <div class="form-group">
                          <label for="" class="col-sm-3 control-label">Date</label>

                          <div class="col-sm-9">
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask/>
                            </div>
                          </div>
                        </div>

                        <br>
                        <div class="form-group">
                          <div class="col-md-6">
                            <div class="checkbox">
                              <label>
                                <input type="checkbox"> Water
                              </label>
                            </div>
                            <div class="form-group">
                              <div class="radio">
                                <label>
                                  <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                  Fixed Rate
                                </label>
                                <div class="input-group">
                                  <span class="input-group-addon">P</span>
                                  <input type="text" class="form-control" style="text-align: right">
                                </div>

                              </div>
                              <div class="radio">
                                <label>
                                  <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                  Monthly Reading(Meter ID)
                                </label>
                                <div class="col-md-12">
                                  <input type="text" class="form-control">
                                </div>
                              </div>

                            </div>  
                          </div>
                          <div class="col-md-6">
                            <div class="checkbox">
                              <label>
                                <input type="checkbox"> Electricity
                              </label>
                            </div>
                            <div class="form-group">
                              <div class="radio">
                                <label>
                                  <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                  Fixed Rate
                                </label>
                                <div class="input-group">
                                  <span class="input-group-addon">P</span>
                                  <input type="text" class="form-control" style="text-align: right">
                                </div>

                              </div>
                              <div class="radio">
                                <label>
                                  <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                  Monthly Reading(Meter ID)
                                </label>
                                <div class="col-md-12">
                                  <input type="text" class="form-control">
                                </div>
                              </div>

                            </div>  
                          </div>
                        </div>  
                        <br>
                        <div class="form-group">
                         <button type="submit" class="btn btn-primary pull-right">Record</button>
                         <button type="submit" class="btn btn-default pull-right">Cancel</button>

                       </div>
                     </div>

                     <div class="tab-pane" id="tab_3-2">
                       <div class="form-group">

                        <label for="" class="col-sm-3 control-label">Stall Code</label>

                        <div class="col-sm-9">
                          <input type="" class="form-control" id="" placeholder="">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Date</label>

                        <div class="col-sm-9">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask/>
                          </div>
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Amount</label>

                        <div class="col-sm-9">
                          <div class="input-group">
                            <span class="input-group-addon">P</span>
                            <input type="text" class="form-control" style="text-align: right">
                          </div>
                        </div>

                      </div>
                      <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Description</label>

                        <div class="col-sm-9">
                          <textarea type="" class="form-control" id="" placeholder=""></textarea> 
                        </div>
                      </div>
                      <div class="form-group">
                       <button type="submit" class="btn btn-primary pull-right">Record</button>
                       <button type="submit" class="btn btn-default pull-right">Cancel</button>

                     </div>
                     <br>

                   </div>
                 </div>
               </div>
             </div>
           </div>
         </form>
       </div>
     </div>
   </div>
 </div>
</form>
</div>
</div>
<script type="text/javascript">
  
function AddCharges() {
    var x = document.getElementById('Description');
    var y = document.getElementById('Amount');
    if (x.style.display === 'none') {
      x.style.display = 'block';
      y.style.display= 'block';
    } else {
      x.style.display = 'none';
      y.style.display= 'none';
    }
  }

</script>


@stop