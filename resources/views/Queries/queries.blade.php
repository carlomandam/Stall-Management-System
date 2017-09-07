@extends('layout.app') @section('title') {{ 'Queries'}} @stop @section('content-header')
@stop @section('content')
<style>
    .dropdown-toggle,.dropdown-menu{
        width: 250px;
        text-align: center;
    }
</style>


<div class="box box-primary">
    <div class="box-header with-border">
        <label class = "box-header-label"> 
        <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Choose Query
              <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li><a href="">List of Current Contracts</a></li>
                <li><a href="">List of Expiring Contracts</a></li>
              </ul>
        </div>
        </label>
    </div>
    <div>

        <div class="box-body">

            <div class="col-xs-12">
                        <div class="table-responsive">
                            <table id="tblstall" class="table table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Stall ID</th>
                                        <th style="width: 100px;">Stall Holder Name</th>
                                        <th>Contract Expiry Date</th>
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
      \
      $.get('/ActiveContracts', function(data){
                var table = $('#tblstall').DataTable().clear();
                console.log(data);
                $.each(data, function(i,data){
                    table.row.add([
                        data.stallID,
                        data.stypeName + "("+ data.stypeArea +"m<sup>2</sup>)",
                        "Floor "+data.floorID + "," + data.bldgName,
                        (data.stallStatus == '1' ? "<label class = 'label label-success'>Available</label>" : (data.stallStatus == '2' ? 'Occupied' : 'Under Maintenance')),
                        (data.stallRemarks == null ? 'No Remarks Available' : data.stallRemarks),
                        "<button type='Submit' onclick='window.location="+'"'+"{{ url('/Registration/"+this.value+"') }}"+'"'+"' class='btn btn-flat btn-success' value = '"+data.stallID+"'><span class = 'fa fa-angle-double-right'></span>&nbspRegister</button> <button type='Submit' class='btn btn-flat btn-primary'data-toggle='modal' data-target='#view'><span class = 'fa fa-eye'></span>&nbspView</button> <button type='Submit' class='btn btn-flat btn-primary' data-toggle='modal' data-target='#update'><span class = 'fa fa-pencil'></span>&nbspUpdate</button>"
                        
                        ]).draw();
                });
            });

    });
    
</script> @stop 