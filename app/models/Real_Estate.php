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

  public function getProperties()
  {
    $agents = $this->getAgents();
    $properties = [];
    for ($i = 0; $i < sizeof($agents); $i++) {
      $props = $agents[$i]->getProperties();
      for ($j = 0; $j < sizeof($props); $j++) {
        $properties[] = $props[$j];
      }
    }
    return $properties;
  }

  public function getAgents()
  {
    $agents = Agent::get(['real_estate_id' => $this->id]);
    return $agents;
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
      if ($result) {
        $result = array_map(function($row) {
          return new Real_Estate($row);
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
