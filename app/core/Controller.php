<?php

class Controller
{

  public function model($model)
  {
    require_once '../app/models/' .$model . '.php';
    return new $model();
  }

  public function view($view, $data = [])
  {
    require_once '../app/views/' . $view . '.php';
  }

  /*
   * REDIRECT USER TO $location
   */
  public function redirect($location)
  {
    header('Location: ' . WEBDIR . $location);
  }

}