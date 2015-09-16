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

  public static function isAuthenticated()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    return (isset($_SESSION['usertype']) && $_SESSION['usertype'] === USERTYPE_TENANT &&
      isset($_SESSION['user']));
  }

}
