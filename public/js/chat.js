function chatLoad(userID,propertyID) {
    if (propertyID !== "") {
        jQuery.ajax({
            url: '/wallfly-mvc/public/dashboard/loadChatBox',
            type: "POST",
            dataType : 'json',
            data: {
                pID: propertyID
            },

            success: function (response) {
                $('#chatlist').empty();
                var chatobj = response;
                //alert(chatobj[0].message);
                for (var i = 0; i < chatobj.length; i++) {
                    var parseobj = chatobj[i];
                    if (parseobj.super_user_id == userID) {
                        $("#chatbox ul").append("<li class='left clearfix'>" +
                            "<span class='chat-img pull-left'><img src='' class='img-circle' /></span>" +
                            "<div class='chat-body clearfix'><div class='header'><strong class='primary-font'>Me</strong> <small class='pull-right text-muted'>" +
                            "<span class='glyphicon glyphicon-time'></span>" + parseobj.send_at + "</small></div><p>" + parseobj.message + "</p></div></li>");


                    } else {
                        $("#chatbox ul").append("<li class='left clearfix'>" +
                            "<span class='chat-img pull-left'><img src='' class='img-circle' /></span>" +
                            "<div class='chat-body clearfix'><div class='header'><strong class='primary-font'>" + parseobj.user_type + "</strong> <small class='pull-right text-muted'>" +
                            "<span class='glyphicon glyphicon-time'></span>" + parseobj.send_at + "</small></div><p>" + parseobj.message + "</p></div></li>");


                    }

                }
            }

        });
        //setInterval(chatRefresh, 2000);
        setTimeout(function () {
            $("#chatbox").scrollTop($("#chatbox")[0].scrollHeight);
        }, 50);
    }

    function chatRefresh() {
        if (propertyID == "") {
            return;
        }
        //alert("test");
        jQuery.ajax({
            url: 'loadChatBox.php',
            type: "POST",
            data: {
                pID: propertyID
            },

            success: function (response) {
                $('#chatlist').empty();
                var obj = eval("(" + response + ')');
                for (var i = 0; i < obj.length; i++) {
                    var parseobj = obj[i];
                    if (parseobj.username == userID) {
                        $("#chatbox ul").append("<li class='left clearfix'>" +
                            "<span class='chat-img pull-left'><img src='../img/me.png' alt='User Avatar' class='img-circle' /></span>" +
                            "<div class='chat-body clearfix'><div class='header'><strong class='primary-font'>" + userID + "</strong> <small class='pull-right text-muted'>" +
                            "<span class='glyphicon glyphicon-time'></span>" + parseobj.chatdate + "</small></div><p>" + parseobj.msg + "</p></div></li>");


                    } else {
                        $("#chatbox ul").append("<li class='left clearfix'>" +
                            "<span class='chat-img pull-left'><img src='../img/you.png' alt='User Avatar' class='img-circle' /></span>" +
                            "<div class='chat-body clearfix'><div class='header'><strong class='primary-font'>" + parseobj.username + "</strong> <small class='pull-right text-muted'>" +
                            "<span class='glyphicon glyphicon-time'></span>" + parseobj.chatdate + "</small></div><p>" + parseobj.msg + "</p></div></li>");


                    }

                }
            }

        });
    }


}


function SendMessage(username, propertyID) {

    var theMessage = $("#btn-input").val();
    var theUser = username;
    var thePID = propertyID;
    if ((theMessage == "") || (thePID == "")) {

        return;

    } else {

        jQuery.ajax({
            url: 'chat_send_ajax.php',
            type: "POST",
            data: {
                message: theMessage,
                user: theUser,
                pID: thePID
            },
            success: function (result) {
                $("#btn-input").val('');
                //LoadChatBox(propertyID,username);
                setTimeout(function () {
                    $("#chatbox").scrollTop($("#chatbox")[0].scrollHeight);
                }, 2000);

            }

        });

    }
}
