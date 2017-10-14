@extends('layout.app') @section('title') {{ 'Queries'}} @stop @section('content-header')
@stop @section('content')
<style>
    .dropdown-toggle,.dropdown-menu{
        width: 250px;
        text-align: center;
    }
    .label{
        font-size: 12px;
    }
    #contracts,#tenants{
        display:none;
    }
</style>


<div class="box box-primary">
    <div class="box-header with-border">
        <label class = "box-header-label"> 
        <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Choose Queries
              <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li><a href="" onclick="event.preventDefault(); loadExpiring();">List of Expiring Contracts</a></li>
                <li><a href="" onclick="event.preventDefault(); loadTenants();">List of Deliquent Tenants</a></li>
              </ul>
        </div>
        </label>
    </div>
    <div>

        <div class="box-body">

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
                    <div class="table-responsive" id = "tenants">
                        <table id="tbltenants" class="table table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th>Tenant Name</th>
                                        <th>Stall Code/s</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                        </table>
                    </div>      
            </div>
        </div>
    </div>
</div>

    



 @stop @section('script')

<script type="text/javascript">
    $(document).ready(function(){
    
      $('#tblcontract').DataTable();
      $('#tbltenants').DataTable();

    

    });

    function loadExpiring(){
        $('#tenants').hide();
        $('#contracts').fadeIn();
          $.get('/ExpiringContracts', function(data){
                var table = $('#tblcontract').DataTable().clear();
                console.log(data);
                $.each(data, function(i,data){
                    table.row.add([
                        data.stallID,
                        data.tenantName,
                        data.contractStart,
                        data.contractEnd + " &nbsp &nbsp &nbsp <label> <span class = 'label label-warning'>will expire in "+ data.days +" days</span></label>"
                        
                        
                        ]).draw();
                });
            });
    }

      function loadTenants(){

        $('#contracts').hide();
        $('#tenants').fadeIn();
          $.get('/ExpiringContracts', function(data){
                var table = $('#tblcontract').DataTable().clear();
                console.log(data);
                $.each(data, function(i,data){
                    table.row.add([
                        data.stallID,
                        data.tenantName,
                        data.contractStart,
                        data.contractEnd + " &nbsp &nbsp &nbsp <label> <span class = 'label label-warning'>will expire in "+ data.days +" days</span></label>"
                        
                        
                        ]).draw();
                });
            });
    }
    
</script> @stop 