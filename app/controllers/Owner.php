<?php

class Owner extends Controller
{

  public function submit()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {

    }
    else
    {
      $this->redirect('/');
    }
  }

}