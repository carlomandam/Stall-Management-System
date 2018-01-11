 <?php $__env->startSection('title'); ?> <?php echo e('Queries'); ?> <?php $__env->stopSection(); ?> <?php $__env->startSection('content-header'); ?>
<?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>
<style>
    .dropdown-toggle,.dropdown-menu{
        width: 250px;
        text-align: center;
    }
    .label{
        font-size: 12px;
    }
    #contracts,#electric,#terminated{
        display:none;
    }
    #queryName{
        font-size: 25px;
        color: black;
        font-family: sans-serif;
    }
</style>


<div class="box box-primary">
    <div class="box-header with-border">
        <label class = "box-header-label"> 
        <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Choose Queries
              <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li><a href="" onclick="event.preventDefault(); loadExpiring();">List of Current Contracts</a></li>
                 <li><a href="" onclick="event.preventDefault(); loadExpired();">List of Expired Contracts</a></li>
                  <li><a href="" onclick="event.preventDefault(); loadTerminated();">List of Terminated Contracts</a></li>
                <li><a href="" onclick="event.preventDefault(); loadElectric();">Highest Electric Consumption</a></li>
                <li><a href="" onclick="event.preventDefault(); loadWater();">Highest Water Consumption</a></li>
              </ul>
        </div>
        </label>
    </div>
    <div>

        <div class="box-body">
        <div class = "box-title box-primary">
            <h4 id = "queryName" style="text-align: center;"></h4>
        </div>
            <div class="col-xs-12">
                    <div class="table-responsive" id = "contracts">
                        <table id="tblcontract" class="table table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th>Stall Code</th>
                                        <th>Tenant Name</th>
                                        <th>Contract Start Date</th>
                                        <th>Contract Expiry Date</th>
                                    </tr>
                                </thead>
                        </table>
                    </div>      
            </div>

            <div class="col-xs-12">
                    <div class="table-responsive" id = "terminated">
                        <table id="tblterminated" class="table table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th>Stall Code</th>
                                        <th>Tenant Name</th>
                                        <th>Contract Start Date</th>
                                        <th>Contract Terminated Date</th>
                                        <th>Reason/s</th>
                                    </tr>
                                </thead>
                        </table>
                    </div>      
            </div>

             <div class="col-xs-12">
                    <div class="table-responsive" id = "electric">
                        <table id="tblelectric" class="table table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th>Reading Date</th>
                                        <th>Stall Code</th>
                                        <th>Consumption</th>
                                    </tr>
                                </thead>
                        </table>
                    </div>      
            </div>
        </div>
    </div>
</div>

    



 <?php $__env->stopSection(); ?> <?php $__env->startSection('script'); ?>

<script type="text/javascript">
    $(document).ready(function(){
    
      $('#tblcontract').DataTable();
      $('#tblelectric').DataTable();
      $('#tblterminated').DataTable();

    

    });
    function loadExpired(){
        
        $('#electric').hide();
        $('#terminated').hide();
        $('#contracts').fadeIn();
        $('#queryName').text("List of Expired Contracts");
        
          $.get('/ExpiredContracts', function(data){
                var table = $('#tblcontract').DataTable().clear().draw();
                console.log(data);
                $.each(data, function(i,data){
                    table.row.add([
                        data.stallID,
                        data.tenantName,
                        data.contractStart,
                        data.contractEnd
                        
                        
                        ]).draw();
                });
               
              //  $('#tblcontract tbody').empty();
            });
    }
    function loadExpiring(){
        $('#electric').hide();
        $('#terminated').hide();
        $('#contracts').fadeIn();
        $('#queryName').text("List of Current Contracts");
          
          $.get('/ExpiringContracts', function(data){
                var table = $('#tblcontract').DataTable().clear().draw();
                console.log(data);
                $.each(data, function(i,data){
                    table.row.add([
                        data.stallID,
                        data.tenantName,
                        data.contractStart,
                        data.contractEnd + " &nbsp &nbsp &nbsp <label> <span class = 'label label-warning'>will expire in "+ data.days +" days</span></label>" + " <a id = 'btnGenerate' data-id = '"+data.stallID+"' class='btn btn-success' onclick = 'clickButton();'><span class='fa fa-print'></span>Print Notice</a>"    
                        
                        
                        ]).draw();
                });
    
            });
          
    }
    function loadTerminated(){
        $('#electric').hide();
        $('#contracts').hide();
        $('#terminated').fadeIn();
        
        $('#queryName').text("List of Terminated Contracts");
          var table = $('#tblterminated').DataTable().clear().draw();
          $.get('/TerminatedContracts', function(data){
              
                console.log(data);
                $.each(data, function(i,data){
                    table.row.add([
                        data.stallID,
                        data.tenantName,
                        data.contractStart,
                       data.contractEnd,
                       "<label> <span class ='label label-danger'>"+data.reasons
                        + "</span></label>"
                        ]).draw();
                });
    
            });
      
    }


      function loadElectric(){
         $('#queryName').text("Highest Electric Consumption");
        $('#contracts').hide();
           $('#terminated').hide();
        
        $('#electric').fadeIn();

          $.get('/ElectricConsumption', function(data){
                var table = $('#tblelectric').DataTable().clear().draw();
                console.log(data);
                $.each(data, function(i,data){
                    table.row.add([
                        data.reading,
                        data.stallCode,
                         "Total Electric Consumption( "+ data.totalRead +" )"
                        
                        
                        ]).draw();
                });
            });
    }

    function loadWater(){
        $('#queryName').text("Highest Water Consumption");
        $('#contracts').hide();
        $('#terminated').hide();
        
        $('#electric').fadeIn();

          $.get('/WaterConsumption', function(data){
                var table = $('#tblelectric').DataTable().clear().draw();

                console.log(data);
                $.each(data, function(i,data){
                    table.row.add([
                        data.reading,
                        data.stallCode,
                        " Total Water Consumption( "+ data.totalRead +" )"
                        
                        
                        ]).draw();
                });
            });

    }
function clickButton()
{
    var  id = $("#btnGenerate").attr('data-id');
    window.location.href="/printNotice/"+id;

}
    
 

    
</script> <?php $__env->stopSection(); ?> 
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>