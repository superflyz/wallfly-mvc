$(document).ready(function () {
    $("#propertyHolder").hide();
    $(".show-properties").click(function () {
        $("#propertyHolder").toggle();
    });

    $('.navList li ').on('click', function () {
        var arraypos = $(this).attr('id');
        jQuery.ajax({
            url: '/wallfly-mvc/public/dashboard/selectedProperty',
            type: "POST",
            data: {
                selected: arraypos
            },
            success: function (result) {
                $("#propertyHolder").hide();
                window.location.reload();
            },
            error: function (result) {
                alert('Exeption:' + exception);
            }
        });
    });

    $('#box').keyup(function () {
        var valThis = this.value.toLowerCase(),
            lenght = this.value.length;

        $('.navList>li>a').each(function () {
            var text = $(this).text(),
                textL = text.toLowerCase(),
                htmlR = '<b>' + text.substr(0, lenght) + '</b>' + text.substr(lenght);
            (textL.indexOf(valThis) == 0) ? $(this).html(htmlR).show() : $(this).hide();
        });

    });
});