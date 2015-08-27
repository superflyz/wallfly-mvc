<?php

class Home extends Controller
{

  public function index()
  {
    // if not logged in
    if (!self::is_authenticated())
    {
      $this->view('home/index');
    }
    else
    {
      // TODO: redirect to dashboard
    }
  }

  // helper method
  protected static function is_authenticated()
  {
    session_start();
    return isset($_SESSION['email']);
  }
  
}