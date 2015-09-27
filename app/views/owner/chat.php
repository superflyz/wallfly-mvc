<audio id="audiotag1" src="<?=WEBDIR?>/sounds/messageAlert.mp3" preload="auto"></audio>
<?php

//include(__DIR__ . "/../classes/PropertyFunctions.php");
//require_once(__DIR__ . '/../logincheck.php');

//set up page variables
$_SESSION['propertyId'] = "";
$userID = $_SESSION["user"]->id;
$userType = $_SESSION["usertype"];
$properties = [];
$selectedProperty = "";
$pID = '';


//set the propertyID from the $_SESSION['selectedChatProperty'] if set
if (isset($_SESSION['selectedProperty'])) {
    $selectedProperty = $_SESSION['selectedProperty'];
    //$pID = PropertyFunctions::GetPropertyID($userName, $userType, $selectedProperty);
    $pID = $_SESSION['selectedProperty']->id;
    //unset($_SESSION['selectedChatProperty']);

}

//set pID if a tenant because only has one property to display
//if ($userType == 'TENANT') {
//    $tenantArray = [];
//    $tenantArray = PropertyFunctions::GetProperties($userName, $userType);
//    $selectedProperty = $tenantArray[0];
//    $pID = PropertyFunctions::GetPropertyID($userName, $userType, $selectedProperty);
//
//}

?>

<?php
    require_once '../app/views/templates/interfaceStart.php';
?>
<!--Content here-->
<audio id="audiotag1" src="../sounds/messageAlert.mp3" preload="auto"></audio>
<!-- create address dropdown list only if agent or owner usertype -->
<?php if ($userType == 2) {
//    if ($properties = $_SESSION['user']->getProperties()) {
//      echo $properties[1]->address;
//    }

      $properties = $_SESSION['user']->getProperties();

    //dropdown for property list
    echo '<div class="container">

            <div class="btn-group">
                <a class="btn btn-primary dropdown-toggle show-properties selector" data-toggle="dropdown" href="#" style="margin-left: 15px;">Select a Property</a>
            </div>';

}

?>
<div id="reducedPadding" class="container">
    <div id="propertyHolder">
        <input placeholder="type to search..." id="box" type="text"/>
        <ul class="navList ">
            <?php

            for($i=0;$i<count($properties);$i++){

                echo '<li id="'.$i.'"><a>' . $properties[$i]->address . '</a></li>';
            }
            ?>
        </ul>
    </div>
</div>


<!-- Chat box -->
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Chat <?php if ($selectedProperty != "") {
                        echo ' for ' . $selectedProperty->address;
                    }; ?>
                </div>
                <div id="chatbox" class="panel-body">
                    <ul id="chatlist">

                    </ul>
                </div>
            </div>
            <div class="panel-footer">
                <div class="input-group">
                    <textarea id="btn-input" type="text" class="form-control input-sm"
                              placeholder="Type your message here..."/></textarea>
                        <span class="input-group-btn">
                            <button class="btn btn-success btn-sm" id="btn-send">Send</button>
                        </span>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Chatbox -->


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
        $("#btn-send").click(function () {
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
</script>
<?php
require_once '../app/views/templates/interfaceEnd.php';
?>