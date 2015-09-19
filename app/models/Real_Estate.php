<?php

class Real_Estate extends Model
{

  public $id, $email, $name, $password, $address, $phone, $photo;

  public static function isAuthenticated()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    return (isset($_SESSION['usertype']) && $_SESSION['usertype'] === USERTYPE_REALESTATE &&
      isset($_SESSION['user']));
  }

  public static function get($data = '_all')
  {
    if ($data === '_all') {
      $query = "SELECT * FROM real_estate";
    } else {
      $query = "SELECT * FROM real_estate WHERE ";
      $i = 0;
      foreach ($data as $key => $value) {
        $query .= $key . '=:' . $key;
        if ($i !== sizeof($data)-1) {
          $query .= ' AND ';
        }
        $i++;
      }
    }
    try {
      $db = Database::getInstance();
      $statement = $db->prepare($query);
      if ($data === '_all') {
        $statement->execute();
      } else {
        $statement->execute($data);
      }
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      $result = array_map(function($row) {
        return new Real_Estate($row);
      }, $result);
      return $result;
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }

}
