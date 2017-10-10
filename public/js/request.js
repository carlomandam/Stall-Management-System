var rList = $('#requestList').DataTable({
    'responsive': true,
    "searching": true,
    "paging": true,
    "info": true,
    "retrieve": true,
});
var desires =[]; 
$(document).on('change','#tenants',function(){
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
					$('.currentStall').append('<tr class="current" ><td><input type ="text" class ="form-control" value="'+value.stallID+'" readonly></td><td><select class="desire" name="desired" id="desired" style = "width:150px;"><option value ="">----/----</option> </select></td><td><input type ="hidden" name = "current" value="'+value.contractID+'"></td></tr>');

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
	var tenant = $("select[name='tenant']").val();
	var reason = $("textarea[name='transferReason']").val();
	var stallRequested=  [];
	$('.currentStall tr').each(function() {
		
		ind = $(this).index();
			var stalls ={
				"stallFrom" : $('input[name=current]').eq(ind).val(),
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
					// window.location.href="/Utilities";
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
$(document).on('change','#requestType',function(){
	id = $(this).val();
	if(id ==1){
		$('#transferStall').show();
		  $(document).ready(function() {
    	$('#tenants').select2({  });
  	});
	}
})