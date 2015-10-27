<?php

class PropertyControl extends Controller
{

  public function delete()
  {
    if (Agent::isAuthenticated() || Owner::isAuthenticated()) {
      $_SESSION['selectedProperty']->delete();
      unset($_SESSION['selectedProperty']);
      if (Agent::isAuthenticated()) {
        $this->redirect('/propertyagent/index');
      } else {
        $this->redirect('/propertyowner/index');
      }
    } else {
      $this->redirect('/');
    }
  }

}