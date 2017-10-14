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
	var vname = $("input[name='newReqName']").val();
	var vdesc = $("input[name='newReqDesc']").val();
	var name = $.trim(vname);
	var desc = $.trim(vdesc);

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
					toastr.error(data.error);
				}
			}

		});

});


$(document).on('click','#updateModal',function(e){
   $('#update').modal('show');
   id = $(this).attr('data-id');
   $('.print-error-msg2').hide();
   e.preventDefault();
   	$.ajax({
		type: "GET",
		url: "/requirements/show/"+id,
		success: function(data)	{	
	           $("#uname").val(data.req.reqName);
	           $("#udesc").val(data.req.reqDesc);
	           $("#hName").val(data.req.reqName);
	           $("#hDesc").val(data.req.reqDesc);
	           $('#hID').val(data.req.reqID);

		}
	});

})


$(document).on('click','#uSaveReq', function(e){
	e.preventDefault();
	var _token = $("input[name='_token']").val();
	var name = $("input[name='editReqName']").val();
	var desc = $("input[name='editReqDesc']").val();
	var dName = $("input[name='dName']").val();
	var dDesc = $("input[name='dDesc']").val();
	var dID = $("input[name='dID']").val();
	var tempName = $.trim(name);
	var tempDesc = $.trim(desc);

	if((tempDesc==dDesc)&&(tempName==dName))
	{
		$('#update').modal('hide');
		console.log('pasoksa hide');
	}

	else if( (tempDesc!=dDesc)||(tempName!=dName)  )
		{	console.log('pasok ditoooo');
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
						toastr.success('REcord Updated', function(){
							location.reload();
						});			           	
			           	
			           	}
			           	else{
			           		toastr.error(data.error);
			           	}
			    }


			 });
		}
})
$(document).on('click', '#del', function(e){
	id = $(this).attr('data-id');
	console.log(id);
	
	$.ajax({
   			type: "DELETE",
   			url: "/requirements/"+id,
   			data: { 
   				'_token' : $('input[name=_token]').val(),},
   				success: function(data) {
   					if($.isEmptyObject(data.error)){
   						toastr.error('Record Deactivated');
   						location.reload();	           					}
   				}


   			});
})


$(document).on('click', '#act', function(e){
	id = $(this).attr('data-id');
	console.log(id);
	
	$.ajax({
   			type: "PUT",
   			url: "/requirements/restore/"+id,
   			data: { 
   				'_token' : $('input[name=_token]').val(),},
   				success: function(data) {
   					if($.isEmptyObject(data.error)){
   						toastr.success('Record Reactivated');
   						location.reload();	           					}
   				}


   			});
})

	   

 