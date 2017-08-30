$('#mStocks').addClass('active');
var sList = $('#stocksList').DataTable({
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

$(document).on('click','#addModal',function(e){
$('#add').modal('show');
id = $(this).attr('data-id');
e.preventDefault();
	$.ajax({
		type: "GET",
		url: "/stocks/show/"+id,
		success: function(data)	{
				console.log(data);	
	           $("#Name").val(data.equip.equipmentName);
	           $("#Rate").val((data.equip.rentDailyRate));
	           $("#Limit").val(data.equip.equipStallLimit);
	           dID = data.equip.equipmentID;
	           status =1;

	           $(document).on('click','#addSave', function(e){
	           	e.preventDefault();
	           	var _token = $("input[name='_token']").val();
				var quantity = $("input[name='quantity']").val();
	           		$.ajax({
	           			type: "POST",
	           			url: "/stocks/",
	           			data: { 
	           				'_token' : $('input[name=_token]').val(),
	           				'quantity': quantity,
	           				'eqID':dID,
	           				'status':status
	           			
	           			},
	           				success: function(data) {
	           					if($.isEmptyObject(data.error)){
	          						toastr.success('Stock Added');
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