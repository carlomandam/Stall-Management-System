var rList = $('#requestList').DataTable({
    'responsive': true,
    "searching": true,
    "paging": true,
    "info": true,
    "retrieve": true,
});
$(document).on('click','#view', function(){
	id = $(this).attr('data-id');
	console.log(id);
	window.location.href="/Request/View/"+id;
})
$(document).on('click','#edit', function(){
	id = $(this).attr('data-id');
	console.log(id);
	window.location.href="/Request/Edit/"+id;
})
$(document).on('change','#requestType',function(){
	id = $(this).val();
	if(id ==1){
		$('#transferStall').show();
		$('#leaveStall').hide();
		$('#others').hide();
		  $(document).ready(function() {
    	$('#tenantTS').select2({  });
  	});
	}
	else if(id == 2){
		$('#transferStall').hide();
		$('#leaveStall').show();
		$('#others').hide();
		  $(document).ready(function() {
    	$('#tenantLS').select2({  });
  	});

	}
	else if(id == 3){
			$('#transferStall').hide();
		$('#leaveStall').hide();
		$('#others').show();
		  $(document).ready(function() {
    	$('#tenantO').select2({  });
  	});
	}
})
var desires =[]; 
$(document).on('change','#tenantTS',function(){
	desires =[]; 
	id = $(this).val();
	console.log(id);
	$('.current').remove();
	$.ajax({
		type: "GET",
		url: "/Request/Current/"+id,
			success: function(data) {
				$.each(data.current, function(key,value){
					console.log(value);
					$('.currentStallTS').append('<tr class="current" ><td><input type ="text" class ="form-control" value="'+value.stallID+'" readonly></td><td><select class="desire" name="desired" id="desired" style = "width:150px;"><option value ="">----/----</option> </select></td><td><input type ="hidden" name = "currentTS" value="'+value.contractID+'"></td></tr>');

				$.ajax({
					type: "GET",
					url: "/Request/Desire/"+id,
						success: function(data) {
							$.each(data.desire,function(key,value){
								$('.desire').append('<option value ="'+value.stallID+'">'+value.stallID+'</option>')
						
							})
							$('.desire').select2();
						}

					});
			
				})

				
			}

		});
})
$(document).on('change','#tenantLS',function(){
	id = $(this).val();
	console.log(id);
	$('.current').remove();
	$.ajax({
		type: "GET",
		url: "/Request/Current/"+id,
			success: function(data) {
				$.each(data.current, function(key,value){
					console.log(value);
					$('.currentStallLS').append('<tr class="current" ><td><input type ="text" class ="form-control" value="'+value.stallID+'" readonly></td><td><input  type="checkbox" name="chkStall" id="chkStall" value="'+value.contractID+'" ></td><td><input type ="hidden" name = "currentTSLS" value="'+value.contractID+'"></td></tr>');
				})

				
			}

		});
})
$(document).on('change','#desired',function(){
	var d =  $(this).val();
	var ind = $(this).index();
	
	if(desires.length == 0){
		desires.push(d);
		console.log("null");
	}
	else{
		for (i = 0; i < desires.length; i++) {
			if(d == desires[i]){
				
				console.log(desires[i]);
			}
			else{
				desires.push(d);
			}
		}	
	}

console.log(desires);	
})

$(document).on('click','#saveTransferStall',function(e){
	e.preventDefault();
	var requestType = $("select[name='requestType']").val();
	var tenant = $("select[name='tenantTS']").val();
	var reason = $("textarea[name='transferReasonTS']").val();
	var stallRequested=  [];
	$('.currentStallTS tr').each(function() {
		
		ind = $(this).index();
			var stalls ={
				"stallFrom" : $('input[name=currentTS]').eq(ind).val(),
	  			"stallTo" : $('select[name=desired]').eq(ind).val(),
  		}
  		
  			stallRequested.push(stalls);
	})
	console.log(requestType);
	console.log(tenant);
	console.log(stallRequested);
	console.log(reason);
		$.ajax({
			type: "PUT",
			url: "/Request/SaveTransferStall",
			data: { 
				'requestType': requestType,
				'tenant': tenant,
				'reason': reason,
				'status': 0,
				'stallRequested': stallRequested
				
			},
			success: function(data) {
				if($.isEmptyObject(data.error)){
					toastr.success('Request Save');
					window.location.href="/Requests";
				}else{
					// toastr.error(data.error);
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

})
$(document).on('click','#saveLeaveStall',function(e){
	e.preventDefault();
	var requestType = $("select[name='requestType']").val();
	var tenant = $("select[name='tenantLS']").val();
	var reason = $("textarea[name='transferReasonLS']").val();
	var stallRequested=  [];
	$("input[name='chkStall']:checked").each(function(i){
		stall = $(this).val();
		stallRequested.push(stall);
	})
	console.log(requestType);
	console.log(tenant);
	console.log(stallRequested);
	console.log(reason);
		$.ajax({
			type: "PUT",
			url: "/Request/SaveLeaveStall",
			data: { 
				'requestType': requestType,
				'tenant': tenant,
				'reason': reason,
				'status': 0,
				'stallRequested': stallRequested
				
			},
			success: function(data) {
				if($.isEmptyObject(data.error)){
					toastr.success('Request Save');
					window.location.href="/Requests";
				}else{
					// toastr.error(data.error);
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

})

$(document).on('click','#saveOther',function(e){
	e.preventDefault();
	var requestType = $("select[name='requestType']").val();
	var tenant = $("select[name='tenantO']").val();
	var subject = $("input[name='subject']").val();
	var reason = $("textarea[name='transferReasonO']").val();

	console.log(requestType);
	console.log(tenant);
	console.log(subject);
	console.log(reason);
		$.ajax({
			type: "PUT",
			url: "/Request/SaveOther",
			data: { 
				'requestType': requestType,
				'tenant': tenant,
				'reason': reason,
				'status': 0,
				'subject': subject
				
			},
			success: function(data) {
				if($.isEmptyObject(data.error)){
					toastr.success('Request Save');
					window.location.href="/Requests";
				}else{
					// toastr.error(data.error);
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

})
$(document).on('click','#update',function(e){
	e.preventDefault();
	id = $(this).attr('data-id');
	console.log(id);
	var status = $("select[name='status']").val();
	var remarks = $("textarea[name='remarks']").val();
	console.log(remarks);
				$.ajax({
			type: "PUT",
			url: "/Requests/"+id,
			data: { 
				'status': status,
				'remarks': remarks,
				
				
			},
			success: function(data) {
				if($.isEmptyObject(data.error)){
					toastr.success('Request Update');
					window.location.href="/Requests";
				}else{
					// toastr.error(data.error);
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



})

$(document).on('click','#delete',function(e){
e.preventDefault();
id = $(this).attr('data-id');

	$.ajax({
   			type: "DELETE",
   			url: "/Requests/"+id,
   			data: { 
   				'_token' : $('input[name=_token]').val(),},
   				success: function(data) {
   					if($.isEmptyObject(data.error)){
   						toastr.error('Record Deactivated');
   						location.reload();	           					}
   				}


   			});

})

