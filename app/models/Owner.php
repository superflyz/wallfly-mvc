<?php

class Owner extends Super_User
{

  public function save()
  {
    parent::save();

    $db = Database::get_instance();
    $statement = $db->prepare("INSERT INTO owner VALUES (:id)");
    $statement->execute([
        ':id' => $this->id
    ]);
    $db->commit();
  }

  public static function is_authenticated()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    return (isset($_SESSION['usertype']) && $_SESSION['usertype'] === USERTYPE_OWNER &&
      isset($_SESSION['userid']));
  }

  public static function get_by_email($email)
  {
    try {
      $db = Database::get_instance();
      $result = $db->query("SELECT * FROM owner, super_user WHERE owner.super_user_id = super_user.id AND super_user.email='{$email}'");
      $result = $result->fetchObject();
      if ($result) {
        return new Owner($result);
      } else {
        return NULL;
      }
    } catch (Exception $e) {

    }
  }

  public static function get_one($id)
  {
    try {
      $db = Database::get_instance();
      $result = $db->query("SELECT * FROM owner, super_user WHERE owner.super_user_id = super_user.id AND super_user.id='{$id}'");
      $result = $result->fetchObject();
      if ($result) {
        return new Owner($result);
      } else {
        return NULL;
      }
    } catch (Exception $e) {

    }
  }

}
