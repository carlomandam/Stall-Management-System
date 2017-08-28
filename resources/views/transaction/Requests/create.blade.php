@extends('layout.app')
@section('title')
{{ 'New Request'}}
@stop
@section('content-header')
<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i> Manage Requests</li>
  <li class="active">New Request</li>
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
<div class="box box-solid box-default">
      <div class="box-body" >
            <div class="col-md-12">
                  <div class="box box-solid box-primary">
                      <div class="box-header with-border">
                            <label>Create Request</label>
                      </div>
                      <div>
                          <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form>
                                         
                                        <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Stall Holder:</label>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control stallHolder" style="width: 100%;" name="newHolderName">
                                                      <option disabled selected="selected">--Select--</option>
                                                      @foreach($stalls as $stall)
                                                        <option value="{{$stall->stallHID}}" >{{$stall->stallHFName}}{{$stall->stallHMName}}{{$stall->stallHLName}}</option>
                                                      @endforeach
                                                     
                                                  </select> 
                                            </div>
                                          </div>
                                        </div>
                                         <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Request Type:</label>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control requestType" style="width: 100%;" name="newType"> 
                                                      <option disabled selected="selected">--Select--</option>
                                                      <option value="1">Transfer Request</option>
                                                      <option value="2">Cancel Contract</option>
                                                      <option value="3">Others</option>
                                                  </select> 
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px; display: none;" id="typeTransfer">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Select stall:</label>
                                            </div>
                                            <div class="col-md-4">
                                                <table width="100%" class="table table-bordered table-striped">
                                                    <thead>
                                                      <tr>
                                                        <th>From:</th>
                                                        <th>To:</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody class='activeStall'>
                                                        
                                                    </tbody>
                                                </table> 
                                            </div>
                                          </div>
                                        </div>
                                         <div class="col-md-12" style="margin-top: 10px;display: none;" id="typeCancel">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Select stall:</label>
                                            </div>
                                            <div class="col-md-4">
                                                <table width="100%" class="table table-bordered table-striped">
                                                    <thead>
                                                      <tr>
                                                        <th></th>
                                                        <th>Stall Code:</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody class="contract">
                                                        
                                                    </tbody>
                                                </table> 
                                            </div>
                                          </div>
                                        </div>
                                         <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Request Description:</label>
                                            </div>
                                            <div class="col-md-6">
                                              <textarea class="form-control" name="newDesc"></textarea>
                                            </div>
                                          </div>
                                        </div>
                                         <div class="col-md-12" style="margin-top: 10px;">
                                            <div class="pull-right">
                                                <button class="btn btn-primary" id="save" ><i class="fa fa-save"></i> Save</button>
                                                 <button class="btn btn-danger"><a href="/requestList">Cancel</a> </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                          </div>
                      </div>
                  </div>
            </div>
      </div>
</div>
@stop

@section('script')
<script src ="{{ URL::asset('assets/select2/select2.js')}}"></script>
<!-- <script type="text/javascript" src ="js/request.js"></script> -->
<script type="text/javascript">
  $("#stallHolder").select2();
  $("#stallTo").select2();
  $(document).on('change','.stallHolder',function(){
     id = $(this).val();
     $('.cList').remove();
     $('.aList').remove();
     $.ajax({
        type: "GET",
        url: '/requestList/getStall/'+id,
        success: function(data)  {
           $.each(data.active.active_stall_rental,function(key,value){
              $('.activeStall').append('<tr class="aList" ><td>'+value.stallID+'</td><td><select class ="form-control" name="newStall"><option selected="selected"></option>@foreach($avails as $avail)<option value ="{{$avail->stallID}}">{{$avail->stallID}}</option>@endforeach</select></td></tr>');
              $('.contract').append('<tr class="cList"><td><input type="checkbox" value="'+value.stallID+'" ></td><td>'+value.stallID+'</td></tr>');
             
              
           });
          
        }  
     });
  })
  $(document).on('click','#save', function(e){
    e.preventDefault();
    var count1 = $('.activeStall').children('tr').length;
    var count2 = $('.contract').children('tr').length;
    var getStall = [];
    var _token = $("input[name='_token']").val();
    var newName = $("select[name='newHolderName']").val();
    var newType = $("select[name='newType']").val();
    var newDesc = $("textarea[name='newDesc']").val();
        if(newType==1){
              for (var i = 0; i <count1 ; i++) {
                 var temp;
                 temp = $('select[name="newStall"]').eq(i).find('option:selected').val();
                 console.log(temp);
                 if(temp!=''){
                  getStall[i]= temp;
                 
                 }
              }
              console.log(getStall);
        }
   
    
  })
  $(document).on('change', '.requestType',function(){
    id=$(this).val();
    console.log(id);
    if(id==1){
      $('#typeTransfer').show();
      $('#typeCancel').hide();
    }
    else if(id==2){
      $('#typeTransfer').hide();
      $('#typeCancel').show();
    }
    else{
      $('#typeTransfer').hide();
      $('#typeCancel').hide();
    }
  })

  
  // $(document).on('change', '#pickStall',function(){
  //   id=$(this).val();
  //   console.log(id);
  // })




</script>

@stop