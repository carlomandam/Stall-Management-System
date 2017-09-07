$(document).on('load','#container', function(){
    var str = [];
    for (var i = 0; i < 20; i++) {
            str.push(' <div class="col-md-2" style="border: 2px solid black; height: 80px;"></div>');
       
    }
     $('#container').html(str.join(''));
})