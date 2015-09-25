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
    $sidebar = $_POST['sidebar'];
    $_SESSION['sidebar'] = $sidebar;
    echo "Session['sidebar']: " . $_SESSION['sidebar'];

    //$this->view('dashboard/setSidebar');

    }

}