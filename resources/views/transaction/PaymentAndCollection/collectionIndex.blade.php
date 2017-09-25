@extends('layout.app')

@section('title')
{{'Collections'}}
@stop
@section('content-header')

@stop

@section('content')

    <div class="box box-primary">
        <div class="box-body">
                              

                           <div class="row" style="margin-top: 10px;">
                              <div class="col-md-2"><label>Tenant Name:</label></div>
                              <div class="col-md-8"><input type="text" name="" class="form-control" disabled value="{{$contract->StallRental->StallHolder->stallHFName}} {{$contract->StallRental->StallHolder->stallHMName}} {{$contract->StallRental->StallHolder->stallHLName}}"></div>
                          </div>

                           <div class="row" style="margin-top: 10px;">
                              <div class="col-md-2"><label>Stall Code:</label></div>
                              <div class="col-md-3"><input type="text" name="" class="form-control" disabled value="{{$contract->StallRental->stallID}}" 
                              ></div>
                              <div class="col-md-2"><label>Business Name:</label></div>
                              <div class="col-md-3">
                               <input type="text" name="" class="form-control" disabled value="{{$contract->StallRental->businessName}}">
                           
                              </div>
                          </div>

                          <div class="row" style="margin-top: 10px;">
                              <div class="col-md-2">
                                  <label>Date From:</label>
                              </div>
                              <div class="col-md-3">
                              <input type="text" name="" id = "dateFrom" name = "dateFrom" class="form-control" disabled value="{{$collectionDetails}}">
                              </div>

                              <div class="col-md-2">
                                  <label>Date To:</label>
                              </div>
                              <div class = "col-md-3">
                                  <input type="text" class="datepicker form-control" id='dateTo' name='dateTo' readonly="true" style="cursor:pointer; background-color: #FFFFFF;"/>
                              </div>

                                    
                          </div>


                      <div class="box  box-primary" style="margin-top: 40px;">
                        <div class="box-body">

                          <div class="table-responsive">
                            <table id="tblcollect" class="table table-bordered table-striped" role="grid">
                              <thead>
                                  <th>Date</th>
                                  <th>Description</th>
                                  <th>Amount</th>
                                
                               
                              </thead>
                            </table>
                          </div>
                        </div>
                      </div>
    </div>
</div>

@stop
@section('script')
<script type="text/javascript" src ="{{ URL::asset('js/billing.js') }}"></script>
<script type="text/javascript">
     
$(document).on('ready',function(){

        $(".datepicker").datepicker({
        showOtherMonths: true
        , selectOtherMonths: true
        , changeMonth: true
        , changeYear: true
        , autoclose: true
        ,startDate: "{{$nextCollection}}"
        , orientation: 'bottom'
        ,format: 'yyyy-mm-dd'

      
       
    });

        $('#dateTo').on('change',function(){
          // var table = $('#tblcollect').dataTable();
           var dateFrom = $('#dateFrom').val();
          var contractID = "{{$contract->contractID}}";
          var dateTo = $("#dateTo").val();
           $.ajax({
              type: "get",
              url: "/collectionTable",
              cache:false,
              data: {dateFrom:dateFrom, dateTo:dateTo, contractID : contractID }
            
         }).done( function(data) {
           
             $('#tblcollect').dataTable( {
            "aaData": data,
            destroy:true,
            "columns": [
                { "data": "date" },
                { "data": "desc" },
                { "data": "amount" }
               
            ]
        });
});  
         
        })
 
});

/*$("#dateTo").datepicker({

    onSelect: function(date, instance) {
       var dateFrom = $('#dateFrom').val();
       var contractID = "{{$contract->contractID}}";
        $.ajax({
              type: "get",
              url: "/collectionTable",
              data: {dateFrom:dateFrom, dateTo:date, contractID : contractID },
              success: function(data)
              {
                  //do something
                  alert(data);
              }
         });  
     }
});
*/



       

</script>
@stop