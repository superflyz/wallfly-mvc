<?php

class Database
{

  private static $db;

  public static function get_instance()
  {
    if (self::$db === NULL)
    {
      try
      {
        self::$db = new PDO(DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_PERSISTENT => true));
      }
      catch (PDOException $e)
      {
        echo 'Error!: ' . $e->getMessage();
        die();
      }
    }
    return self::$db;
  }

}
