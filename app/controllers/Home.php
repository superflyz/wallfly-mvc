<?php

class Home extends Controller
{

  public function index()
  {
    // if not logged in
    if (!User::is_authenticated())
    {
      $this->view('home/index');
    }
    else
    {
      // TODO: redirect to dashboard
      $this->redirect('/dashboard');
    }
  }
  
}