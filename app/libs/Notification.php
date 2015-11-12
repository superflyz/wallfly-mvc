<?php
/**
 Notification class. Allows notifications to be added/retrieved to/from the database.
 */
class Notification
{
    //Adds a notification to the database. Takes the userId of a user and a notification string.
    //Returns true if added, false otherwise.
    public static function addNotification($userId, $notification)
    {
        if ($userId == NULL) {
            return false;
        }
        try {
            $db = Database::getInstance();
            date('Y-m-d', strtotime(str_replace('-', '/', date())));
            $statement = $db->prepare("INSERT INTO notifications (super_user_id, notification, viewed, date) VALUES (:user,
              :notification, 0, :date)");
            $result = $statement->execute(['user' => $userId, 'notification' => $notification, 'date' => date('Y-m-d', time())]);
            return $result;
        } catch (Exception $e) {
            $db = NULL;
            echo 'Error: ' . $e->getMessage();
        }
        return false;
    }

    //Gets all unread notifications based on the userId. Returns an array of all unread notifications if any exist for
    //the user, otherwise the array is empty.
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

    //Gets and returns all notifications for the userId. The returned array may be empty if none exist.
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

    //Sets a notification for a user to be read.
    public static function setRead($userId, $ids) {
        try {
            $db = Database::getInstance();
            $split = json_decode(stripslashes($ids));
            foreach ($split as $id) {
                $statement = $db->prepare("UPDATE notifications SET viewed=1 WHERE id=:id AND super_user_id=:user_id");
                $result = $statement->execute(['id' => $id, 'user_id' => $userId]);
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