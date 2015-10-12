<?php
/**
 * Created by PhpStorm.
 * User: jimmykovacevic
 * Date: 3/10/2015
 * Time: 4:51 PM
 */
require_once '../app/views/templates/interfaceStart.php';
require_once '../app/views/templates/selectProperty.php';
?>
    <!--Content here-->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="wlcm-h1">Repair Requests</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <?php if (isset($_SESSION['selectedProperty'])) { ?>
                        <div class="row text-left">
                            <?php
                            $result = $_SESSION['selectedProperty']->getRepairRequests();
                            if ($result) {
                                foreach ($result as $row) {
                                    if ($row['status'] == 0){
                                        $row['status']= "Pending";
                                    }elseif($row['status'] == 1){
                                        $row['status']= "Approved";
                                    }else{$row['status']= "Denied";}

                                    if ($row['severity_level'] == "low"){
                                        $row['severity_level']= WEBDIR."/img/repair/green.jpg";
                                    }elseif($row['severity_level'] == "medium"){
                                        $row['severity_level']= WEBDIR."/img/repair/orange.jpg";
                                    }else{$row['severity_level']= WEBDIR."/img/repair/red.jpg";}

                                    echo "<p>Timestamp: " . $row['timestamp'] . " Subject: " . $row['subject'] .
                                        " Description: " . $row['description'] . " Severity:  <image height='15' width='15' src='" . $row['severity_level'] . "'/>" .
                                        " Status: " . $row['status'] . " <image src='" . $row['image'] . "'/></p>";
                                }
                            }
                            ?>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>

<?php
require_once '../app/views/templates/interfaceEnd.php';
?>