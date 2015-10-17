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
            $statement = $db->prepare("INSERT INTO notifications (super_user_id, notification, viewed) VALUES ($userId,
              :notification, 0)");
            $result = $statement->execute(['notification' => $notification]);
            return $result;
        } catch (Exception $e) {
            $db = NULL;
            echo 'Error: ' . $e->getMessage();
        }
        return false;
    }

    public static function getUnreadNotifications($userId)
    {
        if ($userId == NULL) {
            return false;
        }
        try {
            $db = Database::getInstance();
            $statement = $db->prepare("SELECT * FROM notifications WHERE super_user_id=:super_user_id AND
              viewed=0");
            $statement->execute(['super_user_id' => $userId]);
            $result = Array();
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $tmp = Array("message" => $row['notification']);
                array_push($result, $tmp);
            }
            return $result;
        } catch (Exception $e) {
            $db = NULL;
            echo 'Error: ' . $e->getMessage();
        }
        return false;
    }
}


?>