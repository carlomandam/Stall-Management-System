<?php $__env->startSection('title'); ?>
<?php echo e('Collections'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="box box-primary">
        <div class="box-body">
        <form>
            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>
                              

                           <div class="row" style="margin-top: 10px;">
                              <div class="col-md-2"><label>Tenant Name:</label></div>
                              <div class="col-md-8"><input type="text" name="" class="form-control" disabled value="<?php echo e($contract->StallRental->StallHolder->stallHFName); ?> <?php echo e($contract->StallRental->StallHolder->stallHMName); ?> <?php echo e($contract->StallRental->StallHolder->stallHLName); ?>"></div>
                          </div>

                           <div class="row" style="margin-top: 10px;">
                              <div class="col-md-2"><label>Stall Code:</label></div>
                              <div class="col-md-3"><input type="text" name="" class="form-control" disabled value="<?php echo e($contract->StallRental->stallID); ?>" 
                              ></div>
                              <div class="col-md-2"><label>Business Name:</label></div>
                              <div class="col-md-3">
                               <input type="text" name="" class="form-control" disabled value="<?php echo e($contract->StallRental->businessName); ?>">
                           
                              </div>
                          </div>

                          <div class="row" style="margin-top: 10px;">
                              <div class="col-md-2">
                                  <label>Date From:</label>
                              </div>
                              <div class="col-md-3">
                              <input type="text" name="" id = "dateFrom" name = "dateFrom" class="form-control" disabled value="<?php echo e($collectionDetails); ?>">
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
                              <tfoot>
                                <tr >
                                  <th colspan = "2" style="text-align: right; ">Total:</th> 
                                  <th></th>
                                </tr>
                              </tfoot>
                             
                            </table>
                          </div>
                        </div>
  </div>
</form>

                        <div class = "pull-right">
                          <div class = "col-md-12" >
                            <button class="btn btn-primary btn-flat" id = "save" style="width:100px; margin: 20px;"> <i class="fa fa-save"></i> Save</button>
                          </div>
                        </div>
                      </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript" src ="<?php echo e(URL::asset('js/billing.js')); ?>"></script>
<script type="text/javascript">
     
$(document).on('ready',function(){

        $(".datepicker").datepicker({
        showOtherMonths: true
        , selectOtherMonths: true
        , changeMonth: true
        , changeYear: true
        , autoclose: true
        ,startDate: "<?php echo e($nextCollection); ?>"
        , orientation: 'bottom'
        ,format: 'yyyy-mm-dd'
     
      
       
    });
          $('#tblcollect').dataTable({
        });

        $('#dateTo').on('change',function(){
          // var table = $('#tblcollect').dataTable();
           var dateFrom = $('#dateFrom').val();
          var contractID = "<?php echo e($contract->contractID); ?>";
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

        $('#tblcollect').dataTable({
            destroy:true,
           "fnFooterCallback": function ( nRow, aaData, iStart, iEnd, aiDisplay ) {
                /*
                 * Calculate the total market share for all browsers in this table (ie inc. outside
                 * the pagination)
                 */
                var iTotalMarket = 0;
                for ( var i=0 ; i<aaData.length ; i++ )
                {

                    iTotalMarket += parseFloat(aaData[i][2])*1 ;
                }

                /* Calculate the market share for browsers on this page */
                var iPageMarket = 0;
                for ( var i=iStart ; i<iEnd ; i++ )
                {
                    iPageMarket += parseFloat(aaData[ aiDisplay[i] ][2])*1;
                }

                /* Modify the footer row to match what we want */
                var nCells = nRow.getElementsByTagName('th');
                nCells[1].innerHTML = "Php "+" "+parseFloat(iPageMarket).toFixed(2)+" (Php "+parseFloat(iTotalMarket).toFixed(2)+" total)" ;
            }
        });
        });  
         
        });
 
});

$(document).on('click','#save', function(e){
    e.preventDefault();
    var _token = $("input[name='_token']").val();
    var contractID = "<?php echo e($contract->contractID); ?>";
    var dateFrom = "<?php echo e($collectionDetails); ?>";
    var dateTo = $('#dateTo').val();
             $.ajax({
              type: "POST",
              url: "/Collection",
              data: { 
                '_token' : $('input[name=_token]').val(),
                'contractID':contractID,
                'dateFrom': dateFrom,
                'dateTo': dateTo},
                success: function(data) {
                  if($.isEmptyObject(data.error)){
                    toastr.success(data.success);
                    window.location = '/ViewCollections/'+"<?php echo e($contract->contractID); ?>";
                  }else{
                    printErrorMsg(data.error);
                  }
                }

              });
             function printErrorMsg (msg) {
              $(".print-error-msg").find("ul").html('');
              $(".print-error-msg").css('display','block');
              $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
              });
            }
          });


    

       

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>