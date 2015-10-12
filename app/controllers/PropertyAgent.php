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
      $data['properties'] = $_SESSION['user']->getProperties();
      $data['agent'] = $_SESSION['user'];
      $this->view('agent/manage', $data);
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
      $result = $_SESSION['selectedProperty']->processRepairRequest($tmp[0], $tmp[1]);
      $this->redirect('/propertyagent/repair');
    }
  }

}