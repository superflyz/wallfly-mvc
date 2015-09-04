<?php

class Agent extends Super_User
{

  public $real_estate_id;

  public function save()
  {
    parent::save();

    try {
      $db = Database::get_instance();
      $statement = $db->prepare("INSERT INTO agent VALUES (:super_user_id, :real_estate_id)");
      $statement->execute([
        ':super_user_id' => $this->id,
        ':real_estate_id' => $this->real_estate_id
      ]);
      $db->commit();
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public static function is_authenticated()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    return (isset($_SESSION['usertype']) && $_SESSION['usertype'] === USERTYPE_AGENT &&
      isset($_SESSION['userid']));
  }

}
