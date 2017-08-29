$('#mEquip').addClass('active');
var eList = $('#equipList').DataTable({
    'responsive': true,
    "searching": true,
    "paging": true,
    "info": true,
    "retrieve": true,
});



("#saveReq").click(function(e){
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