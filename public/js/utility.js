
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
			// console.log(data);
			$.each(data.stalls,function(key,value){
				// console.log(value[0].presRead);
				if(value[0].presRead==null){
					$('.stallList').append('<tr class ="stall" data-id ="'+value[0].contractID+'"><td>'+value[0].stallID+'</td><td><input type="text" data-id="'+value[0].stallUtilityID+'" class="form-control reading2" id="sub_prev" name="subPrev"></td><td><input type="text" class="form-control reading2" id="sub_pres" name="subPres" ></td><td><input type="text" class="form-control money2" id="total_amt" name="totalAmt" disabled></td><td><input type="hidden" value ="'+value[0].stallUtilityID+'" name="stallUtility"></td> </tr>');	
					// var x = $(this).index();
					// console.log(key); 
				}
				else{

					$('.stallList').append('<tr class ="stall" data-id ="'+value[0].contractID+'"><td>'+value[0].stallID+'</td><td><input type="text" data-id="'+value[0].stallUtilityID+'" class="form-control reading2" id="sub_prev" name="subPrev" value ="'+value[0].presRead+'" disabled></td><td><input type="text" class="form-control reading2" id="sub_pres" name="subPres"></td><td><input type="text" class="form-control money2" id="total_amt" name="totalAmt" disabled></td><td><input type="hidden" value ="'+value[0].stallUtilityID+'" name="stallUtility"></td>  </tr>');
					
				}
					$(document).on("input","#sub_pres", function(){
						ind = $(this).closest('tr').index();
						console.log(ind);
						document.getElementById('total_bill').disabled=false;
						document.getElementById('pres_read').disabled=true;
						temp1 = $('input[name*=subPrev]').eq(ind).val();
						prev = Number(temp1);
						console.log(prev);
						
						temp2 = $(this).val();
						pres =Number(temp2);

						if(pres>prev){
							var total=0;
							temp = (pres - prev)*multi;
							$(' .stallList tr ').each(function(){
								ind2 = $(this).index();
								var amount = $('input[name=totalAmt]').eq(ind2).val().replace("Php ", "",).replace(",", "",);
								amount = Number(amount);
								total = total+amount; 
								
							})

							if(total>=amountBill){
								alert('Invalid INPUT');
								$('input[name*=subPres]').eq(ind).val(" ");
								$('input[name*=totalAmt]').eq(ind).val("0");
							}
							else{
								$('input[name*=totalAmt]').eq(ind).val(temp);
							}
						}
						else{
							$('input[name*=totalAmt]').eq(ind).val("0");
						}

						
					})


					$(document).on("input","#sub_prev", function(){
						ind = $(this).closest('tr').index();
						console.log(ind);
						temp1 = $('input[name*=subPres]').eq(ind).val();
						pres = Number(temp1);
						temp2 = $(this).val();
						prev = Number(temp2);
						if(pres>prev){
							var total=0;
							temp = (pres - prev)*multi;
							$(' .stallList tr ').each(function(){
								ind2 = $(this).index();
								var amount = $('input[name=totalAmt]').eq(ind2).val().replace("Php ", "",).replace(",", "",);
								amount = Number(amount);
								total = total+amount; 
								
							})

							if(total>=amountBill){
								alert('Invalid INPUT');
								$('input[name*=subPrev]').eq(ind).val(" ");
								$('input[name*=totalAmt]').eq(ind).val("0");
							}
							else{
								$('input[name*=totalAmt]').eq(ind).val(temp);
							}
						
						}
						else{
							$('input[name*=totalAmt]').eq(ind).val("0");
						}
						
					})
					
			});
			 $(".reading2").inputmask("9999999", { numericInput: true, placeholder: "0",clearMaskOnLostFocus: false});
			 $(".money2").inputmask('currency', {rightAlign: true, prefix: 'Php '});
		}
	});

	$.ajax({
		type: "GET",
		url: "/Utilities/previous/"+id,
		success: function(data) {
			console.log(data.previous);
			if(data.previous == null )
			{
				$("#date_to").datepicker("destroy");
				$("#date_from").datepicker("destroy");
				$('#date_from').datepicker({
					autoclose: true,
					format: 'yyyy-mm-dd',
					endDate: 'today',
					todayHighlight: true


				});
				$(document).on('change','#date_from',function(){
					start = $(this).val();
					var newStart = new Date(start);
					newStart.setDate(newStart.getDate()+1);
					newStart = newStart.toISOString().slice(0,10);
					console.log(newStart);
					$('#date_to').datepicker({
						autoclose: true,
						format: 'yyyy-mm-dd',
						endDate: 'today',
						startDate: newStart,
						todayHighlight: true
					});
				})

				
			}
			else{
				$("#date_from").datepicker("destroy");
				$("#date_to").datepicker("destroy");
				$('#date_from').prop("disabled", true);
				$('#prev_read').val(data.previous.presReading );
				document.getElementById('prev_read').disabled =true;
				var date = data.previous.readingTo;
				var temp = new Date(date);
				var start = new Date(date);
				temp.setDate(temp.getDate()+2);
				console.log(temp);
				temp =temp.toISOString().slice(0,10);
				console.log(temp);
				start.setDate(start.getDate()+3);
				start = start.toISOString().slice(0,10);
				console.log(start);
				$('#date_from').val(temp); 	
				$('#date_to').datepicker({
      				  autoclose: true,
        			  format: 'yyyy-mm-dd',
        			  startDate: start,
        			  endDate: 'tomorrow',
        			  todayHighlight: true,

      			});
			}
			
		}
	});

})

// Rate function
var multi;
var amountBill;
var totalSubAmount;
jQuery(document).ready(function ($) {
    var $totalbill = $('#total_bill'),
        $reading = $('.reading'),
        $rate = $('#multiplier_amt'),
        $totalAmount = $('input[name*=totalAmt]');
    var totalReading;
    var tempVar1 = $('input[name*=presRead]').val();
    var var1 = Number(tempVar1)
    var tempVar2 =$('input[name*=prevRead]').val();
    var var2 = Number(tempVar2);
    totalReading = var1-var2;

    var rate;
    $reading.on('input', function (e) {
        var temp1 = $('.reading').eq(0).val();
        var read1 = Number(temp1);
        var temp2 = $('.reading').eq(1).val();
        var read2 = Number(temp2);
        if((read1>0)&&(read2>0)){
        	document.getElementById('date_from').disabled=true;
        	document.getElementById('date_to').disabled=true;
        }
        else{
        	document.getElementById('date_from').disabled=false;
        	document.getElementById('date_to').disabled= false;
        }
        if((read2>read1)){

        	totalReading = read2-read1;
        	globalTotalReading =totalReading;
        	 console.log(totalReading);
        	 var temp3 = $('#total_bill').val().replace("Php ", "",);
        	 var temp4 = temp3.replace(",", "",);
    		 var temp5 = Number(temp4);
    		 var r = temp5/totalReading;
    		 multi = r;
    		 
        	 $('#multiplier_amt').val(r);
        	 document.getElementById('total_bill').disabled= false;
        }
        else{
        	$('#multiplier_amt').val('0');
        	document.getElementById('total_bill').disabled= true;
        }
      
    });
    $totalbill.on('input',function(e){
    	
    	var temp1 = $('#total_bill').val().replace("Php ", "",);
    	var temp2 = temp1.replace(",", "",);
    	var temp3 = Number(temp2);
    	amountBill = temp3;
    	$(' .stallList tr ').each(function(){
    		ind2 = $(this).index();
    		$('input[name=subPres]').eq(ind2).val('0');
    		$('input[name=totalAmt]').eq(ind2).val('0');
  

    	})
    
    	if(isNaN(totalReading)){
    		$('#multiplier_amt').val('0');
    		console.log('asdf');
    	}
    	else{
    		var r = temp3/totalReading;
    		multi =r;
    		$('#multiplier_amt').val(r);
    	}
    });
 


   
   
});

// inputmask

$(document).ready(function() {
	var rList = $('#monthlyList').DataTable({
    'responsive': true,
    "searching": true,
    "paging": true,
    "info": true,
    "retrieve": true,
	});


});

// SAve button
$(document).on("click","#save", function(e){
	e.preventDefault();
	var finalUtility = $("select[name='utilityType']").val();
	var finalDateFrom = $("input[name='dateFrom']").val();
	var finalDateTo = $("input[name='dateTo']").val();
   	var finalPrevious = parseInt($("input[name='prevRead']").val());
   	finalPrevious = (isNaN(finalPrevious) ? 0 : finalPrevious); 
	var finalPresent = parseInt($("input[name='presRead']").val());
	finalPresent = (isNaN(finalPresent) ? 0 : finalPresent);
	var finalBillAmount = amountBill;
	var finalMulti = multi;
	var subMeter = [];
	var meterID =[];
	
	$('.stallList tr').each(function() {
		
   		ind = $(this).index();
  		var sub ={
	  		"finalUtilID" : $('input[name=stallUtility]').eq(ind).val(),
	  		// "finalSubPrev" : parseInt($('input[name=subPrev]').eq(ind).val()),
	  		"finalSubPrev": (isNaN(parseInt($('input[name=subPrev]').eq(ind).val())) ? 0 : parseInt($('input[name=subPrev]').eq(ind).val())),
	  		"finalSubPres": (isNaN(parseInt($('input[name=subPres]').eq(ind).val()))) ? 0 :parseInt($('input[name=subPres]').eq(ind).val())
  
  		}
  		subMeter.push(sub);
  		var fRead = parseInt($('input[name=finalRead]').val());
  		fRead = (isNaN(fRead) ? 0 : fRead);
  		var met ={
  			 "finalSubAmount": (!($('input[name=totalAmt]').eq(ind).val().replace("Php ", "",).replace(",", "",)) ? 0 : $('input[name=totalAmt]').eq(ind).val().replace("Php ", "",).replace(",", "",)),
  			 "finalContractID":$('.stall').eq(ind).attr("data-id")
  		}

  		meterID.push(met);
  		
	});
	console.log(finalUtility);
	console.log(finalDateFrom);
	console.log(finalDateTo);
	console.log(finalPrevious);
	console.log(finalPresent);
	console.log(finalBillAmount);
	console.log(finalMulti);
	console.log(subMeter);
	console.log(meterID);	

	$.ajax({
		type: "POST",
		url: "/Utilities",
		data: { 
			
			'finalUtility': finalUtility,
			'finalDateFrom': finalDateFrom,
			'finalDateTo': finalDateTo,
			'finalPrevious': finalPrevious,
			'finalPresent': finalPresent,
			'finalBillAmount':finalBillAmount,
			'finalMulti':finalMulti,
			'subMeter': subMeter,
			'meterID': meterID
		},

			success: function(data) {
				if($.isEmptyObject(data.error)){
					toastr.success('Added New Utilities');
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

$(document).on('click', '#view', function(){
	id = $(this).attr('data-id');
	console.log(id);
	window.location.href="/Utilities/view/"+id;

})
$(document).on('click', '#finalize', function(){
	id = $(this).attr('data-id');
	console.log(id);
	window.location.href="/Utilities/update/"+id;

})
$(document).on("click","#update", function(e){
	e.preventDefault();
	id = $(this).attr('data-id');
	console.log(id);
	var finalUtility = $("input[name='utilityType']").attr('data-id');
	var finalDateFrom = $("input[name='dateFrom']").val();
	var finalDateTo = $("input[name='dateTo']").val();
   	var finalPrevious = parseInt($("input[name='prevRead']").val());
   	finalPrevious = (isNaN(finalPrevious) ? 0 : finalPrevious); 
	var finalPresent = parseInt($("input[name='presRead']").val());
	finalPresent = (isNaN(finalPresent) ? 0 : finalPresent);
	var finalBillAmount = (!($('input[name=totalBill]').val().replace("Php ", "",).replace(",", "",)) ? 0 : $('input[name=totalBill]').val().replace("Php ", "",).replace(",", "",));
  	
	var finalMulti = (!($('input[name=multiplierAmt]').val().replace("Php ", "",).replace(",", "",)) ? 0 : $('input[name=multiplierAmt]').val().replace("Php ", "",).replace(",", "",));
  	;
	var subMeter = [];
	var meterID =[];
	
	$('.stallList tr').each(function() {
		
   		ind = $(this).index();
  		var sub ={
	  		"finalSubID" : $('input[name=subMeterID]').eq(ind).val(),
	  		// "finalSubPrev" : parseInt($('input[name=subPrev]').eq(ind).val()),
	  		"finalSubPrev": (isNaN(parseInt($('input[name=subPrev]').eq(ind).val())) ? 0 : parseInt($('input[name=subPrev]').eq(ind).val())),
	  		"finalSubPres": (isNaN(parseInt($('input[name=subPres]').eq(ind).val()))) ? 0 :parseInt($('input[name=subPres]').eq(ind).val())
  
  		}
  		subMeter.push(sub);
  		var fRead = parseInt($('input[name=finalRead]').val());
  		fRead = (isNaN(fRead) ? 0 : fRead);
  		var met ={
  			 "finalSubAmount": (!($('input[name=totalAmt]').eq(ind).val().replace("Php ", "",).replace(",", "",)) ? 0 : $('input[name=totalAmt]').eq(ind).val().replace("Php ", "",).replace(",", "",)),
  			 "finalMeterID":$('input[name=meterID]').eq(ind).val()
  		}

  		meterID.push(met);
  		
	});
	console.log(finalUtility);
	console.log(finalDateFrom);
	console.log(finalDateTo);
	console.log(finalPrevious);
	console.log(finalPresent);
	console.log(finalBillAmount);
	console.log(finalMulti);
	console.log(subMeter);
	console.log(meterID);	
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	$.ajax({
		type: "PUT",
		url: "/Utilities/"+id,
		data: { 
			'finalUtility': finalUtility,
			'finalDateFrom': finalDateFrom,
			'finalDateTo': finalDateTo,
			'finalPrevious': finalPrevious,
			'finalPresent': finalPresent,
			'finalBillAmount':finalBillAmount,
			'finalMulti':finalMulti,
			'subMeter': subMeter
			// 'meterID': meterID
		},

			success: function(data) {
				if($.isEmptyObject(data.error)){
					toastr.success('Utilities Updated');
					window.location.href="/Utilities";
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


$(document).on("input","#sub_pres", function(){
						ind = $(this).closest('tr').index();
						console.log(ind);
						document.getElementById('total_bill').disabled=true;
						document.getElementById('pres_read').disabled=true;
						temp1 = $('input[name*=subPrev]').eq(ind).val();
						prev = Number(temp1);
						console.log(prev);
						multi = $('input[name=multiplierAmt]').val().replace("Php ", "",).replace(",", "",);
								
						temp2 = $(this).val();
						pres =Number(temp2);
						console.log(pres);
						if(pres>prev){
							
							console.log(multi);

							temp = (pres - prev)*multi;
							var total=temp;
							console.log(temp);
							$(' .stallList tr ').each(function(){
								ind2 = $(this).index();
								var amount = $('input[name=totalAmt]').eq(ind2).val().replace("Php ", "",).replace(",", "",);
								amount = Number(amount);
								console.log(amount);
								total = total+amount; 
								console.log(total);
								
							})
							console.log(total);
							if( total >=amountBill){
								alert('Invalid INPUT');
								$('input[name*=subPres]').eq(ind).val(" ");
								$('input[name*=totalAmt]').eq(ind).val("0");
							}
							else{
								$('input[name*=totalAmt]').eq(ind).val(temp);
							}
						}
						else{
							$('input[name*=totalAmt]').eq(ind).val("0");
						}

						
})

// Finalize MOnthly reading
$(document).on('click','#isFinalize',function(){
	id = $(this).attr('data-id');
	console.log(id);
		$.ajax({
		type: "PUT",
		url: "/Utilities/finalize/"+id,
			success: function(data) {
				if($.isEmptyObject(data.error)){
					toastr.success('Utilities Finalize');
					window.location.href="/Utilities";
				}else{
					// toastr.error(data.error);
					printErrorMsg(data.error);
				}
			}

		});
})
