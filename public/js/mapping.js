

$(document).on('change','.building',function(){
  id = $(this).val();
  console.log(id);
		$('.floor').remove();
		$('.floorname').text("Choose Floor no:");
		$.ajax({
		type: "GET",
		url: '/kioskmap/bldg/'+id,
		success: function(data)	{	
      		
				$('.buildingname').text(data.bldg.bldgName);
			 $('.floors').append('<option disabled selected="selected" class="floor">--Select</option>');
			$.each(data.bldg.floor,function(key,value){
        $('.floors').append('<option value="'+value.floorID+'">'+value.floorDesc+'</option>');
			
			});

		}

	});
	
	
})
$(document).on('change','.floors',function(){
  id = $(this).val();
  console.log(id);
	console.log('succes');
  	
		$.ajax({
		type: "GET",
		url: '/kioskmap/floor/'+id,
		success: function(data)	{	
          // console.log(data.floor.stall);
      		$('.floorname').text("Floor No."+data.floor.floorLevel);
          $('.cap').text("/"+data.floor.floorCapacity);
          $.each(data.floor.stall,function(key,value){
            // var stall+value.stallID = {
            //     type:+value.stype_SizedID+,
            //     desc:'+value.stallDesc+',

            // }
            // var stall'value.stallID' = {

            // }
            // console.log(value.stallID);
            // console.log(value.stallDesc);
          });
          // init();


		}

	});
	
	
})


// // Setitng the Map
// var settings = {
//   rows: 15,
//   cols: 15,
//   stallHeight: 55,
//   stallWidth: 75,
//   rowCssPrefix: 'row-',
//   colCssPrefix: 'col-',
//   stallCss: 'seat',

// }

// var init = function (reservedStall) {
//     var stall = [],stallNo,className;

//     for(i = 0; i< settings.rows;i++) {
//       for(j = 0; j < settings.cols; j++)
//       {
//         className = settings.stallCss + ' ' + settings.rowCssPrefix + i.toString() + ' ' + settings.colCssPrefix + j.toString();
//         stall.push('<li class="' + className + '" + style="top:'+ (i * settings.stallHeight).toString() +'px; left:'+ (j * settings.stallWidth).toString() + 'px;border: 2px solid black;"> </li>')
//         console.log(stall[j]);
//       }
//     }
//     $('#place').html(stall.join(''));
// };

// init();

  



var settings = {
               rows: 5,
               cols: 5,
               rowCssPrefix: 'row-',
               colCssPrefix: 'col-',
               seatWidth: 50,
               seatHeight: 50,
               seatCss: 'seat',
               selectedSeatCss: 'selectedSeat',
               selectingSeatCss: 'selectingSeat'
           };

var init = function (reservedSeat) {
                var str = [], seatNo, className;
                for (i = 0; i < settings.rows; i++) {
                    for (j = 0; j < settings.cols; j++) {
                        seatNo = (i + j * settings.rows + 1);
                        className = settings.seatCss + ' ' + settings.rowCssPrefix + i.toString() + ' ' + settings.colCssPrefix + j.toString();
                        if ($.isArray(reservedSeat) && $.inArray(seatNo, reservedSeat) != -1) {
                            className += ' ' + settings.selectedSeatCss;
                            console.log(className);
                        }
                        str.push('<li class="' + className + '"' +
                                  'style="top:' + (i * settings.seatHeight).toString() + 'px;left:' + (j * settings.seatWidth).toString() + 'px">' +
                                  '<a title="' + seatNo + '">' + seatNo + '</a>' +
                                  '</li>');
                        // console.log(className);
                        console.log(seatNo);
                        console.log(str[j]);
                    }
                }
                $('#place').html(str.join(''));
            };
            //case I: Show from starting
            // init();
 
            //Case II: If already booked
            var bookedSeats = [5, 25,1,2,3];
            init(bookedSeats);




// $('.' + settings.seatCss).click(function () {
// if ($(this).hasClass(settings.selectedSeatCss)){
//     alert('This seat is already reserved');
// }
// else{
//     $(this).toggleClass(settings.selectingSeatCss);
//     }
// });
 
// $('#btnShow').click(function () {
//     var str = [];
//     $.each($('#place li.' + settings.selectedSeatCss + ' a, #place li.'+ settings.selectingSeatCss + ' a'), function (index, value) {
//         str.push($(this).attr('title'));
//     });
//     alert(str.join(','));
// })
 
// $('#btnShowNew').click(function () {
//     var str = [], item;
//     $.each($('#place li.' + settings.selectingSeatCss + ' a'), function (index, value) {
//         item = $(this).attr('title');                   
//         str.push(item);                   
//     });
//     alert(str.join(','));
// })


