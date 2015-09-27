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
                        $("#chatbox ul").append("<li class='left clearfix'>" +
                            "<span class='chat-img pull-left'><img src='' class='img-circle' /></span>" +
                            "<div class='chat-body clearfix'><div class='header'><strong class='primary-font'>Me</strong> <small class='pull-right text-muted'>" +
                            "<span class='glyphicon glyphicon-time'></span>" + parseobj.send_at + "</small></div><p>" + nl2br(parseobj.message) + "</p></div></li>");


                    } else {
                        $("#chatbox ul").append("<li class='left clearfix'>" +
                            "<span class='chat-img pull-left'><img src='' class='img-circle' /></span>" +
                            "<div class='chat-body clearfix'><div class='header'><strong class='primary-font'>" + parseobj.user_type + "</strong> <small class='pull-right text-muted'>" +
                            "<span class='glyphicon glyphicon-time'></span>" + parseobj.send_at + "</small></div><p>" + nl2br(parseobj.message) + "</p></div></li>");


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
                            $("#chatbox ul").append("<li class='left clearfix'>" +
                                "<span class='chat-img pull-left'><img src='' class='img-circle' /></span>" +
                                "<div class='chat-body clearfix'><div class='header'><strong class='primary-font'>Me</strong> <small class='pull-right text-muted'>" +
                                "<span class='glyphicon glyphicon-time'></span>" + parseobj.send_at + "</small></div><p>" + nl2br(parseobj.message) + "</p></div></li>");


                        } else {
                            $("#chatbox ul").append("<li class='left clearfix'>" +
                                "<span class='chat-img pull-left'><img src='' class='img-circle' /></span>" +
                                "<div class='chat-body clearfix'><div class='header'><strong class='primary-font'>" + parseobj.user_type + "</strong> <small class='pull-right text-muted'>" +
                                "<span class='glyphicon glyphicon-time'></span>" + parseobj.send_at + "</small></div><p>" + nl2br(parseobj.message) + "</p></div></li>");


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

    var theMessage = $("#btn-input").val();
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
                $("#btn-input").val('');

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
