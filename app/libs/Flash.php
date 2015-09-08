<?php

class Flash
{

  private static $message;

  public static function set($key, $value)
  {
    // if (session_status() == PHP_SESSION_NONE) {
    //   session_start();
    // }
    $_SESSION["flash.$key"] = $value;
  }

  public static function get($key)
  {
    // if (session_status() == PHP_SESSION_NONE) {
    //   session_start();
    // }
    if (!isset($_SESSION["flash.$key"])) {
      return false;
    }
    $value = $_SESSION["flash.$key"];
    self::unset_flash($key);
    return $value;
  }

  private static function unset_flash($key)
  {
    // if (session_status() == PHP_SESSION_NONE) {
    //   session_start();
    // }
    unset($_SESSION["flash.$key"]);
  }

}
