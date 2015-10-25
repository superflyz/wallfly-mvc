<?php

class RealEst extends Controller
{

  public function index()
  {
    $this->view('realestate/index');
  }

  public function signup()
  {
    $this->view('realestate/signup');
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

}
