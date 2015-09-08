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

}
