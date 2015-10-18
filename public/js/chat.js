var previousChatRows = 0;
var numChatRows = 0;

function chatLoad(userID,propertyID) {
    if (propertyID !== "") {
        jQuery.ajax({
            url: '/wallfly-mvc/public/dashboard/loadChatBox',
            type: "POST",
            dataType: 'json',
            data: {
                pID: propertyID
            },

            success: function (response) {
                $('#chatlist').empty();
                var chatobj = response;

                for (var i = 0; i < chatobj.length; i++) {
                    var parseobj = chatobj[i];
                    if (parseobj.super_user_id == userID) {
                        $("#chatbox ul").append(
                            "<li class='current-user pull-right'>" +
                            "<div class='user-img pull-right' data-toggle='tooltip' title='" + parseobj.send_at + "'>" + 
                            "<img src='' class='img-circle' />" +
                            "<strong>ME</strong></div>" +                                                         "<div class='bubble-arw-right'>" + 
                            "<div class='msg-txt'><p>" + nl2br(parseobj.message) + "</p></div>" + "</div></li>");


                    } else {
                        $("#chatbox ul").append(
                            "<li class='other-user pull-left'>" +
                            "<div class='user-img pull-left' data-toggle='tooltip' title='" + parseobj.send_at + "'>" + 
                            "<img src='' class='img-circle' />" +
                            "<strong>" + parseobj.user_type + "</strong></div>" +                                 "<div class='bubble-arw-left'>" + 
                             "<div class='msg-txt'><p>" + nl2br(parseobj.message) + "</p></div>" + "</div></li>");
                            
                            
                        
                    }

                }
            }

        });
        setInterval(chatRefresh, 2000);
        setTimeout(function () {
            $("#chatbox").scrollTop($("#chatbox")[0].scrollHeight);
        }, 50);
    }

    function chatRefresh() {
        if (propertyID == "") {
            return;
        }

        numRowCheck(propertyID);
        if (numChatRows > previousChatRows) {

            jQuery.ajax({
                url: '/wallfly-mvc/public/dashboard/loadChatBox',
                type: "POST",
                dataType: 'json',
                data: {
                    pID: propertyID
                },

                success: function (response) {

                    var currentHeight = $("#chatbox").scrollTop() + $("#chatbox").innerHeight()
                    var totalHeight = $("#chatbox")[0].scrollHeight;

                    $('#chatlist').empty();
                    var chatobj = response;

                    for (var i = 0; i < chatobj.length; i++) {
                        var parseobj = chatobj[i];
                        if (parseobj.super_user_id == userID) {
                            $("#chatbox ul").append(
                            "<li class='current-user pull-right'>" +
                            "<div class='user-img pull-right' data-toggle='tooltip' title='" + parseobj.send_at + "'>" + 
                            "<img src='' class='img-circle' />" +
                            "<strong>ME</strong></div>" +                                                         "<div class='bubble-arw-right'>" + 
                            "<div class='msg-txt'><p>" + nl2br(parseobj.message) + "</p></div>" + "</div></li>");


                        } else {
                            $("#chatbox ul").append(
                            "<li class='other-user pull-left'>" +
                            "<div class='user-img pull-left' data-toggle='tooltip' title='" + parseobj.send_at + "'>" + 
                            "<img src='' class='img-circle' />" +
                            "<strong>" + parseobj.user_type + "</strong></div>" +                                 "<div class='bubble-arw-left'>" + 
                             "<div class='msg-txt'><p>" + nl2br(parseobj.message) + "</p></div>" + "</div></li>");


                        }

                    }
                    if (previousChatRows != 0) {
                        play_single_sound();
                    }
                    if (currentHeight >= totalHeight) {
                        $("#chatbox").scrollTop($("#chatbox")[0].scrollHeight);
                    }
                    previousChatRows = numChatRows;
                }

            });
        }


    }
}


function SendMessage(userID, propertyID,userType) {

    var theMessage = $("#btn-input-msg").val();
    var theUser = userID;
    var thePID = propertyID;
    var theType = userType;
    if ((theMessage == "") || (thePID == "")) {

        return;

    } else {

        jQuery.ajax({
            url: '/wallfly-mvc/public/dashboard/sendChatMessage',
            type: "POST",
            data: {
                message: theMessage,
                user: theUser,
                pID: thePID,
                type: theType
            },
            success: function (result) {
                $("#btn-input-msg").val('');

                $("#chatbox").scrollTop($("#chatbox")[0].scrollHeight);

            }

        });

    }
}


function nl2br(str, is_xhtml) {
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

function numRowCheck(pid) {

    jQuery.ajax({
        url: '/wallfly-mvc/public/dashboard/getChatRows',
        type: "POST",
        data: {
            propertyID: pid
        },
        success: function (result) {
            numChatRows = result;

        }
    });

}

$(document).ready(function() {
    $("body").tooltip({ selector: '[data-toggle=tooltip]', placement: 'bottom' });
});
