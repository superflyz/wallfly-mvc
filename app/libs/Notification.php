<?php
/**
 * Created by PhpStorm.
 * User: jimmykovacevic
 * Date: 17/10/2015
 * Time: 6:07 PM
 */
class Notification
{
    public static function addNotification($userId, $notification)
    {
        if ($userId == NULL) {
            return false;
        }
        try {
            $db = Database::getInstance();
            if (isset($_SESSION['selectedProperty'])) {
                $tenantId = $_SESSION['selectedProperty']->getTenant();
                $statement = $db->prepare("INSERT INTO notifications (super_user_id, notification, viewed) VALUES ($userId,
                :notification, 0)");
                $result = $statement->execute(['notification' => $notification]);
                return $result;
            }
            return false;
        } catch (Exception $e) {
            $db = NULL;
            echo 'Error: ' . $e->getMessage();
        }
        return false;
    }

    public static function getNotifications($userId)
    {

    }
}


?>