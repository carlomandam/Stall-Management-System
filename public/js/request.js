var rList = $('#requestList').DataTable({
    'responsive': true,
    "searching": true,
    "paging": true,
    "info": true,
    "retrieve": true,
});

$(document).on('click', '#updateModal', function(e){
	id = $(this).attr('data-id');
	$('#update').modal('show');
	e.preventDefault();
	$.ajax({
		type: "GET",
		url: "/requestList/show/"+id,
	success: function(data) {
		console.log(data);
			$('#uRequestID').val(data.req.requestID);
			if ((data.req.status)==0){
					$('#uStatus').val('Pending');	
			}
			else if((data.req.status)==1)
			{
				$('#uStatus').val('Approved');
			}
			else if((data.req.status)==2)
			{
				$('#uStatus').val('Reject');
			}
			
			$('#uStallHolder').val(data.req.rental.stall_holder.stallHFName+' '+data.req.rental.stall_holder.stallHMName+' '+data.req.rental.stall_holder.stallHLName);
			$('#rental').val(data.req.rental.stallRentalID);

			if((data.req.requestType)==1)
			{
				$('#uType').val('Transfer Stall');
				$('#typeTransfer').show();
				$('#typeCancel').hide();
				$('#typeOther').hide();
				$('#from').val(data.req.rental.stallID);
				$('#to').val(data.req.request_info.stallRequested);
			}
			else if ((data.req.requestType)==2)
			{
				$('#uType').val('Cancel Contract');
				$('#typeCancel').show();
				$('#typeTransfer').hide();
				$('#typeOther').hide();
				$('#cancel').val(data.req.rental.stallID);
			} 
				else if ((data.req.requestType)==3)
			{
				$('#uType').val('Others');
				$('#typeOther').show();
				$('#typeTransfer').hide();
				$('#typeCancel').hide();
				$('#other').val(data.req.rental.stallID);
			}
			$('#uDesc').val(data.req.requestText);
			$('#udStatus').val(data.req.status);

			

		          					
		}


			});

})
$(document).on('click', '#save',function(e){
		e.preventDefault();
		var _token = $("input[name='_token']").val();
		var updateStatus = $("select[name='updateStatus']").val();
		var newRemarks = $("textarea[name='newRemarks']").val();
		var uID = $("input[name='dID']").val();
		var rentalID = $("input[name='rentalID']").val();
		if (updateStatus==1){
			var d = new Date();

			var month = d.getMonth()+1;
			var day = d.getDate();

			var approved = d.getFullYear() + '/' +
			(month<10 ? '0' : '') + month + '/' +
			(day<10 ? '0' : '') + day;
		}
		else if(updateStatus==2){
			var approved =null;

		}
		else if(updateStatus==0){
			var approved =null;
		}
		

 		$.ajax({
       			type: "PUT",
       			url: "/requestList/"+uID,
       			data: { 
       				'_token' : $('input[name=_token]').val(),
       				'updateStatus': updateStatus,
       				'newRemarks': newRemarks,
       				'approved': approved,
       				'rentalID': rentalID

       			},
       				success: function(data) {
       					toastr.success('Request UpdateD');
                    	window.location = '/requestList';
       				}


       			});

})
$(document).on('click', '#viewModal', function(e){
	id = $(this).attr('data-id');
	$('#view').modal('show');
	e.preventDefault();
	console.log(id)
	$.ajax({
		type: "GET",
		url: "/requestList/show/"+id,
	success: function(data) {
		console.log(data);
			$('#vRequestID').val(data.req.requestID);
			if ((data.req.status)==0){
					$('#vStatus').val('Pending');	
			}
			else if((data.req.status)==1)
			{
				$('#vStatus').val('Approved');
			}
			else if((data.req.status)==2)
			{
				$('#vStatus').val('Reject');
			}
			
			$('#vStallHolder').val(data.req.rental.stall_holder.stallHFName+' '+data.req.rental.stall_holder.stallHMName+' '+data.req.rental.stall_holder.stallHLName);
			if((data.req.requestType)==1)
			{
				$('#vType').val('Transfer Stall');
				$('#vtypeTransfer').show();
				$('#vtypeCancel').hide();
				$('#vtypeOther').hide();
				$('#vfrom').val(data.req.rental.stallID);
				$('#vto').val(data.req.request_info.stallRequested);
			}
			else if ((data.req.requestType)==2)
			{
				$('#vType').val('Cancel Contract');
				$('#vtypeCancel').show();
				$('#vtypeTransfer').hide();
				$('#vtypeOther').hide();
				$('#vcancel').val(data.req.rental.stallID);
			} 
				else if ((data.req.requestType)==3)
			{
				$('#vType').val('Others');
				$('#vtypeOther').show();
				$('#vtypeTransfer').hide();
				$('#vtypeCancel').hide();
				$('#vother').val(data.req.rental.stallID);
			}
			$('#vDesc').val(data.req.requestText);
			$('#vdStatus').val(data.req.status);
			$('#vremarks').val(data.req.remarks);

		          					
		}


			});

})
