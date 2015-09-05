<?php


class Owner extends Controller
{

  public function submit()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // 1. validate post data
      $validcheck = Validator::validate_owner_data($_POST);

      // 2. check if valid
      if (!$validcheck['valid']) {

        // 3a. if not, check the error code, handle each error accordingly
        if ($validcheck['error_code'] === ERROR_PASSWORDS_NOT_MATCH) {
          // password & password_repeat are different
          // TODO: handle the error
          echo 'passwords did not match';

        } elseif ($validcheck['error_code'] === ERROR_EMPTY) {
          // one of the fields left blank
          // TODO: handle the error

        } elseif ($validcheck['error_code'] === ERROR_NAME_CONTAINS_NUMERIC) {
          // either firstname or lastname contains numeric
          // TODO: handle the error
          echo "{$validcheck['field']} cannot contain numeric";

        } elseif ($validcheck['error_code'] === ERROR_EMAIL_NOT_IN_PROPER_FORMAT) {
          // email address doesn't pass the filter_var($var, FILTER_VALIDATE_EMAIL) function
          // TODO: handle the error

        } elseif ($validcheck['error_code'] === ERROR_PHONE_NOT_IN_PROPER_FORMAT) {
          // phone number contains character that is not numeric
          // TODO: handle the error

        } else {
          // 3b. if valid, sanitize the data & store in the database
          // TODO: sanitize data


          // TODO: store in database

          
        }
      } else {
        echo 'valid';
      }
    } else {
      $this->redirect('/');
    }
  }

}
