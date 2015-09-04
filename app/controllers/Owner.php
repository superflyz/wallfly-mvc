<?php


class Owner extends Controller
{

  public function submit()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      print_r($_POST);
      $validcheck = Validator::validate($_POST);
      if (!$validcheck['valid']) {
        if ($validcheck['error_code'] === ERROR_PASSWORDS_NOT_MATCH) {
          echo 'passwords did not match';
        } elseif ($validcheck['error_code'] === ERROR_EMPTY) {

        }
      } else {
        echo 'valid';
      }
    } else {
      $this->redirect('/');
    }
  }

}
