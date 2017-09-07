@extends('layout.app')
@section('title')
{{ 'Utilities'}}
@stop
@section('content-header')
<style>
.col-md-12, .col-md-10 {  
   
   margin-top: 10px;
}
.col-md-12 column form {
   display:inline-block;
}

.btn{
  width: 120px;
}

</style>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Utilities</a></li>
      </ol>
  @stop

  @section('content')
 
   <div class="row">
    <!--left table-->

        <div class = "col-md-12">
          <div class="box box-primary ">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Utilities</b></h3>
            </div>
          
          <div class = "box-body">

            <div class = "col-md-12">
              <div class="callout callout-info">
                  <h4>Info</h4>
                   <p>Security Deposit is applicable to New StallHolders</p>
                   <p>Stall Maintenance Fee is renew annually</p>
                   <p>Set Collection status that will depend on the maximum debt amount. One vendor with 3 stalls means 3 status as well.</p>


              </div>
            </div>

             <div class = "col-md-10">
                <div class = "form-group">
                  <h4><b>Initial Fees</b></h4>
                  <div class="col-md-2">
                   <label>Security Deposit</label>
                  </div>
                  <div class = "col-md-3">
                    <input type='text' class='form-control money' name='' >
                  </div>
               
                </div>
            </div>

            <div class = "col-md-10">
                <div class = "form-group">
              
                  <div class="col-md-2">
                   <label>Stall Maintenance</label>
                  </div>
                  <div class = "col-md-3">
                    <input type='text' class='form-control money' name='' >
                  </div>
               
                </div>
            </div>



            <div class = "col-md-12">
              <h4><b>Collection Status</b></h4>
                    <div class = "col-md-1">
                      <h4>No</h4>
                    </div>

                    <div class = "col-md-3">
                      <h4>Collection Status Name</h4>
                    </div>

                    <div class = "col-md-3">
                        <h4>Alert Color</h4>
                    </div>

                    <div class = "col-md-3">
                       <h4>Maximum Debt Amount</h4>
                    </div>

            </div>
            <div class = "col-md-12">
                    <div class = "col-md-1">
                      <label>1</label>
                    </div>

                    <div class = "col-md-3">
                     <label>Sell</label>
                    </div>

                    <div class = "col-md-3">
                      <input type="color" class="form-control" id="color_new" > 
                    </div>

                    <div class = "col-md-3">
                        <input type='text' class='form-control money' name='' >
                    </div>
            </div>

             <div class = "col-md-12">
                    <div class = "col-md-1">
                      <label>2</label>
                    </div>

                    <div class = "col-md-3">
                     <label>Collect</label>
                    </div>

                    <div class = "col-md-3">
                      <input type="color" class="form-control" id="color_new" > 
                    </div>

                    <div class = "col-md-3">
                        <input type='text' class='form-control money' name='' >
                    </div>
            </div>

            <div class = "col-md-12">
                    <div class = "col-md-1">
                      <label>3</label>
                    </div>

                    <div class = "col-md-3">
                     <label>Reminder</label>
                    </div>

                    <div class = "col-md-3">
                      <input type="color" class="form-control" id="color_new" > 
                    </div>

                    <div class = "col-md-3">
                        <input type='text' class='form-control money' name='' >
                    </div>
            </div>

               <div class = "col-md-12">
                    <div class = "col-md-1">
                      <label>4</label>
                    </div>

                    <div class = "col-md-3">
                     <label>Warning</label>
                    </div>

                    <div class = "col-md-3">
                      <input type="color" class="form-control" id="color_new" > 
                    </div>

                    <div class = "col-md-3">
                        <input type='text' class='form-control money' name='' >
                    </div>
            </div>

               <div class = "col-md-12">
                    <div class = "col-md-1">
                      <label>5</label>
                    </div>

                    <div class = "col-md-3">
                     <label>Lock</label>
                    </div>

                    <div class = "col-md-3">
                      <input type="color" class="form-control" id="color_new" > 
                    </div>

                    <div class = "col-md-3">
                       <input type='text' class='form-control money' name='' >
                    </div>
            </div>




          </div>
        <div class = "box-footer">
        <div class = "pull-right" style="margin-right: 20px;">
          <button class = "btn btn-flat btn-default">Edit</button>
          <button class = "btn btn-flat btn-primary">Save Changes</button>
        </div>
        </div>
        </div>
        </div>
        <!--box primary-->
       

  </div>

<!-- /.row -->

 @stop
  @section('script')
<script src ="{{ URL::asset('js/jquery.inputmask.bundle.js')}}"></script>
<script src ="{{ URL::asset('js/phone-ru.js')}}"></script>
<script src ="{{ URL::asset('js/phone-be.js')}}"></script>
<script src ="{{ URL::asset('js/phone.js')}}"></script>
  <script type="text/javascript">
    
    $(document).ready(function(){
  Inputmask().mask(document.querySelectorAll("input"));

    $(".money").inputmask("currency",{radixPoint: '.', 
                                      prefix: "₱ "});
});

  </script>
  @stop 