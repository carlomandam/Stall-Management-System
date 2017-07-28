$(document).on('click','.building',function(){
	
  id = $(this).attr('data-id');
		$('.floor').remove();
		$.ajax({
		type: "GET",
		url: '/bldg/'+id,
		success: function(data)	{
			$.each(data.bldg.floor,function(key,value){

				$('.floors').append('<li class="getfloor" data-id ="'+value.floorID+'"><a href ="/kioskmap/'+value.floorID+'" data-id ="'+value.floorID+'" class ="floor"><i class ="fa fa-map-marker" ></i>'+value.floorNo+'</a></li>');
				
			});

		}

	});


	
	
	
})



// $(document).on('click','.floor',function(){
	
//   id = $(this).attr('data-id');
// 		$('.floor').remove();
// 		$.ajax({
// 		type: "GET",
// 		url: '/kioskmap/'+id,
// 		// success: function(data)	{
// 		// 	$.each(data.bldg.floor,function(key,value){

// 		// 		// $('.floors').append('<li class="getfloor" data-id ="'+value.floorID+'"><a data-id ="'+value.floorID+'" class ="floor"><i class ="fa fa-map-marker" ></i>'+value.floorNo+'</a></li>');
				
// 		// 	});

// 		// }

// 	});


	
	
	
// })



