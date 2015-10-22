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
            $statement = $db->prepare("INSERT INTO notifications (super_user_id, notification, viewed, date) VALUES ($userId,
              :notification, 0, :date");
            $result = $statement->execute(['notification' => $notification, 'date' => date("d-m-Y")]);
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
                $tmp = Array("message" => $row['notification'], "id" => $row['id']);
                array_push($result, $tmp);
            }
            return $result;
        } catch (Exception $e) {
            $db = NULL;
            echo 'Error: ' . $e->getMessage();
        }
        return false;
    }

    public static function getAllNotifications($userId)
    {
        if ($userId == NULL) {
            return false;
        }
        try {
            $count = 0;
            $db = Database::getInstance();
            $statement = $db->prepare("SELECT * FROM notifications WHERE super_user_id=:super_user_id");
            $statement->execute(['super_user_id' => $userId]);
            $result = Array();
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $tmp = Array("message" => $row['notification'], "id" => $row['id'], "date" => $row['date']);
                array_push($result, $tmp);
                $count++;
            }
            if ($count == 0) {
                return false;
            }
            return $result;
        } catch (Exception $e) {
            $db = NULL;
            echo 'Error: ' . $e->getMessage();
        }
        return false;
    }

    public static function setRead($userId, $ids) {
        try {
            $db = Database::getInstance();
            $split = json_decode(stripslashes($ids));
            foreach ($split as $id) {
                $statement = $db->prepare("UPDATE notifications SET viewed=1 WHERE id=:id AND super_user_id=:user_id");
                $result = $statement->execute(['id' => $id, 'user_id' => $userId]);
            }
            return $id;
        } catch (Exception $e) {
            $db = NULL;
            echo 'Error: ' . $e->getMessage();
        }
        return false;
    }
}


?>