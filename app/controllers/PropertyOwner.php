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

  public function calendar()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {

      $this->setJavascriptDependencies([

          WEBDIR . '/dzscalendar/dzscalendar.js',
          WEBDIR . '/js/sweetalert.min.js',
          WEBDIR . '/bootstrap/bootstrap.js',
          WEBDIR . '/clockpicker/js/bootstrap.min.js',
          WEBDIR . '/clockpicker/js/timepicki.js'

      ]);

      $this->setCSSDependencies([

             WEBDIR . '/css/bootstrap.css',
           //WEBDIR . '/style/style.css',
          'http://fonts.googleapis.com/css?family=Carrois+Gothic',
           WEBDIR . '/dzstooltip/dzstooltip.css',
           WEBDIR . '/dzscalendar/dzscalendar.css',
          'http://fonts.googleapis.com/css?family=Open+Sans',
           // WEBDIR . '/clockpicker/css/bootstrap.css',

          WEBDIR . '/css/sweetalert.css',
          WEBDIR . '/css/wallfly.css',
          WEBDIR . '/css/module.css',
          WEBDIR . '/clockpicker/css/timepicki.css'




      ]);


      $this->view('owner/calendar');
    }
  }

  public function chat()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {

      $this->setJavascriptDependencies([
              WEBDIR . '/js/chat.js'

        ]);

        $this->setCSSDependencies([
              WEBDIR . '/css/module.css'

        ]);

        $this->view('owner/chat');
    }
  }

  public function payment()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $this->setJavascriptDependencies([
          WEBDIR . '/js/selectProperty.js'

      ]);
      $this->setCSSDependencies([

          WEBDIR . '/css/module.css'

      ]);
      $this->view('owner/payment');
    }
  }

  public function viewPayments()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $this->view('owner/viewpayments');
    }
  }

  public function addPayment()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $this->setJavascriptDependencies([
          WEBDIR . '/dzscalendar/dzscalendar.js',
          WEBDIR . '/js/paymentDatePicker.js'
      ]);

      $this->setCSSDependencies([
          'http://fonts.googleapis.com/css?family=Carrois+Gothic',
          WEBDIR . '/dzstooltip/dzstooltip.css',
          WEBDIR . '/dzscalendar/dzscalendar.css',
          'http://fonts.googleapis.com/css?family=Open+Sans',
          WEBDIR . '/css/module.css'
      ]);
      $this->view('owner/addpayment');
    }
  }

  public function processPayment()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    }
    $result = $_SESSION['selectedProperty']->addPayment($_POST['payeeName'], $_POST['startDate'], $_POST['endDate'], $_POST['amount']);
    if ($result == false) {
      $this->view('owner/addpayment');
    } else {
      $this->view('owner/viewpayments');
    }
  }

  public function repair()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $this->view('owner/repair');
    }
  }

  public function manageDetails()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $this->view('owner/managedetails');
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
