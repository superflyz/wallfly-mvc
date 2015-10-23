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
<div class="row">
    <div class="col-md-12">
        <div class="page_heading">
            <p>Notifications</p>
            <hr />
        </div>
    </div>
</div>
</div>
</div>

<div class="row bottom-section">
    <div class="col-md-12">
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


<?php
require_once '../app/views/templates/interfaceEnd.php';
?>