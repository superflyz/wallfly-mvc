<?php

class Dashboard extends Controller
{

  public function index()
  {
    if (!Owner::isAuthenticated()) {

      $this->redirect('/');
    }
    else
    {
      $this->view('dashboard/index');
    }
  }



  public function setSidebar(){
    $sidebar = $_POST['sidebar'];
    $_SESSION['sidebar'] = $sidebar;
    echo "Session['sidebar']: " . $_SESSION['sidebar'];



    }

  public function selectedProperty(){
    $num = $_POST['selected'];
    $properties = $_SESSION['user']->getProperties();
    $_SESSION['selectedProperty'] = $properties[$num];
    echo $_SESSION['selectedProperty']->address;



  }



  public function loadChatBox(){
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
    //initialise Database Handler
//    try {
//      $DBH = Database::getInstance();
//      $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
//    } catch (PDOException $e) {
//      echo "Unable to connect";
//      //file_put_contents("'".WEBDIR.'/log/PDOerrorlog.txt', $e->getMessage(), FILE_APPEND);
//      exit();
//    }
//
//    //return rows related to the property ID in json string
//    try {
//      $chatArray = [];
//      $statement = $DBH->prepare("SELECT * FROM chat WHERE property_id = :pID ORDER BY chat_id ASC ");
//      $statement->bindParam(':pID', $pID);
//      $statement->execute();
//      while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
//        $chatArray[] = $row;
//      }
//      echo json_encode($chatArray);
//      #close db connection
//      $DBH = NULL;
//      exit();
//
//
//    } catch (PDOException $e) {
//      echo "Unable to get messages";
//      //file_put_contents(WEBDIR.'/log/PDOerrorlog.txt', $e->getMessage(), FILE_APPEND);
//      exit();
//    }



  }

}