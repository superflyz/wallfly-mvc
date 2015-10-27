<?php

class RealEst extends Controller
{

  public function index()
  {
    if (!Real_Estate::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $_SESSION['sidebar'] = "dashboard";
      $this->view('realestate/index', $_SESSION['user']);
    }
  }

  public function signup()
  {
    $this->view('realestate/signup');
  }

  public function manage()
  {
    if (!Real_Estate::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $_SESSION['sidebar'] = "manage";
      $this->view('realestate/agents', $_SESSION['user']);
    }
  }

  public function submit()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // TODO validate data
      if ($_POST['password'] !== $_POST['passwordrepeat']) {
        Flash::set('error_message', 'Your passwords did not match!');
      } else {
        // TODO submit data
        Real_Estate::create([
            'name' => $_POST['name'],
            'password' => create_hash($_POST['password']),
            'address' => $_POST['address'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'photo' => null
        ]);

        Flash::set('success_message', 'Your company account has been created!');

        $this->redirect('/');
        return;
      }

      $this->redirect('/realest/signup');

    } else {
      $this->send404();
    }
  }

  public function names()
  {
    header('Content-Type: application/json');
    $realestates = Real_Estate::get();
    $response = array_map(function($element) {
      return $element->name;
    }, $realestates);
    echo json_encode($response);
  }

  public function viewDetails()
  {
    if (!Real_Estate::isAuthenticated()) {
      $this->redirect('/');
    } else {
      if (!isset($_POST['submit'])) {
        $this->redirect("/realest/index");
      }
      $properties = $_SESSION['user']->getProperties();
      $_SESSION['selectedProperty'] = $properties[$_POST['submit']];
      $this->redirect('/realest/managedetails');
    }
  }

  public function managedetails()
  {
    if (!Real_Estate::isAuthenticated()) {
      $this->redirect('/');
    } else {
      $this->setJavascriptDependencies([
          WEBDIR . '/js/sweetalert.min.js',
          WEBDIR . '/js/assigntenantformhandler.js'
      ]);
      $this->setCSSDependencies([
          WEBDIR . '/css/sweetalert.css'
      ]);
      $data = [];
      $data['property'] = isset($_SESSION['selectedProperty']) ? $_SESSION['selectedProperty'] : null;
      $data['realestate'] = $_SESSION['user'];
      $this->view('realestate/managedetails', $data);
    }
  }

  public function addagent()
  {
    if (!Real_Estate::isAuthenticated()) {
      $this->redirect('/');
    } else {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 1. get post data
        $data = $_POST;

        // 2. create new agent
        $agent = Agent::create([
          'email' => $data['email'],
          'firstname' => $data['firstname'],
          'lastname' => $data['lastname'],
          'phone' => $data['phone'],
          'password' => create_hash('changethislaterok?'),
          'photo' => 'img/noimage.png',
          'real_estate_id' => $_SESSION['user']->id
        ]);

        $this->redirect('/realest/manage');
      }
    }
  }

  public function addproperty()
  {
    if (!Real_Estate::isAuthenticated()) {
      $this->redirect('/');
    } else {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $property = Property::create([
          'address' => strip_tags($_POST['address']),
          'payment_schedule' => strip_tags($_POST['payment_schedule']),
          'rent_amount' => strip_tags($_POST['rent_amount']),
          'agent_id' => strip_tags($_POST['agent']),
          'photo' => DUMMY_IMAGE
        ]);
        Flash::set('message', 'You added a new property!');
        $this->redirect('/realest/index');
      } else {
        $this->view('owner/index');
      }
    }
  }

  public function changeagent()
  {
    if (!Real_Estate::isAuthenticated()) {
      $this->redirect('/');
    } else {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['selectedProperty']->agent_id = $_POST['agent'];
        $_SESSION['selectedProperty']->update();
        $this->redirect('/realest/managedetails');
      }
    }
  }

}
