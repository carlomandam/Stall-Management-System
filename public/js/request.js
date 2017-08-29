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
			else if((data.req.status)==1)
			{
				$('#uStatus').val('Reject');
			}
			
			$('#uStallHolder').val(data.req.rental.stall_holder.stallHFName+' '+data.req.rental.stall_holder.stallHMName+' '+data.req.rental.stall_holder.stallHLName);
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
