<?php

class Dashboard extends Controller
{

  public function index()
  {
    if (!Owner::is_authenticated())
    {
      $this->redirect('/');
    }
    else
    {
      $this->view('dashboard/index');
    }
  }

}