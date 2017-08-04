@extends('layout.app')
@section('content-header')
<style>
.required {
    color: red;
} 
.col-md-12 column {  
   text-align:center;
}
.col-md-12 column form {
   display:inline-block;
}

</style>
<h1>List of Contracts</h1>
  @stop

  @section('content')
      <div class="box box-primary">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
           
            <div class = "table-responsive">
              <table id="tblcontract" class="table table-bordered table-striped" width="100%">
              
                <thead>
                <tr>
                  <th>No</th>
                  <th>Stall ID</th>
                  <th>Name</th>
                  <th>Contract Effectivity Date</th>
                  <th>Contract Ends</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
             
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </div>
          <!-- MODAL -->
          <!-- Modal -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete</h4>
      </div>
      <div class="modal-body">
        <h2>Are you sure?</h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success">Yes</button>
      </div>
    </div>
  </div>
</div>

<!--/.modal new contract=-->
<!--modal view-->
 <div class="modal fade" id="newcontract" 
     tabindex="-1" role="dialog" 
     aria-labelledby="newModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" 
        id="newModalLabel">New Contract</h4>
      </div>
      <div class="modal-body">
                        <div class = "col-md-12 form-group row">
                            <div class = "col-md-6">
                              <label for = "name">Stall Holder Name/ Organization:&nbsp</label> 
                              </div>
                              <div class = "col-md-6">
                              <p id = "nameAndOrg">Iwa motors of Tanya Markova</p>
                          </div>
                        </div>
                         <div class = "col-md-12 form-group row">
                            <div class = "col-md-6">
                              <label for = "name">Stall ID:&nbsp</label> 
                              </div>
                              <div class = "col-md-6">
                              <p id = "stall_no">bldg2-00001</p>
                          </div>
                        </div>
                        <div class = "col-md-12 form-group row">
                          <div class = "col-md-4">
                            <label for = "length">Length of Contract</label><span class="required">&nbsp*</span>
                           </div>
                           <div class = "col-md-8">
                            <input type = "text" id = "specific_no" name = "specific_no" placeholder="" />
                           
                            
                            <select name = "length" id = "length">
                                @foreach($contract_period as $period)
                               {
                                <option value = "{{$period['contract_periodID']}}">{{$period['contract_periodDesc']}}</option>
                               }
                            @endforeach
                            </select>
                                 
                          </div>
                  <p class="small text-danger" style="margin-top: 40px; margin-left: 20px;">Fields with asterisks(*) are required</p>
                    </div>
                  
                       
      </div>
      <div class="modal-footer">
         <button class="btn btn-info" style="background-color:#191966">Submit</button>
      </div>
    </div>
  </div>
</div>
  @stop

  @section('script')
   
  @stop
