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
}