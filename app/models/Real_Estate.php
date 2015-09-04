<?php

class Real_Estate extends Model
{

  public $id, $email, $name, $password, $address, $phone, $photo;

  public static function is_authenticated()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    return (isset($_SESSION['usertype']) && $_SESSION['usertype'] === USERTYPE_REALESTATE &&
      isset($_SESSION['userid']));
  }

}
