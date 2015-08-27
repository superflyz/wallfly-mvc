<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
  
  protected $table = 'user';

  public static function is_authenticated()
  {
    // session_start();
    // return isset($_SESSION['email']);

    return FALSE;
  }

}