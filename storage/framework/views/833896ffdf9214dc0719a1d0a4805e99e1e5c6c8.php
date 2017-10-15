<?php $__env->startSection('content-header'); ?>

<h1>List of Stalls</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List of Stalls</li>
      </ol>
  <?php $__env->stopSection(); ?>

  <?php $__env->startSection('content'); ?>
      <div class="box box-primary">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class = "table-responsive">
              <table id="tblstalls" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Stall No.</th>
                  <th>Stall Location</th>
                  <th>Stall Type</th>
                  <th>Stall Meter No</th>
                  <th>Status</th>
                  <th>Action</th>

                </tr>
                </thead>
                <tbody>
                
                </tbody>
              </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


  <?php $__env->stopSection(); ?>

  <?php $__env->startSection('script'); ?>
    <script>

    var obj;
     $(document).ready(function () {
       
     function getInfo(id) {

            $.ajax({
                type: "POST"
                , url: '/getVendorInfo'
                , data: {
                    "_token": "<?php echo e(csrf_token()); ?>"
                    , "id": id
                }
                , success: function (data) {
                    obj = JSON.parse(data)[0];
                  
                 $('modal').appendTo("body"); 
                    $(".modal").on('shown.bs.modal', function () {
                    $leftval = "SH-" + 2017;
                    $stallholderno = $leftval + String("00000" + obj.venID).slice(-5);
                    $('#vendor_no').val($stallholderno);
                    $('#update').find('input[name=orgname]').val(obj.venOrgName);
                    $('#update').find('input[name=fname]').val(obj.venFName);
                    $('#update').find('input[name=mname]').val(obj.venMName);
                    $('#update').find('input[name=lname]').val(obj.venLName);
                    if(obj.venSex==1)
                    {
                    $('#update').find('input[name=sex][value = 1]').attr('checked', true);}
                    else{
                       $('#update').find('input[name=sex][value = 0]').attr('checked', true);
                    }
                    $('#update').find('input[name = email]').val(obj.venEmail);
                    $('#update').find('input[name = mob]').val(obj.venContact);
                    var bday = obj.venBDay;
                   
                    $splitDate = bday.split("-");
                    $('#DOBYear').val($splitDate[0]).attr('selected',true).siblings('option').removeAttr('selected');
                  //  $('#DOBYear').selectmenu('refresh',true);
                    $('#DOBMonth').val($splitDate[1]).attr('selected',true).siblings('option').removeAttr('selected');
                    $('#DOBDay').val($splitDate[2]).attr('selected',true).siblings('option').removeAttr('selected');

                    $('#address').val(obj.venAddress);
                
                 
            });
                }



            });
                       
        }
     
     });
 

        //POPULATE DATATABLE//
 $('#tblstalls').DataTable({
            ajax: '/getStalls'
            , responsive: true

            , "columns": [
                 {
                    "data" : "stallID"
                    }
                    , 
                    {
                      "data" : function(data, type, dataToSet){
                            return (data.Stall.floor.floorNo +", "+data.Stall.building.bldgName);
                        }
                    },
                    {
                      "data" : function(data, type, dataToSet){
                            return (data.Stall.stall_type.stypeName);
                        }
                    },
                    {
                      "data": function(data, type, dataToSet){
                            return (data.Stall.stall_util.meterID);
                        }
                    },
                    {
                        "data":  function(data, type, dataToSet){
                            var status;
                            if(data.stallStatus == 1)
                            {
                            status = "Available";}
                            else
                            {
                                status = "Not Available";
                            }
                            return status;

                        }

                    },
                    {
                    "data": "actions"
                    }
            ]
            , "columnDefs": [
                {
                    "width": "30%"
                    , "searchable": false
                    , "sortable": false
                    , "targets": 5
                    }
  ]
        });


</script>

  <?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>