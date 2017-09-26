$(document).on('change', '#utilityType', function(){
    id = $('#utilityType').val(); 
	$.ajax({
       			type: "GET",
       			url: "/Utilities/"+id,
       			success: function(data) {
       					// console.log(data);
       					$.each(data,function(key,value){
       						$('.stallList').append('<tr class ="stall"><td>'+value+'</td><td></td><td></td> </tr>');
       						// console.log(value);
       					});

       				}


       			});

})