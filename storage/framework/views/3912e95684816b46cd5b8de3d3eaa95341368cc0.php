<?php $__env->startSection('title'); ?>
<?php echo e('Utilities'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-header'); ?>
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
    <li><i class="fa fa-cogs"></i>Utilities</li>
    <li class="active">Peak Days</li>
</ol> 
  <?php $__env->stopSection(); ?>

  <?php $__env->startSection('content'); ?>
 
   <div class="row">
    <!--left table-->

        <div class = "col-md-12">
          <div class="box box-primary ">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Utilities - Peak Days</b></h3>
            </div>
          
          <div class = "box-body">
              <div class = "col-md-12">
                  <div class="callout callout-info">
                        <h4>Set Peak Days based on the Market Days.</h4>
                         
                      
                  </div>
              </div>

              <div class="col-md-6">
                <table class="table table-hover">
                    <thead>
                        <tr>
                          
                        </tr>
                    </thead>
                    <tbody>


                        <tr id="mDays[0]" style="display: none;">
                            <td>
                              <input type="checkbox" id="pDays[0]" name="day" value="sun" disabled>
                            </td>
                            <td><b>Sunday</b></td>
                        </tr>
                        <tr id="mDays[1]" style="display: none;">
                            <td>
                              <input type="checkbox" id="pDays[1]" name="day" value="mon" disabled >
                            </td>
                            <td><b>Monday</b></td>
                        </tr>
                        <tr id="mDays[2]" style="display: none;">
                            <td>
                              <input type="checkbox" id="pDays[2]" name="day" value="tue" disabled >
                            </td>
                            <td><b>Tuesday</b></td>
                        </tr>
                        <tr id="mDays[3]" style="display: none;">
                            <td>
                              <input type="checkbox" id="pDays[3]" name="day"  value="wed"disabled >
                            </td>
                            <td><b>Wednesday</b></td>
                        </tr>
                        <tr id="mDays[4]" style="display: none;">
                            <td>
                              <input type="checkbox" id="pDays[4]" name="day"  value="thur"disabled>
                            </td>
                            <td><b>Thursday</b></td>
                        </tr>
                        <tr id="mDays[5]" style="display: none;">
                            <td>
                              <input type="checkbox" id="pDays[5]" name="day"  value="fri"disabled >
                            </td>
                            <td><b>Friday</b></td>
                        </tr>
                        <tr id="mDays[6]" style="display: none;">
                            <td>
                              <input type="checkbox" id="pDays[6]" name="day" value="sat"disabled >
                            </td>
                            <td><b>Saturday</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>

         
          </div>
        <div class = "box-footer">
        <div class = "pull-right" style="margin-right: 20px;">
          <button class = "btn btn-flat btn-info" id="edit">Edit</button>
          <button id="save"  class = "btn btn-flat btn-primary" data-id='util_peak_days' disabled>Save Changes</button>
        </div>
        </div>
        </div>
        </div>
        <!--box primary-->
  </div>

<!-- /.row -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
 $(document).ready(function() {
    $('tr').click(function(event) {
        if (event.target.type !== 'checkbox') {
            $(':checkbox', this).trigger('click');
        }
    });
}); 
 $(document).on('click','#edit', function(){
  document.getElementById('pDays[0]').disabled = false;
  document.getElementById('pDays[1]').disabled = false;
  document.getElementById('pDays[2]').disabled = false;
  document.getElementById('pDays[3]').disabled = false;
  document.getElementById('pDays[4]').disabled = false;
  document.getElementById('pDays[5]').disabled = false;
  document.getElementById('pDays[6]').disabled = false;
  document.getElementById('save').disabled = false;
}); 
 var marketD = [];//variable ng market days
 <?php $__currentLoopData = $utils; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $util): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php $__currentLoopData = explode(',', $util->utilitiesDesc); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $days): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       marketD.push('<?php echo e($days); ?>');
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  // console.log(marketD);

var peakD = [];//variable ng peak days
 <?php $__currentLoopData = $peaks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $peak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php $__currentLoopData = explode(',', $peak->utilitiesDesc); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $days): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       peakD.push('<?php echo e($days); ?>');
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  console.log(peakD);
  var  tempdays = [];
  for (var i = 0; i < 7; i++) {
      $("input[name='day']").each(function (i) {
                tempdays[i] = $(this).val();

      });
  }

    for (var i = 0; i < 7; i++) {
          for (var j = 0; j < peakD.length+1; j++) {
              if(tempdays[i]==peakD[j]){
                  if(i==0){
                      document.getElementById('pDays[0]').checked = true;
                  }
                  else if(i==1){
                    document.getElementById('pDays[1]').checked = true;
                  }
                  else if(i==2){
                    document.getElementById('pDays[2]').checked = true;
                  }
                  else if(i==3){
                    document.getElementById('pDays[3]').checked = true;
                  }
                  else if(i==4){
                    document.getElementById('pDays[4]').checked = true;
                  }
                  else if(i==5){
                    document.getElementById('pDays[5]').checked = true;
                  }
                  else if(i==6){
                    document.getElementById('pDays[6]').checked = true;
                  }
              }
          }
  }

 for (var j = 0; j < marketD.length; j++) {
             
                  if((marketD[j])=='sun'){
                      document.getElementById('mDays[0]').style.display = "block";
                     
                  }
                  else if(marketD[j]=='mon'){
                    document.getElementById('mDays[1]').style.display = "block";
                  }
                  else if(marketD[j]=='tue'){
                    document.getElementById('mDays[2]').style.display = "block";
                  }
                  else if(marketD[j]=='wed'){
                    document.getElementById('mDays[3]').style.display = "block";
                  }
                  else if(marketD[j]=='thur'){
                    document.getElementById('mDays[4]').style.display = "block";
                  }
                  else if(marketD[j]=='fri'){
                    document.getElementById('mDays[5]').style.display = "block";
                  }
                  else if(marketD[j]=='sat'){
                    document.getElementById('mDays[6]').style.display = "block";
                  }
              
          }

$(document).on('click','#save',function(){

  id = $(this).attr('data-id');
  console.log(id);
  var days = [];  
  for (var i = 0; i < 7; i++) {
      $("input[name='day']:checked").each(function (i) {
                days[i] = $(this).val();
      });
  }

  marketDays = days.toString();
  
  console.log(marketDays);
  $.ajax({
      type: "PUT",
      url: "/PeakDays/"+id,
      data: { 
        '_token' : $('input[name=_token]').val(),
        'days': marketDays,
      },
      success: function(data) {
        if($.isEmptyObject(data.error)){
          toastr.success('Peak Days Updated');
                location.reload();
                
                }
                else{
                  toastr.error(data.error);
                }
        }


     });
});          
</script>

<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>