<?php $__env->startSection('content-header'); ?>
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
  <?php $__env->stopSection(); ?>

  <?php $__env->startSection('content'); ?>
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
                                <?php $__currentLoopData = $contract_period; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $period): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               {
                                <option value = "<?php echo e($period['contract_periodID']); ?>"><?php echo e($period['contract_periodDesc']); ?></option>
                               }
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
  <?php $__env->stopSection(); ?>

  <?php $__env->startSection('script'); ?>
    <script>
      $(document).ready(function () {
         //Set selected value in length of contract//
        $("#length").val($("#length option:first").val());
        var placeholderValue;
   
                if($("#length option:selected").text().indexOf('Week') > -1)
                {
                    placeholderValue = "No. of Week/s";
                }
                else if($("#length option:selected").text().indexOf('Month') > -1)
                {
                    placeholderValue = "No. of Month/s";
                }
                else
                {
                    placeholderValue = "No. of Year/s";
                }
            $('#specific_no').attr('placeholder',""+placeholderValue);

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
            url: '/htmltopdfview',
            data: {
              "_token" : "<?php echo e(csrf_token()); ?>",
              "id" : id
            },
            success : function (){
               
            }
          })

      }

       //LENGTH OF CONTRACT//

     $('#length').on('change',function(){
       var placeholderValue;
     if($("#length option:selected").text().indexOf("(") > -1)
        { 
                if($("#length option:selected").text().indexOf('Week') > -1)
                {
                    placeholderValue = "No. of Week/s";
                }
                else if($("#length option:selected").text().indexOf('Month') > -1)
                {
                    placeholderValue = "No. of Month/s";
                }
                else
                {
                    placeholderValue = "No. of Year/s";
                }
            $('#specific_no').attr('placeholder',""+placeholderValue);
            
             $('#specific_no').removeAttr('disabled',false);
            
             $('#specific_no').val('');
        }
        else{
            
             $('#specific_no').val('N/A');
             $('#specific_no').attr('disabled',true);
             $('#specific_no').removeAttr('placeholder',false);
        }
     })
     
     
     
     //END OF LENGTH OF CONTRACT//

     function callRoute(rentid)
     {
      window.open('/htmltopdfview/' +rentid,'_blank');

     }
</script>

  <?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>