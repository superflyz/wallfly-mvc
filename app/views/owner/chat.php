<audio id="audiotag1" src="<?=WEBDIR?>/sounds/messageAlert.mp3" preload="auto"></audio>

<?php
    require_once '../app/views/templates/interfaceStart.php';
?>
<!--Content here-->
<audio id="audiotag1" src="../sounds/messageAlert.mp3" preload="auto"></audio>

<div class="row">
    <div class="col-md-12">
        <div class="page_heading">
            <p>Messages</p>
            <hr />
        </div>
    </div>
</div>
</div>
</div>

<!-- Chat box -->
<div class="row bottom-section">
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div id="chat_system">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <p>
                    Chat for <?php if ($selectedProperty != "") {
                        echo '' . $selectedProperty->address;
                    }; ?>
                    </p>
                </div>
                <div id="chatbox" class="panel-body">
                    <ul id="chatlist">

                    </ul>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <textarea id="btn-input-msg" class="form-control custom-control btn-msg-inpt" placeholder="Type your message here..." ></textarea><span class="input-group-addon btn-msg-snd" type="submit" id="btn-send-msg">Send</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



<!-- End Chatbox -->

<script src="/wallfly-mvc/public/js/textarea-autosize.js"></script>
<script type="text/javascript">
    function play_single_sound() {
        document.getElementById('audiotag1').play();
    }

    // assign current username to jquery var and use it in SendMessage function
    var ID = <?php echo "'".$_SESSION['user']->id."'";?>;
    var pID =  <?php echo "'".$pID."'";?>;
    var userType = <?php echo "'".$userType."'";?>;

    $(document).ready(function () {
           chatLoad(ID,pID);
        $("#btn-send-msg").click(function () {
            var type="";
            switch (userType) {
                case '0':
                    type = "TENANT";
                    break;
                case '1':
                    type = "AGENT";
                    break;
                case '2':
                    type = "OWNER";
                    break;
                case '3':
                    type = "REALESTATE";
                    break;
            }

            SendMessage(ID, pID, type);


        });
        autosize(document.querySelectorAll('textarea'));
       
        $(".btn-msg-snd").click(function() {
            $("textarea").css('height', 'auto');
        });
 

    });
    

    document.title = 'Messages - WallFly';

</script>
<?php
require_once '../app/views/templates/interfaceEnd.php';
?>