<?php
/**
 * Created by PhpStorm.
 * User: jimmykovacevic
 * Date: 3/10/2015
 * Time: 4:51 PM
 */
require_once '../app/views/templates/interfaceStart.php';
?>
    <!--Content here-->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="wlcm-h1">Notifications</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <?php
                    $notifications = Notification::getAllNotifications($_SESSION['user']->id);
                    if ($notifications) {
                        foreach ($notifications as $notification) {
                            ?>
                            <p>Date: <?php echo $notification['date']?> Message: <?php echo $notification['message']?></p>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php
require_once '../app/views/templates/interfaceEnd.php';
?>