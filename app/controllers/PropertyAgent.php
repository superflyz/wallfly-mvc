<?php

class PropertyAgent extends Controller
{

  public function signup()
  {
    echo 'TODO: agent sign up page';
  }

  public function index()
  {
    if (!Agent::isAuthenticated()) {
      $this->redirect("/");
    } else {
      $this->view("agent/index", $_SESSION['user']);
    }
  }

  public function home()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $this->view('agent/home');
    }
  }

}