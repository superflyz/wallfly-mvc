<?php


class CalendarEvents
{

    public static function addEvent($propertyID, $eventName, $time, $interval, $description, $date, $email)
    {

        try {
            $DBH = Database::getInstance();
            $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Unable to connect";

            exit();
        }

        try {

            $statement = $DBH->prepare("INSERT INTO calendar(propertyID,eventName,eventTime,eventInterval,description,eventDate,userEmail)
                    VALUES(:propertyID, :eventName, :eventTime, :eventInterval, :description, :eventDate, :userEmail)");
            $statement->bindParam(':propertyID', $propertyID);
            $statement->bindParam(':eventName', $eventName);
            $statement->bindParam(':eventTime', $time);
            $statement->bindParam(':eventInterval', $interval);
            $statement->bindParam(':description', $description);
            $statement->bindParam(':eventDate', $date);
            $statement->bindParam(':userEmail', $email);

            $result = $statement->execute();

            if ($result) {
                $DBH = NULL;
                return true;

            } else {
                $DBH = NULL;
                return false;
                exit();
            }


        } catch (PDOException $e) {
            echo "Unable add event";

            $DBH = NULL;
            exit();
        }
    }

    public static function getAllEvents($userEmail)
    {

        try {
            $DBH = Database::getInstance();
            $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Unable to connect";

            exit();
        }

        try{
            $eventArray= [];
            $statement = $DBH->prepare("SELECT * FROM calendar WHERE userEmail = :userEmail");
            $statement->bindParam(':userEmail', $userEmail);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $eventArray[] = $row;
            }

            return $eventArray;

            #close db connection
            $DBH = NULL;
            exit();



        }catch (PDOException $e) {
            echo "Could not load all calendar events";

            $DBH = NULL;
            exit();
        }

    }


    public static function getPropertyEvents($pID)
    {
        try {
            $DBH = Database::getInstance();
            $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Unable to connect";

            exit();
        }

        try{
            $eventArray= [];
            $statement = $DBH->prepare("SELECT * FROM calendar WHERE propertyID = :propertyID");
            $statement->bindParam(':propertyID', $pID);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $eventArray[] = $row;
            }

            return $eventArray;

            #close db connection
            $DBH = NULL;
            exit();



        }catch (PDOException $e) {
            echo "Could not load calendar events";
            $DBH = NULL;
            exit();
        }

    }

}