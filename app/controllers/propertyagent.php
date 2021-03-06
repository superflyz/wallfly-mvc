<?php

class PropertyAgent extends Controller
{

  public function signup()
  {
    echo 'TODO: agent sign up page';
  }

  public function index()
  {
    if (!Agent::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $_SESSION['sidebar'] = "dashboard";
      $this->view('agent/index', $_SESSION['user']);
    }
  }

  public function manage()
  {
    if (!Agent::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $data = [];
      $data['property'] = $data['property'] = isset($_SESSION['selectedProperty']) ? $_SESSION['selectedProperty'] : null;
      $data['agent'] = $_SESSION['user'];
      $this->setJavascriptDependencies([
        WEBDIR . '/js/assigntenantformhandler.js',
        WEBDIR . '/js/assignownerformhandler.js',
        WEBDIR . '/js/promptdelete.js'
      ]);
      $_SESSION['sidebar'] = "manage";
      $this->view('agent/managedetails', $data);
    }
  }

  public function manageDetails()
  {
    if (!Agent::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $_SESSION['sidebar'] = "manage";
      $this->view('agent/managedetails');
    }
  }

  public function calendar()
  {
    if (!Agent::isAuthenticated()) {
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
         // WEBDIR . '/css/module.css',
          WEBDIR . '/clockpicker/css/timepicki.css'
      ]);
      $_SESSION['sidebar'] = "calendar";
      $this->view('agent/calendar');
    }
  }

  public function chat()
  {
    if (!Agent::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $this->setJavascriptDependencies([
          WEBDIR . '/js/chat.js'
      ]);
      $this->setCSSDependencies([
          WEBDIR . '/css/module.css'
      ]);
      $_SESSION['sidebar'] = "chat";
      $this->view('agent/chat');
    }
  }

  public function payment()
  {
    if (!Agent::isAuthenticated()) {
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
      $this->view('agent/payment');
    }
  }

  public function viewPayments()
  {
    if (!Agent::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $_SESSION['sidebar'] = "payment";
      $this->view('agent/payment');
    }
  }

  public function addPayment()
  {
    if (!Agent::isAuthenticated()) {
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
      $_SESSION['sidebar'] = "payment";
      $this->view('agent/payment');
    }
  }

  public function processPayment()
  {
    if (!Agent::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $property = $_SESSION['selectedProperty'];
      $payeeName = strip_tags($_POST['payeeName']);
      $startDate = strip_tags($_POST['startDate']);
      $endDate = strip_tags($_POST['endDate']);
      $amount = strip_tags($_POST['amount']);
      $result = $_SESSION['selectedProperty']->addPayment($payeeName, $startDate, $endDate, $amount);
      if ($result == false) {
        $_SESSION['sidebar'] = "payment";
        $this->redirect('/propertyagent/payment');
      } else {
        Notification::addNotification($_SESSION['selectedProperty']->tenant_id, "Payment made for " . $property->address . ".");
        Notification::addNotification($_SESSION['selectedProperty']->owner_id, "Payment made for " . $property->address . ".");
        $_SESSION['sidebar'] = "payment";
        $this->redirect('/propertyagent/payment');
      }
    }
  }

  public function repair()
  {
    if (!Agent::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $this->setJavascriptDependencies([
          WEBDIR . '/js/selectProperty.js'
      ]);
      $this->setCSSDependencies([
          WEBDIR . '/css/module.css'
      ]);
      $_SESSION['sidebar'] = "repair";
      $this->view('agent/repair');
    }
  }

  public function processRepairRequest()
  {
    if (!Agent::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $property = $_SESSION['selectedProperty'];
      $tmp = explode("/", $_POST['submit']);
      $timeStamp = strip_tags($tmp[0]);
      $value = strip_tags($tmp[1]);
      $comment = strip_tags($_POST[$tmp[2]]);
      $result = $_SESSION['selectedProperty']->processRepairRequest($timeStamp, $value, $comment);
      if ($result) {
        Notification::addNotification($_SESSION['selectedProperty']->tenant_id, "Repair status updated for " . $property->address . ".");
        Notification::addNotification($_SESSION['selectedProperty']->owner_id, "Repair status updated for " . $property->address . ".");
      }
      $_SESSION['sidebar'] = "repair";
      $this->redirect('/propertyagent/repair');
    }
  }

  public function editproperty()
  {
    if (!Agent::isAuthenticated()) {
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
        $this->redirect('/propertyagent/manage');
      } else {
        $_SESSION['sidebar'] = "manage";
        $this->view('agent/editproperty');
      }
    }
  }

  public function processInspection()
  {
    if (!Agent::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $property = $_SESSION['selectedProperty'];
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
            Notification::addNotification($_SESSION['selectedProperty']->tenant_id, "Inspection document added for " . $property->address . ".");
            Notification::addNotification($_SESSION['selectedProperty']->owner_id, "Inspection document added for " . $property->address . ".");
            $this->redirect('/propertyagent/manage');
          } else {
            $_SESSION['sidebar'] = "manage";
            Flash::set("pdferror","Could not move file");
            $_SESSION['docAdded'] = "false";
            $this->redirect('/propertyagent/manage');
          }
        }
      } else {
        Flash::set("pdferror","Upload Failed, no file specified");
        $_SESSION['docAdded'] = "false";
        $_SESSION['sidebar'] = "manage";
        $this->redirect('/propertyagent/manage');
      }
      // ================
      // END PDF UPLOAD
      // ================
    }
  }

  public function addproperty()
  {
    if (!Agent::isAuthenticated()) {
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
          'agent_id' => $_SESSION['user']->id,
          'photo' => $photoPath
        ]);
        
        Flash::set('message', 'You added a new property!');
        $_SESSION['selectedProperty'] = $property;
        $_SESSION['sidebar'] = "manage";
        $this->redirect('/propertyagent/manage');
      } else {
        $_SESSION['sidebar'] = "dashboard";
        $this->view('agent/index');
      }
    }
  }

  public function assigntenant()
  {
    if (!Agent::isAuthenticated()) {
      $this->redirect('/');
    } else {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 1. get the post variables
        $data = $_POST;

        // 2. generate a temporary password
        $password = 'changethislaterok?';

        // 3. create a new tenant
        $tenant = Tenant::create([
          'email' => strip_tags($data['email']),
          'firstname' => strip_tags($data['firstname']),
          'lastname' => strip_tags($data['lastname']),
          'phone' => strip_tags($data['phone']),
          'password' => create_hash($password),
          'photo' => 'http://dummyimage.com/250x200/000/fff.jpg'
        ]);

        // 4. assign the tenant to the property
        $_SESSION['selectedProperty']->setTenant($tenant);

        // 5. set success message
        Flash::set('message', "{$tenant->firstname} {$tenant->lastname} has been added to this property");
        $_SESSION['sidebar'] = "manage";
        // 6. redirect to property page
        $this->redirect('/propertyagent/manage');
      }
    }
  }

  public function processDocument()
  {
    if (!Agent::isAuthenticated()) {
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
            Notification::addNotification($_SESSION['selectedProperty']->tenant_id, "Document added for " . $property->address . ".");
            Notification::addNotification($_SESSION['selectedProperty']->owner_id, "Document added for " . $property->address . ".");
            $this->redirect('/propertyagent/manage');
          } else {
            $_SESSION['sidebar'] = "manage";
            Flash::set("pdferror","Could not move file");
            $_SESSION['docAdded'] = "false";
            $this->redirect('/propertyagent/manage');
          }
        }
      } else {
        Flash::set("pdferror","Upload Failed, no file specified");
        $_SESSION['docAdded'] = "false";
        $_SESSION['sidebar'] = "manage";
        $this->redirect('/propertyagent/manage');
      }
      // ================
      // END PDF UPLOAD
      // ================
    }
  }

  public function assignexistingtenant()
  {
    if (!Agent::isAuthenticated()) {
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
        $this->redirect('/propertyagent/manage');
      }
    }
  }

  public function viewNotifications()
  {
    if (!Agent::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $this->view('agent/notifications');
    }
  }

  public function viewDetails()
  {
    if (!Agent::isAuthenticated()) {
      $this->redirect('/');
    } else {
      if (!isset($_POST['submit'])) {
        $this->redirect("/propertyagent/index");
      }
      $properties = $_SESSION['user']->getProperties();
      $_SESSION['selectedProperty'] = $properties[$_POST['submit']];
      $_SESSION['sidebar'] = "manage";
      $this->redirect('/propertyagent/manage');
    }
  }

  public function assignowner()
  {
    if (!Agent::isAuthenticated()) {
      $this->redirect('/');
    } else {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $property = $_SESSION['selectedProperty'];
        $owner = Owner::get(['email'=>$_POST['ownerEmail']])[0];
        $property->owner_id = $owner->id;
        $property->update();
        $this->redirect('/propertyagent/manage');
      }
    }
  }

}