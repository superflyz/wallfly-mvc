<?php

class Owner extends Model
{

  public $id, $email, $password, $firstname, $lastname, $phone, $address, $photo;

  public function save()
  {
    parent::save();

    $db = Database::get_instance();
    $result = $db->query("SELECT id FROM owner WHERE email='" . $this->email . "'");
    $result = $result->fetchObject();
    $this->id = $result->id;
  }

  public static function create($data)
  {
    $owner = new Owner($data);
    $owner->save();
    return $owner;
  }

  public static function get_one($id)
  {
    $db = Database::get_instance();
    $result = $db->query("SELECT * FROM owner WHERE id=$id");
    $result = $result->fetch(PDO::FETCH_ASSOC);
    return new Owner($result);
  }

  public static function is_authenticated()
  {
    // uncomment these following 2 lines if you've done testing
    // session_start();
    // return isset($_SESSION['email']);

    // if you wanna test the dashboard without logging in,
    // change the following into 'return TRUE;'
    return FALSE;
  }

}