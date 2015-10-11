$(document).ready(function () {

    dzscal_init("#trauroradatepicker", {
        design_transitionDesc: 'tooltipDef',
        mode: 'datepicker',
        header_weekdayStyle: 'three',
        design_transition: 'fade'
    });

    dzscal_init("#trauroradatepicker2", {
        design_transitionDesc: 'tooltipDef',
        mode: 'datepicker',
        header_weekdayStyle: 'three',
        design_transition: 'fade'
    });

    function dp1_event(arg) {
        //console.log(arg);
        $('.event-receiver').html(arg);

    }

    var dp1 = document.getElementById('trauroradatepicker');
    if (dp1) {
        dp1.arr_datepicker_events.push(dp1_event);

    }

    $('#hidden').bind("DOMSubtreeModified", function () {
        var date = $('#hidden').html();
        var dateArray = date.split("-");
        var dateString = dateArray[1] + "-" + dateArray[0] + "-" + dateArray[2];
        $('#startDate').val(dateString);

    });

    function dp2_event(arg) {
        //console.log(arg);
        $('.event-receiver2').html(arg);

    }

    var dp2 = document.getElementById('trauroradatepicker2');
    if (dp2) {
        dp2.arr_datepicker_events.push(dp2_event);

    }

    $('#hidden2').bind("DOMSubtreeModified", function () {
        var date = $('#hidden2').html();
        var dateArray = date.split("-");
        var dateString = dateArray[1] + "-" + dateArray[0] + "-" + dateArray[2];
        $('#endDate').val(dateString);

    });
});
