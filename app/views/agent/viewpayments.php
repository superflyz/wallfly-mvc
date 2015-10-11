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
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="wlcm-h1">Payment History</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="container-fluid">
                <?php if (isset($_SESSION['selectedProperty'])) { ?>
                <div class="row text-left">
                    <?php
                    $result = $_SESSION['selectedProperty']->getPayments();
                    if ($result) {
                        foreach ($result as $row) {
                            echo "<p>Date: " . $row['time'] . " Amount: $" . $row['amount'];
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