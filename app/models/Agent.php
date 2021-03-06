<?php

class Agent extends Super_User
{

  public $real_estate_id;

  //Saves information to the agent table
  public function save()
  {
    parent::save();

    try {
      $db = Database::getInstance();
      $statement = $db->prepare("INSERT INTO agent VALUES (:super_user_id, :real_estate_id)");
      $x = $statement->execute([
        ':super_user_id' => $this->id,
        ':real_estate_id' => $this->real_estate_id
      ]);
      $db->commit();
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  //Gets data from the agent table. Data needs to contain the key and value to search the database.
  //Returns an object of type Agent with the relevant fields, otherwise returns false if no match found.
  public static function get($data)
  {
    $query = "SELECT * FROM agent, super_user WHERE agent.super_user_id = super_user.id AND ";
    $i = 0;
    foreach ($data as $key => $value) {
      $query .= $key . '=:' . $key;
      if ($i !== sizeof($data)-1) {
        $query .= ' AND ';
      }
      $i++;
    }
    try {
      $db = Database::getInstance();
      $statement = $db->prepare($query);
      $statement->execute($data);
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      if ($result) {
        $result = array_map(function($row) {
          return new Agent($row);
        }, $result);
        return $result;
      } else {
        return false;
      }
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }

  //Check to see if the user currently logged in is an agent. Returns true if they are an Agent, false otherwise.
  public static function isAuthenticated()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    return (isset($_SESSION['usertype']) && $_SESSION['usertype'] === USERTYPE_AGENT &&
      isset($_SESSION['user']));
  }

  //Returns an array of properties which the agent is linked to.
  public function getProperties()
  {
    try {
      $db = Database::getInstance();
      $statement = $db->prepare("SELECT * FROM property WHERE agent_id=:agent_id");
      $statement->execute(['agent_id' => $this->id]);
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      $result = array_map(function($row) {
        return new Property($row);
      }, $result);
      return $result;
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
    return false;
  }

  public function getRealEstate()
  {
    $realest = Real_Estate::get(['id' => $this->real_estate_id]);
    return $realest ? $realest[0] : false;
  }

}
