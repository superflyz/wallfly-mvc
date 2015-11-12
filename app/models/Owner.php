<?php

class Owner extends Super_User
{

  //Saves data to the owner table
  public function save()
  {
    parent::save();

    $db = Database::getInstance();
    $statement = $db->prepare("INSERT INTO owner VALUES (:id)");
    $statement->execute([
        ':id' => $this->id
    ]);
    $db->commit();
  }

  //Returns a list of properties the owner is linked to.
  public function getProperties()
  {
    try {
      $db = Database::getInstance();
      $statement = $db->prepare("SELECT * FROM property WHERE owner_id=:owner_id");
      $statement->execute(['owner_id' => $this->id]);
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

  //Checks to see if the current use is logged in as an Owner. Returns true if they are logged in as an Owner,
  //false otherwise.
  public static function isAuthenticated()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    return (isset($_SESSION['usertype']) && $_SESSION['usertype'] === USERTYPE_OWNER &&
      isset($_SESSION['user']));
  }

  //Gets the data passed in from the owner table. Data should be in the form of an array map with relevant key, value
  //pairs. Returns an object of type Owner if it exists, false otherwise.
  public static function get($data)
  {
    $query = "SELECT * FROM owner, super_user WHERE owner.super_user_id = super_user.id AND ";
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
          return new Owner($row);
        }, $result);
        return $result;
      } else {
        return false;
      }
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }
}
