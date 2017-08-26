var rList = $('#reqList').DataTable({
    'responsive': true,
    "searching": true,
    "paging": true,
    "info": true,
    "retrieve": true,
});
$('#mReq').addClass('active');


$("#saveReq").click(function(e){
	e.preventDefault();
	var _token = $("input[name='_token']").val();
	var name = $("input[name='newReqName']").val();
	var desc = $("input[name='newReqDesc']").val();

	$.ajax({
		type: "POST",
		url: "/requirements",
		data: { 
			'_token' : $('input[name=_token]').val(),
			'newReqName': name,
			'newReqDesc': desc},
			success: function(data) {
				if($.isEmptyObject(data.error)){
					toastr.success('Added New requirements');
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
   dName =null;
   dDesc =null;
   e.preventDefault();
   	
   	$.ajax({
		type: "GET",
		url: "/requirements/show/"+id,
		success: function(data)	{	
	           $("#uname").val(data.req.reqName);
	           $("#udesc").val(data.req.reqDesc);
	            dName = data.req.reqName;
	           	dDesc = data.req.reqDesc;
	           	dID = data.req.reqID;
	           $(document).on('click','#uSaveReq', function(e){
	           	e.preventDefault();
	           	var _token = $("input[name='_token']").val();
	           	var name = $("input[name='editReqName']").val();
	           	var desc = $("input[name='editReqDesc']").val();
	          
	          
	           	var tempName = $.trim(name);
	           	var tempDesc = $.trim(desc);
	           	console.log(tempDesc);
	           	console.log(tempName);
	           	if(( tempDesc==dDesc )&&( tempName==dName ))
	           	{

	           		 $('#update').modal('hide');
	           		 console.log('pasoksa hide');
	           		 
	           	}
	           	else{

	           		$.ajax({
	           			type: "PUT",
	           			url: "/requirements/"+dID,
	           			data: { 
	           				'_token' : $('input[name=_token]').val(),
	           				'editReqName': name,
	           				'editReqDesc': desc,
	           			},
	           				success: function(data) {
	           					if($.isEmptyObject(data.error)){
	           						alert(data.success);
	           						rList.ajax.reload();
	           						// $("#reqList").DataTable.ajax.reload();
	           						// location.reload();
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

	           		
	           	}
	           })
          
		}
	});

})

$(document).on('click', '#del', function(e){
	id = $(this).attr('data-id');
	
	$.ajax({
	           			type: "DELETE",
	           			url: "/requirements/"+id,
	           			data: { 
	           				'_token' : $('input[name=_token]').val(),},
	           				success: function(data) {
	           					if($.isEmptyObject(data.error)){
	           						alert(data.success);
	           						location.reload();	           					}
	           				}


	           			});
})


// $(document).on('click', '#archive', function(){


	
// })

	   

 