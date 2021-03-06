<?php


class PropertyOwner extends Controller
{
  public function index()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $_SESSION['sidebar'] = "dashboard";
      $this->view('owner/index', $_SESSION['user']);
    }
  }


  public function manage()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $this->setJavascriptDependencies([
          WEBDIR . '/js/sweetalert.min.js',
          WEBDIR . '/js/assigntenantformhandler.js',
          WEBDIR . '/js/promptdelete.js'
      ]);
      $this->setCSSDependencies([
          WEBDIR . '/css/sweetalert.css'
      ]);
      $data = [];
      $data['property'] = isset($_SESSION['selectedProperty']) ? $_SESSION['selectedProperty'] : null;
      $data['owner'] = $_SESSION['user'];
      $_SESSION['sidebar'] = "manage";
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
          WEBDIR . '/dzstooltip/dzstooltip.css',
          WEBDIR . '/dzscalendar/dzscalendar.css',
          WEBDIR . '/css/sweetalert.css',
          WEBDIR . '/css/wallfly.css',
          WEBDIR . '/clockpicker/css/timepicki.css'
      ]);
      $_SESSION['sidebar'] = "calendar";
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
      $_SESSION['sidebar'] = "chat";
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
          WEBDIR . '/dzstooltip/dzstooltip.css',
          WEBDIR . '/dzscalendar/dzscalendar.css'
      ]);
      $_SESSION['sidebar'] = "payment";
      $this->view('owner/payment');
    }
  }

  public function viewPayments()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $_SESSION['sidebar'] = "payment";
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
          WEBDIR . '/dzscalendar/dzscalendar.css'
      ]);
      $_SESSION['sidebar'] = "payment";
      $this->view('owner/addpayment');
    }
  }

  public function processPayment()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $payeeName = strip_tags($_POST['payeeName']);
      $startDate = strip_tags($_POST['startDate']);
      $endDate = strip_tags($_POST['endDate']);
      $amount = strip_tags($_POST['amount']);
      $result = $_SESSION['selectedProperty']->addPayment($payeeName, $startDate, $endDate, $amount);
      if ($result == false) {
        $_SESSION['sidebar'] = "payment";
        $this->redirect('/propertyowner/payment');
      } else {
        Notification::addNotification($_SESSION['selectedProperty']->agent_id, "Payment  made for " . $_SESSION['selectedProperty']->address . ".");
        Notification::addNotification($_SESSION['selectedProperty']->tenant_id, "Payment made for " . $_SESSION['selectedProperty']->address . ".");
        $_SESSION['sidebar'] = "payment";
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
      $_SESSION['sidebar'] = "repair";
      $this->view('owner/repair');
    }
  }

  public function processRepairRequest()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $tmp = explode("/", $_POST['submit']);
      $timeStamp = strip_tags($tmp[0]);
      $value = strip_tags($tmp[1]);
      $comment = strip_tags($_POST[$tmp[2]]);
      $result = $_SESSION['selectedProperty']->processRepairRequest($timeStamp, $value, $comment);
      $property = $_SESSION['selectedProperty'];
      if ($result) {
        Notification::addNotification($_SESSION['selectedProperty']->tenant_id, "Repair status updated for " . $property->address . ".");
        Notification::addNotification($_SESSION['selectedProperty']->agent_id, "Repair status updated for " . $property->address . ".");
      }
      $_SESSION['sidebar'] = "repair";
      $this->redirect('/propertyowner/repair');
    }
  }

  public function manageDetails()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $_SESSION['sidebar'] = "manage";
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
        $property->address = strip_tags($_POST['address']);
        $property->rent_amount = strip_tags($_POST['rent_amount']);
        $property->payment_schedule = strip_tags($_POST['payment_schedule']);
        $property->update();
        // ========================
        // END UPDATE PROPERTY INFO
        // ========================
        $_SESSION['sidebar'] = "manage";
        $this->redirect('/propertyowner/manage');

      } else {
        $_SESSION['sidebar'] = "manage";
        $this->view('owner/editproperty');
      }
    }
  }

  public function assigntenant()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 1. get the post variables
        $data = $_POST;

        // 2. generate a temporary password
        $password = 'changethislaterok?';

        // 3. create a new tenant
        $tenant = Tenant::create([
          'email' => $data['email'],
          'firstname' => $data['firstname'],
          'lastname' => $data['lastname'],
          'phone' => $data['phone'],
          'password' => create_hash($password),
          'photo' => '/wallfly-mvc/public/img/noimage.png'
        ]);

        // 4. assign the tenant to the property
        $_SESSION['selectedProperty']->setTenant($tenant);

        // 5. set success message
        Flash::set('message', "{$tenant->firstname} {$tenant->lastname} has been added to this property");
        $_SESSION['sidebar'] = "manage";
        // 6. redirect to property page
        $this->redirect('/propertyowner/manage');
      }
    }
  }

  public function addproperty()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $photoPath = WEBDIR . '/img/noimage.png';

        // ============
        // IMAGE UPLOAD
        // ============
        $file = $_FILES['propertyImage'];
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
              $photoPath = WEBDIR . $targetFile;
            } else {
              // TODO: error
            }
          }
        } else {
          // TODO: error
        }
        // ================
        // END IMAGE UPLOAD
        // ================

        $property = Property::create([
          'address' => strip_tags($_POST['address']),
          'payment_schedule' => strip_tags($_POST['payment_schedule']),
          'rent_amount' => strip_tags($_POST['rent_amount']),
          'owner_id' => $_SESSION['user']->id,
          'photo' => $photoPath
        ]);

        Flash::set('message', 'You added a new property!');
        $_SESSION['selectedProperty'] = $property;
        $this->redirect('/propertyowner/manage');
      } else {
        $this->view('owner/index');
      }
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
            'photo' => 'img/noimage.png'
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
            $_SESSION['sidebar'] = "manage";
            Notification::addNotification($_SESSION['selectedProperty']->agent_id, "Document added for " . $_SESSION['selectedProperty']->address . ".");
            Notification::addNotification($_SESSION['selectedProperty']->tenant_id, "Document added for " . $_SESSION['selectedProperty']->address . ".");
            $this->redirect('/propertyowner/manage');
          } else {
            $_SESSION['sidebar'] = "manage";
            Flash::set("pdferror","Could not move file");
            $_SESSION['docAdded'] = "false";
            $this->redirect('/propertyowner/manage');
          }
        }
      } else {
        Flash::set("pdferror","Upload Failed, no file specified");
        $_SESSION['docAdded'] = "false";
        $_SESSION['sidebar'] = "manage";
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
            $_SESSION['sidebar'] = "manage";
            Notification::addNotification($_SESSION['selectedProperty']->agent_id, "Inspection document added for " . $_SESSION['selectedProperty']->address . ".");
            Notification::addNotification($_SESSION['selectedProperty']->tenant_id, "Inspection document added for " . $_SESSION['selectedProperty']->address . ".");
            $this->redirect('/propertyowner/manage');
          } else {
            $_SESSION['sidebar'] = "manage";
            Flash::set("pdferror","Could not move file");
            $_SESSION['docAdded'] = "false";
            $this->redirect('/propertyowner/manage');
          }
        }
      } else {
        Flash::set("pdferror","Upload Failed, no file specified");
        $_SESSION['docAdded'] = "false";
        $_SESSION['sidebar'] = "manage";
        $this->redirect('/propertyowner/manage');
      }
      // ================
      // END PDF UPLOAD
      // ================
    }
  }

  public function viewDetails()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      if (!isset($_POST['submit'])) {
        $this->redirect("/propertyowner/index");
      }
      $properties = $_SESSION['user']->getProperties();
      $_SESSION['selectedProperty'] = $properties[$_POST['submit']];
      $_SESSION['sidebar'] = "manage";
      $this->redirect('/propertyowner/manage');
    }
  }

  public function viewNotifications()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $this->view('owner/notifications');
    }
  }

  public function assignexistingtenant()
  {
    if (!Owner::isAuthenticated()) {
      $this->redirect('/');
    } else {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 1. get the post variables
        $email = $_POST['email'];

        // 2. get the tenant
        $tenant = Tenant::get([ 'email' => $email ])[0];

        // 4. assign the tenant to the property
        $_SESSION['selectedProperty']->setTenant($tenant);

        // 5. set success message
        Flash::set('message', "{$tenant->firstname} {$tenant->lastname} has been added to this property");
        $_SESSION['sidebar'] = "manage";

        // 6. redirect to property page
        $this->redirect('/propertyowner/manage');
      }
    }
  }

}





