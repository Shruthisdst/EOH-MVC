$(document).ready(function() {

    var isWider = $( '.wider' );
    isWider.next( '.container' ).addClass( 'push-down' );

    if(isWider.length) {
        $( window ).scroll(function() {

            var tp = $( 'html, body' ).scrollTop();

            if(tp > 50) {

                $( '.navbar' ).removeClass( 'wider') ;
            }
            else if(tp < 50) {
        
                $( '.navbar' ).addClass( 'wider') ;
            }
        }); 
    }
    
    var hloc = window.location.href;
    if(hloc.match('#')){

        var jumpLoc = $( '#' + hloc.split("#")[1] ).offset().top - 110;

        $("html, body").animate({scrollTop: jumpLoc}, 1);
    }

    $( '.navbar-nav li a').on('click', function(event){

        // event.preventDefault();

        var jumpLoc = $( '#' + $( this ).attr( "href" ).split('#')[1] ).offset().top - 110;

        $("html, body").animate({scrollTop: jumpLoc}, 100);
    });   

    $( '.sec-div li a').on('click', function(event){

        // event.preventDefault();

        var jumpLoc = $( '#' + $( this ).attr( "href" ).split('#')[1] ).offset().top - 110;

        $("html, body").animate({scrollTop: jumpLoc}, 100);
    });

    $( '#results_nav a').on('click', function(event){

        // event.preventDefault();

        var jumpLoc = $( '#' + $( this ).attr( "href" ).split('#')[1] ).offset().top - 105;

        $("html, body").animate({scrollTop: jumpLoc}, 1000);
    });

  var vieweroptions = {
        // inline: true,
        url: 'data-original',
        ready:  function (e) {
          console.log(e.type);
        },
        show:  function (e) {
          console.log(e.type);
        },
        shown:  function (e) {
          console.log(e.type);
        },
        hide:  function (e) {
          console.log(e.type);
        },
        hidden:  function (e) {
          console.log(e.type);
        },
        view:  function (e) {
          console.log(e.type, e.detail.index);
        },
        viewed:  function (e) {
          console.log(e.type, e.detail.index);
          // this.viewer.zoomTo(1).rotateTo(180);
        }
      };

    var viewer = new Viewer(document.getElementById('viewimages'),vieweroptions);

});


