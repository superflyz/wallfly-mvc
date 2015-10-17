/**
 * Created by jimmykovacevic on 17/10/2015.
 */
$(document).ready(function() {
    $("#notifications").click(function() {
        var ids = [];
        $(".notifs").each(function() {
            ids.push($(this).attr('id'));
        });
        var jsonString = JSON.stringify(ids);
        jQuery.ajax({
            url: '/wallfly-mvc/public/dashboard/setRead',
            type: "POST",
            data: {
                ids: jsonString,
            },
            cache: false,
            success: function (result) {

            },
        });

    });
});
