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
<div class="row">
    <div class="col-md-12">
        <h1 class="wlcm-h1">Welcome <span class="user-color"> User!</span></h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <section id="select_property">
            <div class="select2-wrapper">
                <!-- create address dropdown list only if agent or owner usertype -->
                <?php if ($userType == 2) {
                //    if ($properties = $_SESSION['user']->getProperties()) {
                //      echo $properties[1]->address;
                //    }

                      $properties = $_SESSION['user']->getProperties();
                //
                }

                ?>
                
                <select id="select-country" class="demo-default" placeholder="Select a country...">
                    <option value=""><p><?php if ($selectedProperty != "") {
                        echo '' . $selectedProperty->address;
                    }; ?></p></option>
                    <option value="lol" id="country-not-found" class="hide">dsdsds</option>
                    <?php
                for($i=0;$i<count($properties);$i++){

                    echo '<option value="'.$i.'">' . $properties[$i]->address . '</option>';

                } ?>
                </select>
            </div>
        </section>
    </div>
</div>	
 

<script src="/wallfly-mvc/public/js/selectize/dist/js/standalone/selectize.js"></script>
<script src="/wallfly-mvc/public/js/selectize/js/selectize_no_results.js"></script>  
       
<script>    
    $('#select-country').selectize({
    plugins: ['no_results'],
    onChange: function(value) {
    var arraypos = value;
    jQuery.ajax({
        url: '/wallfly-mvc/public/dashboard/selectedProperty',
        type: "POST",
        data: {
            selected: arraypos
        },
        success: function (result) {
            window.location.reload();
        },
        error: function (result) {
            alert('Exeption:' + exception);
        }
    });
    }

    });

</script>



<?php
require_once '../app/views/templates/interfaceEnd.php';
?>



