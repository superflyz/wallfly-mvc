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
      $this->redirect("/");
    } else {
      $this->view("agent/index", $_SESSION['user']);
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
      $this->view('agent/managedetails', $data);
    }
  }

  public function manageDetails()
  {
    if (!Agent::isAuthenticated()) {
      $this->redirect('/');
    } else {
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
        //WEBDIR . '/style/style.css',
        // 'http://fonts.googleapis.com/css?family=Carrois+Gothic',
          WEBDIR . '/dzstooltip/dzstooltip.css',
          WEBDIR . '/dzscalendar/dzscalendar.css',
        //'http://fonts.googleapis.com/css?family=Open+Sans',
        // WEBDIR . '/clockpicker/css/bootstrap.css',

          WEBDIR . '/css/sweetalert.css',
          WEBDIR . '/css/wallfly.css',
          WEBDIR . '/css/module.css',
          WEBDIR . '/clockpicker/css/timepicki.css'




      ]);


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

      $this->view('agent/chat');
    }
  }

  public function payment()
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
      $this->view('agent/payment');
    }
  }

  public function viewPayments()
  {
    if (!Agent::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $this->view('agent/viewpayments');
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
      $this->view('agent/addpayment');
    }
  }

  public function processPayment()
  {
    if (!Agent::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $result = $_SESSION['selectedProperty']->addPayment($_POST['payeeName'], $_POST['startDate'], $_POST['endDate'],
          $_POST['amount']);
      if ($result == false) {
        $this->view('agent/addpayment');
      } else {
        $this->view('agent/viewpayments');
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
      $this->view('agent/repair');
    }
  }

  public function processRepairRequest()
  {
    if (!Agent::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $tmp = explode("/", $_POST['submit']);
      $result = $_SESSION['selectedProperty']->processRepairRequest($tmp[0], $tmp[1], $_POST[$tmp[2]]);
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
        $property->address = $_POST['address'];
        $property->rent_amount = $_POST['rent_amount'];
        $property->payment_schedule = $_POST['payment_schedule'];
        $property->update();
        // ========================
        // END UPDATE PROPERTY INFO
        // ========================

        $this->redirect('/propertyagent/manage');

      } else {
        $this->view('agent/editproperty');
      }
    }
  }

}