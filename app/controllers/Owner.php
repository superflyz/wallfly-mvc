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
          Flash::set('error_message', 'Passwords did not match');

        } elseif ($validcheck['error_code'] === ERROR_EMPTY) {
          // one of the fields left blank
          // TODO: handle the error
          Flash::set('error_message', "Data required: {$validcheck['field']}");

        } elseif ($validcheck['error_code'] === ERROR_NAME_CONTAINS_NUMERIC) {
          // either firstname or lastname contains numeric
          // TODO: handle the error
          Flash::set('error_messsage', "{$validcheck['field']} cannot contain numeric");

        } elseif ($validcheck['error_code'] === ERROR_EMAIL_NOT_IN_PROPER_FORMAT) {
          // email address doesn't pass the filter_var($var, FILTER_VALIDATE_EMAIL) function
          // TODO: handle the error
          Flash::set('error_message', "Please enter valid email address");

        } elseif ($validcheck['error_code'] === ERROR_PHONE_NOT_IN_PROPER_FORMAT) {
          // phone number contains character that is not numeric
          // TODO: handle the error
          Flash::set('error_message', "Please enter valid phone number");

        } else {
          // unknown error
          // TODO: handle the error
          Flash::set('error_message', 'Your application could not be processed, please try again later');

        }
        $this->redirect('/');

      } else {
        // 3b. if valid, sanitize the data & store in the database
        // TODO: sanitize data


        // TODO: store in database

        echo 'valid';
      }
    } else {
      $this->redirect('/');
    }
  }

}
