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
        $userID = strip_tags($_POST['user']);
        $message = strip_tags($_POST['message']);
        $pID = strip_tags($_POST['pID']);
        $type = strip_tags($_POST['type']);

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
        $pID = strip_tags($_POST['propertyID']);
        $eventName = strip_tags($_POST['eventName']);
        $eventTime = strip_tags($_POST['timepicker1']);
        $eventInterval = strip_tags($_POST['interval']);
        $description = strip_tags($_POST['description']);
        $eventDate = strip_tags($_POST['date']);
        $email = strip_tags($_POST['email']);

        $addEvent = CalendarEvents::addEvent($pID, $eventName, $eventTime, $eventInterval, $description, $eventDate, $email);

        if ($addEvent == true) {
            $_SESSION['eventAdded'] = "true";
            //header('Location:../PropertyOwner/calendar');
            //exit();

        } else {
            $_SESSION['eventAdded'] = "false";
            //header('Location:../PropertyOwner/calendar');
            //exit();
        }
        if(Owner::isAuthenticated()) {
            Notification::addNotification($_SESSION['selectedProperty']->agent_id, "Event added for " . $_SESSION['selectedProperty']->address . ".");
            Notification::addNotification($_SESSION['selectedProperty']->tenant_id, "Event added for " . $_SESSION['selectedProperty']->address . ".");
            $this->redirect('/propertyowner/calendar');
        } elseif (Agent::isAuthenticated()) {
            Notification::addNotification($_SESSION['selectedProperty']->owner_id, "Event added for " . $_SESSION['selectedProperty']->address . ".");
            Notification::addNotification($_SESSION['selectedProperty']->tenant_id, "Event added for " . $_SESSION['selectedProperty']->address . ".");
            $this->redirect('/propertyagent/calendar');
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
                echo '<div id="'.$result[$i]->eventID.'" class="remove_event">
                <div class="re_event_name">
               <p>'.$result[$i]->eventName.'</p></div><div class="remove_event_info">';
                if($result[$i]->eventTime != ""){echo '<div class="col-md-4"><div class="re_event_time">Time<hr class="repair_hr"><p>'.$result[$i]->eventTime.'</p></div></div>';}
                echo '<div class="col-md-4"><div class="re_event_date">Date<hr class="repair_hr"><p>'.$result[$i]->eventDate.'</p></div></div>';
                echo '<div class="col-md-4"><div class="re_event_interval">Interval<hr class="repair_hr"><p>'.$result[$i]->eventInterval.'</p></div></div>';
                if($result[$i]->description != ""){echo '<div class="col-md-10"><div class="re_event_description">Description<hr class="repair_hr"><p>'.$result[$i]->description.'</p></div></div>';}
                echo '<div class="col-md-2"><div class="re_event_btn" id="'.$result[$i]->eventID.'"><button type="button" class="btn btn-remove-event removeEvent pull-right">Remove</button></div></div></div></div>';}

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

    public function setRead() {
        $userId = $_SESSION['user']->id;
        $ids = $_POST['ids'];

        Notification::setRead($userId, $ids);
    }


}