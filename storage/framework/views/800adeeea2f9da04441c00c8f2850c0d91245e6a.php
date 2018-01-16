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
    <li class="active">Collection Status</li>
</ol> 
  <?php $__env->stopSection(); ?>

  <?php $__env->startSection('content'); ?>
 
   <div class="row">
    <!--left table-->

        <div class = "col-md-12">
          <div class="box box-primary ">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Utilities - Collection Status</b></h3>
            </div>
          
          <div class = "box-body">

            <div class = "col-md-12">
              <div class="callout callout-info">
                  <h4>Set Collection Status</h4>
                   
              </div>
            </div>

            <div class="col-md-8">
              <table class="table table-strippedr">
                  <thead>
                    <tr>
                      <th>Description</th>
                      <th>Range From:</th>
                      <th>Range To:</th>
                    </tr>
                  </thead>
                  <tbody>
                  <form>
                      <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">

                    <tr class="bg-primary">
                      <td>Collect</td>
                      <td><input type="text" name="collectFrom" class="form-control collectTo" readonly></td>
                      <td>
                        <input type="text" name="name_collect" class="form-control collectFrom"  id="id_collect" disabled>
                      </td>
                    </tr>

                    <tr style="background-color: green;">
                      <td style="color: white;">Reminder</td>
                      <td><input type="text" name="" class="form-control reminderFrom" readonly></td>
                      <td> <input type="text" name="name_reminder" class="form-control reminderTo" id="id_reminder" disabled></td>
                    </tr>

                    <tr style="background-color: yellow;">
                      <td>Warning</td>
                      <td><input type="text" name="" class="form-control warningFrom" readonly></td>
                      <td> <input type="text" name="name_warning" class="form-control warningTo" id="id_warning" disabled></td>
                    </tr>

                    <tr style="background-color: orange;">
                      <td style="color: white;">Lock</td>
                      <td><input type="text" name="" class="form-control lockFrom" readonly></td>
                      <td> <input type="text" name="name_lock" class="form-control lockTo" id="id_lock" disabled></td>
                    </tr>

                    <tr style="background-color: red;">
                      <td style="color: white;">Terminate</td>
                      <td><input type="text" name="" class="form-control terminateFrom" readonly></td>
                      <td> <input type="text" name="name_terminate" class="form-control terminateTo" value="<?php echo e($init); ?>" id="id_terminate" disabled></td>
                    </tr>

                </form>
                  </tbody>
              </table>
            </div>

            
          </div>
        <div class = "box-footer">
        <div class = "pull-right" style="margin-right: 20px;">
          <button class = "btn btn-flat btn-info" id="edit">Edit</button>
          <button id="save"  class = "btn btn-flat btn-primary" data-id='util_collection_status' disabled>Save Changes</button>
        </div>
        </div>
        </div>
        </div>
        <!--box primary-->
  </div>

<!-- /.row -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript" src ="<?php echo e(URL::asset('js/jquery.inputmask.bundle.js')); ?>"></script>
<script type="text/javascript">
<?php $__currentLoopData = $utils; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $util): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
$('#id_collect').val('<?php echo e($util->collect); ?>');
$('.reminderFrom').val('<?php echo e($util->collect); ?>+.01');

$('#id_reminder').val('<?php echo e($util->reminder); ?>');
$('.warningFrom').val('<?php echo e($util->reminder); ?>+.01');

$('#id_warning').val('<?php echo e($util->warning); ?>');
$('.lockFrom').val('<?php echo e($util->warning); ?>+.01');

$('#id_lock').val('<?php echo e($util->lock); ?>');
$('.terminateFrom').val('<?php echo e($util->lock); ?>+.01')
$('.terminateTo').val('<?php echo e($util->terminate); ?>')

// $('#id_terminate').val('<?php echo e($util->terminate); ?>');

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

$(document).on('click', '#edit', function(){
  document.getElementById('id_collect').disabled =false;
  document.getElementById('id_reminder').disabled =false;
  document.getElementById('id_warning').disabled =false;
  document.getElementById('id_lock').disabled =false;
  document.getElementById('id_terminate').disabled =false;
  document.getElementById('save').disabled =false;
})

 $(".collectTo").inputmask('currency', {
  rightAlign: true,
  prefix: 'Php ',
});
 $(".collectFrom").inputmask('currency', {
  rightAlign: true,
  prefix: 'Php '
});
  $(".reminderTo").inputmask('currency', {
  rightAlign: true,
  prefix: 'Php '
});
 $(".reminderFrom").inputmask('currency', {
  rightAlign: true,
  prefix: 'Php '
}); 
  $(".warningTo").inputmask('currency', {
  rightAlign: true,
  prefix: 'Php '
});
 $(".warningFrom").inputmask('currency', {
  rightAlign: true,
  prefix: 'Php '
});  
 $(".lockTo").inputmask('currency', {
  rightAlign: true,
  prefix: 'Php '
});
 $(".lockFrom").inputmask('currency', {
  rightAlign: true,
  prefix: 'Php '
});   
 $(".terminateTo").inputmask('currency', {
  rightAlign: true,
  prefix: 'Php '
});
 $(".terminateFrom").inputmask('currency', {
  rightAlign: true,
  prefix: 'Php '
});




$(document).on('click','#save', function(){
id= $(this).attr('data-id');
console.log(id);
var _token = $("input[name='_token']").val();
var tempCollect = $("input[name='name_collect']").val().replace("Php ", "",);
var tempReminder = $("input[name='name_reminder']").val().replace("Php ", "",);
var tempWarning = $("input[name='name_warning']").val().replace("Php ", "",);
var tempLock = $("input[name='name_lock']").val().replace("Php ", "",);
var tempTerminate= $("input[name='name_terminate']").val().replace("Php ", "",);

temp1 = tempCollect.replace(",", "",);
temp2 = tempReminder.replace(",", "",);
temp3 = tempWarning.replace(",", "",);
temp4 = tempLock.replace(",", "",);
temp5 = tempTerminate.replace(",", "",);

name_collect = Number(temp1);
name_reminder = Number(temp2);
name_warning = Number(temp3);
name_lock = Number(temp4);
name_terminate = Number(temp5);

if(name_collect>0 && name_collect < name_reminder && name_reminder < name_warning && name_warning < name_lock && name_lock <name_terminate ){
   $.ajax({
  type: "PUT",
  url: "/CollectionStatus/"+id,
  data: { 
    '_token' : $('input[name=_token]').val(),
      'name_collect': name_collect,
      'name_reminder': name_reminder,
      'name_warning': name_warning,
      'name_lock': name_lock,
      'name_terminate':name_terminate
   
  },
  success: function(data) {
    if($.isEmptyObject(data.error)){
      toastr.success('Collection Status Updated');
            location.reload();
            
            }
            else{
              toastr.error(data.error);
            }
    }


 }); 
}
else{
  toastr.error('INPUT NOT VALID');
}


})


var collect; 
var reminder;
var warning;
var lock;
var terminate;

$("#id_collect").bind("change paste keydown keyup click", function() {
      tempCollect = ($(this).val()).replace("Php ", "",);
      temp2 = tempCollect.replace(",", "",);
      collect = Number(temp2);
      $('.reminderFrom').val(Math.abs(collect)+.01);

});


$("#id_reminder").bind("change paste keyup keydown click", function() {
      tempreminder = ($(this).val()).replace("Php ", "",);
      temp2 = tempreminder.replace(",", "",);
      reminder = Number(temp2);
      $('.warningFrom').val(Math.abs(reminder)+.01);

});


$("#id_warning").bind("change paste keydown keyup click", function() {
    tempwarning = ($(this).val()).replace("Php ", "",);
    temp2 = tempwarning.replace(",", "",);
    warning = Number(temp2);
    $('.lockFrom').val(Math.abs(warning)+.01);
});


$("#id_lock").bind("change paste keydown keyup click", function() {
    templock = ($(this).val()).replace("Php ", "",);
    temp2 = templock.replace(",", "",);
    lock = Number(temp2);
    $('.terminateFrom').val(Math.abs(lock)+.01);
  
});




 $("#id_terminate").bind("change paste keydown keyup click", function() {
  tempterminate = ($(this).val()).replace("Php ", "",);

  temp2 = tempterminate.replace(",", "",);
   terminate = Number(temp2);
  // $('.terminateFrom').val(Math.abs(lock)+.01);

 
  });
</script>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>