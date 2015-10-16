<?php

class Dashboard extends Controller
{

    public function index()
    {
        if (!Owner::isAuthenticated() && !Agent::isAuthenticated()) {

            $this->redirect('/');
        } else {
            $this->view('dashboard/index');
        }
    }


    public function setSidebar()
    {
        $sidebar = $_POST['sidebar'];
        $_SESSION['sidebar'] = $sidebar;
        echo "Session['sidebar']: " . $_SESSION['sidebar'];
    }

    public function selectedProperty()
    {
        $num = $_POST['selected'];
        $properties = $_SESSION['user']->getProperties();
        $_SESSION['selectedProperty'] = $properties[$num];
        echo $_SESSION['selectedProperty']->address;
    }


    public function loadChatBox()
    {
        $pID = $_POST['pID'];

        try {
            $db = Database::getInstance();
            $statement = $db->prepare("SELECT * FROM chat WHERE property_id = :pID ORDER BY chat_id ASC ");
            $statement->bindParam(':pID', $pID);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($result);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }


    public function sendChatMessage()
    {
        $userID = $_POST['user'];
        $message = $_POST['message'];
        $pID = $_POST['pID'];
        $type = $_POST['type'];

        //enter chat message into Database
        try {
            $db = Database::getInstance();
            $statement = $db->prepare("INSERT INTO chat(super_user_id, property_id, message, user_type)
            VALUES(:super_user_id, :property_id, :message, :user_type)");
            $statement->execute(array(
                "super_user_id" => $userID,
                "property_id" => $pID,
                "message" => $message,
                "user_type" => $type
            ));

            #close db connection
            $db = NULL;
            exit();

        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }

    public function getChatRows()
    {
        $pID = $_POST['propertyID'];


        //enter chat message into Database
        try {
            $db = Database::getInstance();


            $result = $db->prepare("SELECT * FROM chat WHERE property_id = :property_id");
            $result->bindParam(':property_id', $pID);
            $result->execute();
            $count = $result->rowCount();
            echo $count;

            #close db connection
            $db = NULL;
            exit();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }

    public function addEvent()
    {
        $pID = $_POST['propertyID'];
        $eventName = $_POST['eventName'];
        $eventTime = $_POST['timepicker1'];
        $eventInterval = $_POST['interval'];
        $description = $_POST['description'];
        $eventDate = $_POST['date'];
        $email = $_POST['email'];

        $addEvent = CalendarEvents::addEvent($pID, $eventName, $eventTime, $eventInterval, $description, $eventDate, $email);

        if ($addEvent == true) {
            $_SESSION['eventAdded'] = "true";
            header('Location:../PropertyOwner/calendar');
            exit();

        } else {
            $_SESSION['eventAdded'] = "false";
            header('Location:../PropertyOwner/calendar');
            exit();
        }

    }

    public function getPropertyEvents()
    {
        $pID = $_POST['selected'];


        //enter chat message into Database
        try {
            $db = Database::getInstance();


            $statement = $db->prepare("SELECT * FROM calendar WHERE propertyID = :propertyID ");
            $statement->bindParam(':propertyID', $pID);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            for ($i = 0; $i < count($result); $i++) {
                echo '<div id="'.$result[$i]->eventID.'" class="selectStyle">
                <div id="selectInfo">
               <h3>'.$result[$i]->eventName.'</h3>';
                echo '<p>Date set: '.$result[$i]->eventDate.'</p>';
                echo '<p>Interval: '.$result[$i]->eventInterval.'</p>';
                if($result[$i]->eventTime != ""){echo '<p>Time: '.$result[$i]->eventTime.'</p>';}
                if($result[$i]->description != ""){echo '<p>Description: '.$result[$i]->description.'</p>';}
                echo '</div><button type="button" class="btn btn-danger btn-lg removeEvent">Remove</button></div></div>';}

            #close db connection
            $db = NULL;
            exit();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }


    public function removePropertyEvents()
    {
        $eID = $_POST['remove'];


        //enter chat message into Database
        try {
            $db = Database::getInstance();


            $statement = $db->prepare("DELETE FROM calendar WHERE eventID = :eventID ");
            $statement->bindParam(':eventID', $eID);
            $statement->execute();
            #close db connection
            $db = NULL;
            exit();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }


}