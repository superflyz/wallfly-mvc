<?php

class Tenant extends Super_User
{

  public function save()
  {
    parent::save();
    try {
      $db = Database::getInstance();
      $statement = $db->prepare("INSERT INTO tenant VALUES (:super_user_id)");
      $result = $statement->execute([
        ":super_user_id" => $this->id
      ]);
      $db->commit();
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  //Gets and returns a Tenant from the database if one exists, false otherwise. Data should be in the form of
  //key, value pairs.
  public static function get($data)
  {
    $query = "SELECT * FROM tenant, super_user WHERE tenant.super_user_id = super_user.id AND ";
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
          return new Tenant($row);
        }, $result);
        return $result;
      } else {
        return false;
      }
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }

  //Checks to see if a user logged in is a Tenant. Returns true if they are a Tenant, false otherwise.
  public static function isAuthenticated()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    return (isset($_SESSION['usertype']) && $_SESSION['usertype'] === USERTYPE_TENANT &&
      isset($_SESSION['user']));
  }

  //Gets and returns an array of all properties linked to the tenant if any exist.
  public function getProperties()
  {
    try {
      $db = Database::getInstance();
      $statement = $db->prepare("SELECT * FROM property WHERE tenant_id=:tenant_id");

      $statement->execute(['tenant_id' => $this->id]);
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

}
