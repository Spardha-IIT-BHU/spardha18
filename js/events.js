var small = false;
var eventheading = "";
function clearData(){
    $('#event-info div').html('');
    $('#event-info').fadeOut(20);
}

function showAll(){
    $('#event-info').fadeIn(1000);
    $('#event-info div').fadeIn(1000);
}

function smallNav(){
    small = true;
    $('#eventnav').addClass('nav-small smooth');
    $("#eventnav .event-img, #eventnav .event-img img").removeClass('img-big');
    $("#eventnav .event-img, #eventnav .event-img img").addClass('img-small smooth');
    $('#eventnav .eventicon').css('padding', '5px');
    $('#eventnav .event-title').hide();


    $('html, body').stop().animate({
        'scrollTop':  $('#event').offset().top
    }, 800, function () {
        if($(window).height()<=400) window.location.hash = 'event-info';
        else window.location.hash = 'event';
        window.location.hash = eventheading;
    });
}

$("document").ready(function () {

    let div = $('#eventnav');
    //div.empty();
    const url = 'eventdata/eventlist.json';
    $.getJSON(url, function (data) {
    $.each(data, function (key, entry) {
        var x = entry.name;
        div.append('<div class="col-sm-3 col-md-3 col-lg-2 eventicon"><div class="event-img img-big"><a href="#'+x+'" class="thumbnail"><img src="images/events/'+x+'.png" class="float-center img-big" title="'+x.toUpperCase()+'"/></a></div>');
    })
    });

    clearData();

    /*$('.event-img img').hover(function(){
        $(this).attr('src', function(index, attr){
            return attr.replace('.png', '-h.png');
        });
        }, function(){
        $(this).attr('src', function(index, attr){
        return attr.replace('-h.png', '.png');
       });
    }),*/

    $('#eventnav').on('click', 'a', function () {

        if(eventheading==this.href.split('#')[1]) return;
        
        clearData();            

        smallNav();
        eventheading = this.href.split('#')[1];
        $.getJSON('eventdata/'+eventheading+'.json', function (data) {
        $('#event-register').append('<h3>'+data['event-heading']+'</h3>');
        $('#rules').append('<h4>Rules</h4><ul class="tick"><li>'+data['rules'].join('</li><li>')+'</li></ul>');
        $('#hall').append('<h4>Hall of Fame</h4><ul class="star"><li>'+data['hall'].join('</li><li>')+'</ul>');
        $('#eventcontact').append('<h4>Contacts</h4>');
        $('#eventcontact').append('<a class="btn btn--primary full-width" href="register.php">Register Now!</a>');

        showAll();

        });
    });
  });