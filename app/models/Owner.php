<?php

class Owner extends Super_User
{

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

  public static function isAuthenticated()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    return (isset($_SESSION['usertype']) && $_SESSION['usertype'] === USERTYPE_OWNER &&
      isset($_SESSION['user']));
  }

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
      $result = array_map(function($row) {
        return new Owner($row);
      }, $result);
      return $result;
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }

}
