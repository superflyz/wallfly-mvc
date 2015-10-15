<?php

class Tenant extends Super_User
{
  public $property_id;

  public function save()
  {
    parent::save();
    try {
      $db = Database::getInstance();
      $statement = $db->prepare("INSERT INTO tenant VALUES (:super_user_id, :property_id)");
      $statement->execute([
        ":super_user_id" => $this->id,
        ":property_id" => $this->property_id
      ]);
      $db->commit();
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

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

  public static function isAuthenticated()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    return (isset($_SESSION['usertype']) && $_SESSION['usertype'] === USERTYPE_TENANT &&
      isset($_SESSION['user']));
  }

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
