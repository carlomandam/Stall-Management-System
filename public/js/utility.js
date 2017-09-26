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
				$('.stallList').append('<tr class ="stall"><td>'+value.stallID+'</td><td><input type="text" class="form-control" id="sub_prev" name="subPrev" disabled></td><td><input type="text" class="form-control" id="sub_pres" name="" disabled></td><td><input type="text" class="form-control" id="totalAmt" name="" disabled></td> </tr>');
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
      // console.log(prevPres);
      // $('.reminderFrom').val(Math.abs(collect)+.01);

});
var multi;
$("#total_bill").bind("change paste keydown keyup click", function() {
      tempTotal = ($(this).val()).replace("Php ", "",);
      temp2 = tempTotal.replace(",", "",);
      total = Number(temp2);
      multi = total/prevPres;
      // console.log(multi);
      $('#multiplier_amt').val(Math.abs(multi));


});



