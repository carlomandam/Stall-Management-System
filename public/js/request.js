var rList = $('#requestList').DataTable({
    'responsive': true,
    "searching": true,
    "paging": true,
    "info": true,
    "retrieve": true,
});


$(document).on('change','#stallHolder',function(){
     id = $(this).val();
     console.log(id);
		 // $.ajax({
		 //    type: "GET",
		 //    url: '/kioskmap/getStall/'+id,
		 //    success: function(data)	{	
   //    	   $('.floorname').text("Floor No."+data.floor.floorLevel);
   //         $('.cap').text("/"+data.floor.floorCapacity);
   //          $.each(data.floor.stall,function(key,value){

   //          });
		 //    }
  	//  });	
})