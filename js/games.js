function clearData(){
    $('#game-info div').html('');
    $('#game-info').hide();
}

function showAll(){
    $('#game-info').fadeIn();
    $('#game-info div').fadeIn();
}

function showSmallNav(){
    $('#gamenav .gameicon').css('padding', '5px');
    $('#gamenav').addClass('nav-small smooth');
    $("#gamenav .game-img, .game-img img").addClass('img-small smooth');
    $('#gamenav .game-title').hide();

    $('html, body').stop().animate({
        'scrollTop':  $('#game').offset().top
    }, 500, function () {
        window.location.hash = 'game';
    });
}

function showBigNav(){
    $('#gamenav').removeClass('nav-small smooth');
    $("#gamenav .game-img, .game-img img").removeClass('img-small smooth');
    $('#gamenav .game-title').show();
}


$("document").ready(function () {

    clearData();

    $('#gamenav a').click(function () {
        
        clearData();

        if(! $('#gamenav').hasClass("smooth")) showSmallNav();
    
  
        $.getJSON('gamedata/'+this.href.split('#')[1]+'.json', function (data) {
        console.log(data);

        

        $('#rules').append('<h3>'+data['game-heading']+'</h3>')
        $('#rules').append('<h4>Rules</h4><ul class="tick"><li>'+data['rules'].join('</li><li>')+'</li></ul>');
        $('#hall').append('<h4>Hall of Fame</h4><ul class="star"><li>'+data['hall'].join('</li><li>')+'</ul>');
        $('#gamecontact').append('<h4>Contacts</h4>');

        showAll();

    });
      
    });
  });