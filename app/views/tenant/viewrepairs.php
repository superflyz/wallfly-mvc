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
                            foreach ($result as $row) {
                                echo "<p>Timestamp: " . $row['timestamp'] . " Subject: " . $row['subject'] .
                                    " Description: " . $row['description'] . " Severity: " . $row['severity_level'] .
                                    " Status: " . $row['status'] . " Image: " . $row['image'];
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