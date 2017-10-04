
$(document).on('change', '#utilityType', function(){
	id = $('#utilityType').val();
	if( id > 0){
		document.getElementById('date_from').disabled = false;
		document.getElementById('date_to').disabled = false;
	}
	$('.stall').remove();
	$('#date_to').val("");
	$('#date_from').val("");
	$('#prev_read').val(""); 
	$.ajax({
		type: "GET",
		url: "/Utilities/"+id,
		success: function(data) {
			console.log(data);
			$.each(data.stalls,function(key,value){
				var classname ='reading'; 
				if(value.presRead==null){
					$('.stallList').append('<tr class ="stall" data-id ="'+value.contractID+'"><td>'+value.stallID+'</td><td><input type="text" data-id="'+value.stallUtilityID+'" class="form-control" id="sub_prev" name="subPrev"></td><td><input type="text" class="form-control" id="sub_pres" name="subPres" ></td><td><input type="text" class="form-control" id="total_amt" name="totalAmt" disabled></td><td><input type="hidden" value ="'+value.stallUtilityID+'" name="stallUtility"></td> </tr>');
				
					

				}
				else{
					$('.stallList').append('<tr class ="stall" data-id ="'+value.contractID+'"><td>'+value.stallID+'</td><td><input type="text" data-id="'+value.stallUtilityID+'" class="form-control" id="sub_prev" name="subPrev" value ="'+value.presRead+'" disabled></td><td><input type="text" class="form-control" id="sub_pres" name="subPres"></td><td><input type="text" class="form-control" id="total_amt" name="totalAmt" disabled></td><td><input type="hidden" value ="'+value.stallUtilityID+'" name="stallUtility"></td>  </tr>');
				
				}
				
					$(document).on("change","#sub_pres", function(){
						ind = $(this).closest('tr').index();
						console.log(ind);
						prev = $('input[name*=subPrev]').eq(ind).val();
						console.log(prev);
						pres = $(this).val();

						
						temp = (pres - prev)*multi ;

						// if(temp>0){
							$('input[name*=totalAmt]').eq(ind).val(temp);
						// }
						// else{
						// 	$('input[name*=totalAmt]').eq(ind).val("");
						// }
					})


					$(document).on("change","#sub_prev", function(){
						ind = $(this).closest('tr').index();
						console.log(ind);
						pres = $('input[name*=subPres]').eq(ind).val();
						
						prev = $(this).val();

					
						temp = (pres - prev)*multi ;
						// if(temp>0){
							$('input[name*=totalAmt]').eq(ind).val(temp);
						// }
						
					})				
			});
		}
	});

	$.ajax({
		type: "GET",
		url: "/Utilities/previous/"+id,
		success: function(data) {
			// console.log(data.previous.readingTo);
			if(data.previous == null )
			{
				document.getElementById('date_from').disabled = false;
				document.getElementById('prev_read').disabled = false;
			}
			else{
				$('#date_from').val(data.previous.readingTo);
				document.getElementById('date_from').disabled = true;
				$('#prev_read').val(data.previous.presReading );
				document.getElementById('prev_read').disabled =true;
			}
			// $('#date_from').val(data.previous.readingTo);
		}
	});

})


var prevPres;
$("#pres_read").bind("change paste keydown keyup click", function() {
      tempPres = ($(this).val());
      pres = Number(tempPres);
      tempPrev = $('#prev_read').val();
      prev = Number(tempPrev);
      prevPres = pres-prev;



});
$("#prev_read").bind("change paste keydown keyup click", function() {
      tempPrev = ($(this).val());
      prev = Number(tempPrev);
      tempPres = $('#pres_read').val();
      pres = Number(tempPres);
      prevPres = pres-prev;
   

});
var multi;
var amountBill;
$("#total_bill").bind("change paste keydown keyup click", function() {
      tempTotal = ($(this).val()).replace("Php ", "",);
      temp2 = tempTotal.replace(",", "",);
      total = Number(temp2);
      amountBill = Number(temp2);
      multi = total/prevPres;
    
      $('#multiplier_amt').val(Math.abs(multi));
      
});




$(document).ready(function() {
  $(".collectTo").inputmask('currency', {
  rightAlign: true,
  prefix: 'Php ',
});

 $('.datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
      endDate: 'today'
      // todayHighlight:true

    });
 // $('.reading').inputmask({ mask: "9-9-9-9-9-9-9"});

 $(".reading").inputmask("9999999", { numericInput: true, placeholder: "0"});
  $(".money").inputmask('currency', {
  rightAlign: true,
  prefix: 'Php ',
});

});

$(document).on("click","#save", function(e){
e.preventDefault();
var _token = $("input[name='_token']").val();
	var finalUtility = $("select[name='utilityType']").val();
	var finalDateFrom = $("input[name='dateFrom']").val();
	var finalDateTo = $("input[name='dateTo']").val();
	var finalPrevious = parseInt($("input[name='prevRead']").val());
	var finalPresent = parseInt($("input[name='presRead']").val());
	var finalBillAmount = amountBill;
	var finalMulti = Math.round(multi * 100)/100;
	var finalSubPrev = [];
	var finalSubPres =[];
	var finalSubAmount =[];
	var finalStallUtility =[];
	$("input[name='subPrev']").each(function() {
   		 finalSubPrev.push($(this).val());
	});
	$("input[name='subPres']").each(function() {
   		 finalSubPres.push($(this).val());
	});
	$("input[name='totalAmt']").each(function() {
   		 finalSubAmount.push($(this).val());
	});
	$("input[name='stallUtility']").each(function() {
   		 finalStallUtility.push($(this).val());
	});
	console.log(finalStallUtility);
	$.ajax({
		type: "POST",
		url: "/Utilities",
		data: { 
			'_token' : $('input[name=_token]').val(),
			'finalUtility': finalUtility,
			'finalDateFrom': finalDateFrom,
			'finalDateTo': finalDateTo,
			'finalPrevious': finalPrevious,
			'finalPresent': finalPresent,
			'finalBillAmount':finalBillAmount,
			'finalMulti':finalMulti
			// 'finalSubPrev': finalSubPrev,
			// 'finalSubPres':finalSubPres,
			// 'finalSubAmount': finalSubAmount

		},

			success: function(data) {
				if($.isEmptyObject(data.error)){
					toastr.success('Added New requirements');
					location.reload();
				}else{
					toastr.error(data.error);
				}
			}

		});


})



	
