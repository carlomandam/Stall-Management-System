

$(document).on('change','.building',function(){
  id = $(this).val();
  console.log(id);
		$('.floor').remove();
		$('.floorname').text("Floor No:");
		$.ajax({
		type: "GET",
		url: '/kioskmap/load/'+id,
		success: function(data)	{
						 
			$.each(data,function(key,value){
				// console.log(value.bldgID);		
				$('.buildingname').text(value.bldgName);
			});
			$('.floors').append('<option disabled selected="selected" class="floor">--Select</option>');
			$.each(data.bldg.floor,function(key,value){

				$('.floors').append('<option class="floor" value="'+value.floorNo+'">'+value.floorNo+'</option>');
				console.log(value.floorNo);					
			});

		}

	});
	
	
})

$(document).on('change','.floors',function(){
  		id = $(this).val();
  		console.log(id);
  			$('.floorname').text("Floor No:"+id);

	});



$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

// Setitng the Map
var settings = {
  rows: 10,
  cols: 10,
  stallHeight: 40,
  stallWidth: 40,
  rowCssPrefix: 'row-',
  colCssPrefix: 'col-',
  stallCss: 'seat',

}

var init = function (reservedStall) {
    var stall = [],stallNo,className;

    for(i = 0; i< settings.rows;i++) {
      for(j = 0; j < settings.cols; j++)
      {
        className = settings.stallCss + ' ' + settings.rowCssPrefix + i.toString() + ' ' + settings.colCssPrefix + j.toString();
        stall.push('<li class="' + className + '" + style="top:'+ (i * settings.stallHeight).toString() +'px; left:'+ (j * settings.stallWidth).toString() + 'px;border: 2px solid black;"> </li>')
        console.log(stall[j]);
      }
    }
    $('#place').html(stall.join(''));
};

init();

  



// var settings = {
//                rows: 5,
//                cols: 5,
//                rowCssPrefix: 'row-',
//                colCssPrefix: 'col-',
//                seatWidth: 50,
//                seatHeight: 50,
//                seatCss: 'seat',
//                selectedSeatCss: 'selectedSeat',
//                selectingSeatCss: 'selectingSeat'
//            };

// var init = function (reservedSeat) {
//                 var str = [], seatNo, className;
//                 for (i = 0; i < settings.rows; i++) {
//                     for (j = 0; j < settings.cols; j++) {
//                         seatNo = (i + j * settings.rows + 1);
//                         className = settings.seatCss + ' ' + settings.rowCssPrefix + i.toString() + ' ' + settings.colCssPrefix + j.toString();
//                         if ($.isArray(reservedSeat) && $.inArray(seatNo, reservedSeat) != -1) {
//                             className += ' ' + settings.selectedSeatCss;
//                         }
//                         str.push('<li class="' + className + '"' +
//                                   'style="top:' + (i * settings.seatHeight).toString() + 'px;left:' + (j * settings.seatWidth).toString() + 'px">' +
//                                   '<a title="' + seatNo + '">' + seatNo + '</a>' +
//                                   '</li>');
//                         console.log(className);
//                         console.log(seatNo);
//                         console.log(str[j]);
//                     }
//                 }
//                 $('#place').html(str.join(''));
//             };
//             //case I: Show from starting
//             init();
 
            //Case II: If already booked
            // var bookedSeats = [5, 25];
            // init(bookedSeats);




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


