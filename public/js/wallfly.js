// Reference:(http://startbootstrap.com)


$( document ).ready(function() {
    
});


// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function () {
    $('a.page-scroll').bind('click', function (event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

// Highlight the top nav as scrolling occurs
$('body').scrollspy({
    target: '.navbar-fixed-top'
})

// Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function () {
    $('.navbar-toggle:visible').click();
});




$('#tab-nav li').click(function(event){
    event.preventDefault();
     var selected =  this.id;
     var href = $("a",this).attr('href');
    jQuery.ajax({
        url: '/wallfly-mvc/public/dashboard/setSidebar',
        type: "POST",
        data: {
            sidebar: selected
        },
        success: function (result) {
            window.location.href = href;

        },
        error: function (result) {
            alert('Exeption:' + exception);
        }

    });

});



// Reference: http://www.minimit.com/demos/vertical-center-bootstrap-3-modals

/* center modal */
function centerModals($element) {
    var $modals;
    if ($element.length) {
        $modals = $element;
    } else {
        $modals = $('.modal-vcenter:visible');
    }
    $modals.each(function (i) {
        var $clone = $(this).clone().css('display', 'block').appendTo('body');
        var top = Math.round(($clone.height() - $clone.find('.modal-content').height()) / 2);
        top = top > 0 ? top : 0;
        $clone.remove();
        $(this).find('.modal-content').css("margin-top", top);
    });
}
$('.modal-vcenter').on('show.bs.modal', function (e) {
    centerModals($(this));
});
$(window).on('resize', centerModals);


//http://stackoverflow.com/questions/23443579/how-to-stop-buttons-from-staying-depressed-with-bootstrap-3
$(".btn").mouseup(function(){
    $(this).blur();
})



$('[rel=tooltip]').tooltip() 
$("[data-toggle=tooltip]").tooltip({ placement: 'bottom'});


// http://stackoverflow.com/questions/13233304/how-to-make-jqueryui-tooltip-apply-only-on-focus
$(function () {
    $(".btn-group").tooltip({
        enabled: true
    }).on("focusin", function () {
        $(this)
//            .tooltip("close")
            .tooltip("disable");
    }).on("focusout", function () {
        $(this)
            .tooltip("enable")
            .tooltip("open");
    });

});

$(function(){

    $(".dropdown-menu").on('click', 'li a', function(){
      $(".select-p-text:first-child").text($(this).text());
      $(".select-p-text:first-child").val($(this).text());
   });

});
