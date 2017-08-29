$('#mEquip').addClass('active');
var eList = $('#equipList').DataTable({
    'responsive': true,
    "searching": true,
    "paging": true,
    "info": true,
    "retrieve": true,
});

function validate(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode( key );
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}

$("#newSave").click(function(e){
	e.preventDefault();
	var _token = $("input[name='_token']").val();
	var name = $("input[name='newEquipment']").val();
	var rate = $("input[name='newRate']").val();
	var limit = $("input[name='newLimit']").val();

	$.ajax({
		type: "POST",
		url: "/equipment",
		data: { 
			'_token' : $('input[name=_token]').val(),
			'newEquipment': name,
			'newRate': rate,
			'newLimit': limit
			},
			success: function(data) {

				if($.isEmptyObject(data.error)){
					toastr.success('Added New Equipment');
					location.reload();
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

$(document).on('click','#updateModal',function(e){
   $('#update').modal('show');
   id = $(this).attr('data-id');
   $('.print-error-msg2').hide();
   e.preventDefault();
   	
   	$.ajax({
		type: "GET",
		url: "/equipment/show/"+id,
		success: function(data)	{
				console.log(data);	
	           $("#uName").val(data.equip.equipmentName);
	           $("#uRate").val((data.equip.rentDailyRate));
	           $("#uLimit").val(data.equip.equipStallLimit);
	           	dID = data.equip.equipmentID;
	           $(document).on('click','#uSave', function(e){
	           	e.preventDefault();
	           	var _token = $("input[name='_token']").val();
				var name = $("input[name='uEquipment']").val();
				var rate = $("input[name='uRate']").val();
				var limit = $("input[name='uLimit']").val();
	           		$.ajax({
	           			type: "PUT",
	           			url: "/equipment/"+dID,
	           			data: { 
	           				'_token' : $('input[name=_token]').val(),
	           				'uEquipment': name,
	           				'uRate': rate,
	           				'uLimit': limit
	           			},
	           				success: function(data) {
	           					if($.isEmptyObject(data.error)){
	          						toastr.success('Equipment Updated');
	           						location.reload();
	           					}else{
	           						printErrorMsg(data.error);
	           					}
	           				}


	           			});
			           		function printErrorMsg (msg) {
			           			$(".print-error-msg2").find("ul").html('');
			           			$(".print-error-msg2").css('display','block');
			           			$.each( msg, function( key, value ) {
			           				$(".print-error-msg2").find("ul").append('<li class= "uerror">'+value+'</li>');
			           			});
	           		}

	           		
	           

	           })
          
		}
	});

})


