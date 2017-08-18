@extends('layout.app')
@section('title')
    {{"KioskMap"}}
@stop
@section('style')
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/select2/select2.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/bootstrap/css/panel-tab.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/bootstrap/css/mapping.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/bootstrap/css/Kioskmap.css')}}">
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
         <div class="col-md-12" >

              <div class="panel panel-primary">
                  <div class="panel-heading" style="">
                    <h5>
                      <span>Stall Capacity</span>
                      <span></span>
                       <span class="cap"></span>
                    </h5>
                  </div>
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
         <div class="col-md-12">

              <div class="panel with-nav-tabs panel-primary">

                  <div class="panel-heading" style="height: 10%;">

                        <ul class="nav nav-tabs">

                            <li class="active"><a href="#stalltpyetab" data-toggle="tab">Type</a></li>
                            <li><a href="#otherstab" data-toggle="tab">Others</a></li>
                        </ul>
                        <!-- nav nav-tabs -->

                  </div>
                  <!-- panel-heading -->

                  <div class="panel-body" style="height: 290px; overflow: scroll;">
                      <div class="tab-content">
                        <div class="tab-pane fade in active" id="stalltpyetab">
                              <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th></th>
                                    <th>Type</th>
                                    <th>Size</th>
                                    <th>Frequency</th>
                                    <th>Rate</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($types as $type)
                                              <tr>
                                                <td id=""><input type="radio" name=""></td>
                                                <td>{{$type ->StallType->stypeName}}</td>
                                                <td>{{$type->StallTypeSize->stypeArea}}</td>
                                                @foreach($rates as $rate)
                                                    @if(($rate->stype_SizeID)==($type->stype_SizeID))
                                                         @if(($rate->frequencyDesc)== 1)
                                                              <td>Daily</td>
                                                              @foreach($rate->StallRateDetail as $detail)
                                                              @endforeach

                                                          @elseif(($rate->frequencyDesc)== 2)
                                                              <td>Weekly</td>
                                                          @elseif(($rate->frequencyDesc)== 3)       
                                                              <td>Monthly</td>
                                                         @endif
                                                    @endif
                                                @endforeach
                                               
                                              </tr>
                                  @endforeach
                                </tbody>
                              </table>
                              
                        </div>

                        <div class="tab-pane fade" id="otherstab">
                        Default 2
                        </div>
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

      <div class="col-md-9">
            <div class="col-md-12" style="margin-bottom: 3px;">
                <button class="btn btn-primary"><i class="fa fa-plus-square"></i> Add</button>
                <button class="btn btn-info"><i class="fa fa-wrench"></i>Update</button>
                <button class="btn btn-danger"><i class="fa fa-ban"></i>Delete</button>
            </div>
                    <!-- Border Choose Building -->
        <div class="col-md-12" >
            
            <div class="panel with-nav-tabs panel-primary">

                  <div class="panel-heading" style="height:47px;">

                      <ul class ="nav pull-left">
                          <li class="">
                          <h4>
                          <span class="buildingname">Choose Building</span>
                          <small class="floorname" style="margin-left: 5px;color: white;"></small>
                          </h4>
                          </li>
                            
                      </ul>

                      <ul class="nav nav-tabs pull-right" >
                            <li class="active"><a href="#map" data-toggle="tab">Map</a></li>
                            <li><a href="#table" data-toggle="tab">Table</a></li>
                      </ul>

                  </div>
                  <!-- col-md-12 panel-heading -->

                  <div class="panel-body nav-tabs-custom" style="height: 510px;">

                      <div class="tab-content">

                        <div class="tab-pane fade in active" id="map">

                           <div id="platform">
                             <ul id ="place">
                               
                             </ul>
                           </div>

                        </div>
                          <!-- tab-pane fade in active -> map -->

                        <div class="tab-pane fade" id="table">
                              <table id = "stallList" class=" table table-hover" >
                                    <thead>
                                          <tr>
                                                <th>Description</th>
                                                <th>Remarks</th>
                                                <th>Type and Size</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                          </tr>
                                    </thead>

                                    <tbody>
                                      
                                    </tbody>
                              </table>
                        </div>

                        </div>
                        <!-- tab-content -->
                  </div>
                   <!-- panel-body nav-tabs-custom -->
            </div>
            <!-- panel with-nav-tabs panel-primary -->
         </div>
         <!-- col-md-12 -->
      </div>
          <!-- col-md-9 -->
  </div>
    <!-- row -->




	
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




