<?php


class PropertyOwner extends Controller
{

  public function index()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $this->view('owner/index', $_SESSION['user']);
    }
  }

  public function manage()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $data = [];
      $data['properties'] = $_SESSION['user']->getProperties();
      $data['owner'] = $_SESSION['user'];
      $this->view('owner/manage', $data);
    }
  }

  public function home()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $this->view('owner/home');
    }
  }

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

        } elseif ($validcheck['error_code'] === ERROR_PASSWORD_LESS_THAN_EIGHT_CHARS) {
          // password is less than 8 characters
          Flash::set('error_message', 'Your password should have at least 8 characters');

        } elseif ($validcheck['error_code'] === ERROR_PASSWORD_NOT_CONTAIN_ANY_NUMERIC) {
          // password does not contain any numerics
          Flash::set('error_message', 'Your password should have at least 1 numerical character');

        } elseif ($validcheck['error_code'] === ERROR_PASSWORD_NOT_CONTAIN_ANY_CAPITAL) {
          // password does not contain any capital letters
          Flash::set('error_message', 'Your password should have at least 1 capital letter');

        } elseif ($validcheck['error_code'] === ERROR_PASSWORD_NOT_CONTAIN_ANY_LOWERCASE) {
          // password does not contain any lowercase letters
          Flash::set('error_message', 'Your password should have at least 1 lowercase letter');

        } else {
          // unknown error
          // TODO: handle the error
          Flash::set('error_message', 'Your application could not be processed, please try again later');

        }
        $this->redirect('/');

      } else {
        // TODO: hash password
        $hashed = create_hash($_POST['password']);

        // TODO: store in database
        Owner::create([
            'email' => $_POST['email'],
            'password' => $hashed,
            'firstname' => $_POST['first_name'],
            'lastname' => $_POST['last_name'],
            'phone' => $_POST['phone'],
            'photo' => 'img/dummy_profile_picture.jpg'
        ]);

        Flash::set('success_message', 'Your account has been created, you can now ');
        $this->redirect('/');
      }
    } else {
      $this->redirect('/');
    }
  }

}