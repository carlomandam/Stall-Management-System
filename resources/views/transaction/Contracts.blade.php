@extends('layout.app')
@section('content-header')

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
                  <th>Starting Date</th>
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
 <div class="modal fade" tabindex="-1" id="new" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        
                            <input type="hidden" name="_token" value="<{{ csrf_token() }}">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">New Contract</h4> </div>
                                <div class="modal-body">
                                    <div class = "col-md-12 form-group row">
                                        <div class = "col-md-12">
                                        <label><b>Stall Holder Name:</b></label>
                                    
                                        <input type = "text" class = "form-control" id = "searchbox" name = "searchbox" value = "" placeholder="Search..."  />
                                      </div>

                                      
                            
                                     </div>
                                     <form action="" method="post" id="newform">
                            <div class = "col-md-12 form-group row">
                            <div class = "col-md-12">
                            <label for = "org"><b>Name of Group/Organization</b></label>
                            <label for ="ven_orgname" class = "form-control" ></label>
                        </div>
                        </div>
                  <div class="col-md-12 form-group row">

                    <div class="col-md-12">

                      <label for="sh_name"><b>Stall Holder Name:</b></label>
                    
                      <label for = "vendor_name" id="ven_name" ></label>
                    </div>
                  </div>
                  
                  
               

                               
                                 <div class = "col-md-12 form-group row">
                                <div class = "col-md-6">
                                        <label for = "email">*Email Address:</label>
                                        <input type = "email" class = "form-control" id = "email" name = "email"/>
                                </div>

                                <div class="col-md-6">
                                    <label for="phone"><b>* Mobile:</b></label>
                                    <input type="text" class="form-control" id="mob" name="mob"required>
                                 </div>
                                 </div>


                           
                            <div class="col-md-12 form-group row">
                                <div class = "col-md-12">
                                    <label for="address"><b>*Home Address:</b></label>
                            
                                    <textarea rows="4" class="form-control" id="address" name="address"></textarea>
                                </div>
                            </div>
                            
                                
                                </div>
                                <div class="modal-footer">
                                    
                                    <button class="btn btn-info pull-right" style="background-color:#191966" id = "btn-submit">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <!--end of modal view-->
  @stop

  @section('script')
    <script>
      $(document).ready(function () {
            $('#tblcontract').DataTable({
                ajax: '/rentInfo'
            , responsive: true
            , "columns": [
                 {
                    "data": "rentID"
                    }
                    , {
                    "data": "stallID" }
                    , {
                   "data" : function(data, type, dataToSet){
                            return (data.venFName+
                              " "+data.venLName);
                        }
                    }
                    , { "data" :  function(data, type, dataToSet){
                      var options = {year: 'numeric', month: 'long', day: 'numeric' };
                            $date = new Date(data.rentStartDate).toLocaleDateString("en-US",options);
                        
                            return $date;
                        }
                        }, //convert to MMMM-DD-YYYY
                      { "data": "rentStartDate"},
                      {"data": "rentStartDate"},
                 
                    { "data": "actions"}

            ]
            , "columnDefs": [
                {
                    "width": "20%"
                    , "searchable": false
                    , "sortable": false
                    , "targets": 6
                    }
  ]
            });

      $('#newform').attr('disabled',true);
          });
      function printpdf(id)
      {
          $.ajax({
            type:"POST",
            url: '/printPdf',
            data: {
              "_token" : "{{ csrf_token() }}",
              "id" : id
            },
            success : function (){
               window.open( '_blank');
            }
          })

      }
</script>

  @stop
