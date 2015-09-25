<?php

class Dashboard extends Controller
{

  public function index()
  {
    if (!Owner::isAuthenticated()) {

      $this->redirect('/');
    }
    else
    {
      $this->view('dashboard/index');
    }
  }



    public function setSidebar(){
    echo 'hello';
    //$this->view('dashboard/setSidebar');

    }

}