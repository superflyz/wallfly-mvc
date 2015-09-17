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
    require_once '../app/views/templates/header.php';
    require_once '../app/views/' . $view . '.php';
    require_once '../app/views/templates/footer.php';
  }

  /*
   * REDIRECT USER TO $location
   */
  public function redirect($location)
  {
    header('Location: ' . WEBDIR . $location);
  }

  public function send404()
  {
    // TODO
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
    echo 'The page you\'re trying to access is not found!';
  }

}
