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

      $this->setJavascriptDependencies([

          WEBDIR . '/js/sweetalert.min.js'

      ]);

      $this->setCSSDependencies([
          WEBDIR . '/css/sweetalert.css'
      ]);
      $data = [];
      $data['property'] = isset($_SESSION['selectedProperty']) ? $_SESSION['selectedProperty'] : null;
      $data['owner'] = $_SESSION['user'];
      $this->view('owner/managedetails', $data);
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
         // 'http://fonts.googleapis.com/css?family=Carrois+Gothic',
           WEBDIR . '/dzstooltip/dzstooltip.css',
           WEBDIR . '/dzscalendar/dzscalendar.css',
          //'http://fonts.googleapis.com/css?family=Open+Sans',
           //WEBDIR . '/clockpicker/css/bootstrap.css',

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

//        $this->setCSSDependencies([
//              WEBDIR . '/css/module.css'
//
//        ]);

        $this->view('owner/chat');
    }
  }

  public function payment()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $this->setJavascriptDependencies([
          WEBDIR . '/js/selectProperty.js',
          WEBDIR . '/dzscalendar/dzscalendar.js',
          WEBDIR . '/js/paymentDatePicker.js'

      ]);
      $this->setCSSDependencies([

          WEBDIR . '/css/module.css',
          WEBDIR . '/dzstooltip/dzstooltip.css',
          WEBDIR . '/dzscalendar/dzscalendar.css'

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
    } else {
      $result = $_SESSION['selectedProperty']->addPayment($_POST['payeeName'], $_POST['startDate'], $_POST['endDate'],
          $_POST['amount']);
      if ($result == false) {
        $this->redirect('/propertyowner/payment');
      } else {
        $this->redirect('/propertyowner/payment');
      }
    }
  }

  public function repair()
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
      $this->view('owner/repair');
    }
  }

  public function processRepairRequest()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $property = $_SESSION['selectedProperty'];
      $tmp = explode("/", $_POST['submit']);
      $result = $_SESSION['selectedProperty']->processRepairRequest($tmp[0], $tmp[1], $_POST[$tmp[2]]);
      if ($result) {
        //Notification::addNotification($property->agent_id, "Repair status updated for " . $property->address . ".");
        //Notification::addNotification($property->tenant_id, "Repair status updated for " . $property->address . ".");
      }
      $this->redirect('/propertyowner/repair');
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

  public function editproperty()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      if ($_SERVER['REQUEST_METHOD'] === 'POST'){

        $property = $_SESSION['selectedProperty'];

        // ============
        // IMAGE UPLOAD
        // ============
        $file = $_FILES['photo_file'];
        // 1. check if user uploads an image
        if ($file['name']) {
          // 2. check if it's an image
          if ($file['type'] !== 'image/jpeg') {
            // TODO: error
          } else {
            // 3. store the file
            $targetDir = '/img/properties';
            $targetFile = $targetDir . basename($file['name']);
            if (move_uploaded_file($file['tmp_name'], PUBLIC_ABSOLUTE_PATH . $targetFile)) {
              // 4. update the property
              $property->photo = WEBDIR . $targetFile;
            } else {
          var_dump($file);
          exit();
              // TODO: error
            }
          }
        } else {
          // TODO: error
        }
        // ================
        // END IMAGE UPLOAD
        // ================


        // ====================
        // UPDATE PROPERTY INFO
        // ====================
        $property->address = $_POST['address'];
        $property->rent_amount = $_POST['rent_amount'];
        $property->payment_schedule = $_POST['payment_schedule'];
        $property->update();
        // ========================
        // END UPDATE PROPERTY INFO
        // ========================

        $this->redirect('/propertyowner/manage');

      } else {
        $this->view('owner/editproperty');
      }
    }
  }

  public function assigntenant()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      
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


  public function processDocument()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {

      // ============
      // PDF UPLOAD
      // ============
      $file = $_FILES['image'];
      // 1. check if user uploads an image
      if ($file['name']) {
        // 2. check if it's an image
        if ($file['type'] !== 'application/pdf') {
          Flash::set("pdferror","File type not pdf, please check file extention");
        } else {
          // 3. store the file
          $targetDir = '/documents/';
          $randomcharz = uniqid();
          $splitval = "@@@@@@";
          $targetFile = $targetDir .$randomcharz.$splitval. basename($file['name']);
          if (move_uploaded_file($file['tmp_name'], PUBLIC_ABSOLUTE_PATH . $targetFile)) {
            HandleDocuments::addDocument($_SESSION['selectedProperty']->id,$targetFile,basename($file['name']));
            $_SESSION['docAdded'] = "true";

            $this->redirect('/propertyowner/manage');
          } else {

            Flash::set("pdferror","Could not move file");
            $_SESSION['docAdded'] = "false";
            $this->redirect('/propertyowner/manage');
          }
        }
      } else {
        Flash::set("pdferror","Upload Failed, no file specified");
        $_SESSION['docAdded'] = "false";
        $this->redirect('/propertyowner/manage');
      }
      // ================
      // END PDF UPLOAD
      // ================
    }
  }

  public function processInspection()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {

      // ============
      // PDF UPLOAD
      // ============
      $file = $_FILES['image'];
      // 1. check if user uploads an image
      if ($file['name']) {
        // 2. check if it's an image
        if ($file['type'] !== 'application/pdf') {
          Flash::set("pdferror","File type not pdf, please check file extention");
        } else {
          // 3. store the file
          $targetDir = '/inspections/';
          $randomcharz = uniqid();
          $splitval = "@@@@@@";
          $targetFile = $targetDir .$randomcharz.$splitval. basename($file['name']);
          if (move_uploaded_file($file['tmp_name'], PUBLIC_ABSOLUTE_PATH . $targetFile)) {
            HandleDocuments::addInspection($_SESSION['selectedProperty']->id,$targetFile,basename($file['name']));
            $_SESSION['docAdded'] = "true";

            $this->redirect('/propertyowner/manage');
          } else {

            Flash::set("pdferror","Could not move file");
            $_SESSION['docAdded'] = "false";
            $this->redirect('/propertyowner/manage');
          }
        }
      } else {
        Flash::set("pdferror","Upload Failed, no file specified");
        $_SESSION['docAdded'] = "false";
        $this->redirect('/propertyowner/manage');
      }
      // ================
      // END PDF UPLOAD
      // ================
    }
  }

}





