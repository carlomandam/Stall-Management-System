@extends('layout.app')
@section('title')
    {{"KioskMap"}}
@stop
@section('style')
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/select2/select2.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/bootstrap/css/panel-tab.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/bootstrap/css/mapping.css')}}">
@stop

@section('content-header')
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Maintenance</a></li>
        <li class="active">Kiosk Map</li>
      </ol>
@stop

@section('content')
  <div class="row">

      <div class="col-md-3">

          <!-- Border Choose Building -->
         <div class="col-md-12" style="top:-30px;" >

              <div class="panel panel-primary">
                  <div class="panel-heading" style=""></div>
                  <div class="panel-body">

                          <div class="form-group">
                              <label>Choose Building</label>
                              <select class="form-control select2 building" style="width: 100%;">
                                <option disabled selected="selected">--Select--</option>
                                @foreach($buildings as $building)
                                <option value="{{$building->bldgID}}">{{$building->bldgName}}</option>
                                @endforeach
                              </select>
                          </div>
                          <!-- /.form-group -->
                          <div class="form-group">
                              <label>Choose Floor No.</label>
                              <select class="form-control select2 floors" style="width: 100%;">
                                
                              </select>
                          </div>
                          <!-- /.form-group -->
                  </div>
                  <!-- panel-body -->
                  
              </div>
            
          </div>
          <!-- col-md-12 Border choose Building -->


           <!-- Border Choose Building -->
         <div class="col-md-12" style="top:-40px;">

              <div class="panel with-nav-tabs panel-primary">
                  <div class="panel-heading" style="height: 10%;">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Cart</a></li>
                            <li><a href="#tab2default" data-toggle="tab">Others</a></li>
                            <li style="margin-left: 20px;">
                              <h5>
                                <i class="fa fa-shopping-cart"></i>
                                <i>0</i>
                              </h5>
                            </li>
                            
                        </ul>
                  </div>
                  <div class="panel-body" style="height: 300px; overflow-y: scroll;">
                      <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1default">
                            <div style="text-align: right;">
                              <h5>
                              <i>Capacity</i>
                              <i>20/</i>
                              <i>30</i>
                              </h5>                              
                            </div>
                            




                          <div style="text-align: center;">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Stalls</button>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="tab2default">Default 2</div>
                    </div>
                          
                  </div>
                  <!-- panel-body -->
                  <div class="panel-footer" style="height: 5%;text-align: center;">
                    
                  </div>
              </div>
            
          </div>
          <!-- col-md-12 Border choose Building -->
        
      </div>
        <!-- col-md-3 -->

      <div class="col-md-9" style="top:-30px;">
         <div class="col-md-13" >
            
            <div class="panel with-nav-tabs panel-primary">
                  <div class="col-md-12 panel-heading" style="height: 10%;">
                      <ul class ="nav pull-left">
                          <li class=""><h4><span class="buildingname">Choose Building</span><small class="floorname" style="margin-left: 5px;color: white;">Floor No:</small></h4></li>
                            <!-- <li class="pull-right"><h5>Floor Name</h5></li> -->
                      </ul>
                      <ul class="nav nav-tabs pull-right" >
                            
                            <li class="active"><a href="#holder" data-toggle="tab">Map</a></li>
                            <li><a href="#tab2default" data-toggle="tab">Table</a></li>
                        </ul>
                 
                  
                  </div>
                  <div class="panel-body nav-tabs-custom" style="height: 550px;">
                      <div class="tab-content">
                        <div class="tab-pane fade in active" id="holder" style="overflow: scroll;">
                            
                              <ul  id="place">
                              </ul>    
                            <!-- <div style="float:left;"> 
                              <ul id="seatDescription">
                                <li style="background:url('images/available_seat_img.gif') no-repeat scroll 0 0 transparent;">Available Seat</li>
                                <li style="background:url('images/booked_seat_img.gif') no-repeat scroll 0 0 transparent;">Booked Seat</li>
                                <li style="background:url('images/selected_seat_img.gif') no-repeat scroll 0 0 transparent;">Selected Seat</li>
                              </ul>
                            </div>
                            <div style="clear:both;width:100%">
                              <input type="button" id="btnShowNew" value="Show Selected Seats" />
                              <input type="button" id="btnShow" value="Show All" />           
                            </div>
 -->

                          </div>
                        <div class="tab-pane fade" id="tab2default">Default 2</div>
                    </div>

                    </div>
                    <!-- panel-body -->
                 
              </div>
         </div>
      </div>
          <!-- col-md-9 -->

  </div>
    <!-- row -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Choose Stall</h4>
      </div>
      <div class="modal-body">
        <div>

          <ul>
            <li>
              <a href="#">
                <div style="width: 180px;height: 200px; border: 2px solid black;">
            
          <div style="border: 2px solid black;height: 150px;width: 150px;margin-left: 12px;margin-top: 5px; margin-bottom: 5px;">
              <p>INFORMATION</p>
          </div>

          <!-- plus minus -->
            <div>
                  <div class="input-group">
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                      <span class="glyphicon glyphicon-minus"></span>
                    </button>
                  </span>
                  <input style="text-align: center;" type="text" name="quant[1]" class="form-control input-number" value="0" min="0" max="200">
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
                      <span class="glyphicon glyphicon-plus"></span>
                    </button>
                  </span>
                </div>
                
            </div>
            <!-- plus minus -->
          </div>
              </a>    
            </li>
          </ul>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
	
@stop
@section('script')
<script src ="{{ URL::asset('assets/select2/select2.js')}}"></script>
<script>
  $('#mKiosk').addClass('active');
  $(".select2").select2();
  $(function(){

  })
</script>
<script type="text/javascript" src ="js/mapping.js"></script>




@stop




