<?php

class Dashboard extends Controller
{

  public function index()
  {
    if (!User::is_authenticated())
    {
      $this->redirect('/');
    }
  }

}