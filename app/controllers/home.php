<?php

class Home extends Controller
{

  public function index()
  {
    $_SESSION['sidebar'] = 'dashboard';
    if (Owner::isAuthenticated()) {
      // if owner is authenticated
      // TODO: display owner dashboard
      $this->redirect('/propertyowner/index');

    } elseif (Tenant::isAuthenticated()) {
      // if tenant is authenticated
      // TODO: display tenant dashboard
      $this->redirect('/propertytenant/index');
    } elseif (Agent::isAuthenticated()) {
      // if agent is authenticated
      // TODO: display agent dashboard
      $this->redirect('/propertyagent/index');
    } elseif (Real_Estate::isAuthenticated()) {
      // if real estate is authenticated
      // TODO: display real estate dashboard
      $this->redirect('/realest/index');

    } else {
      // if no one is authenticated
      // display landing page
      $this->setJavascriptDependencies([
        WEBDIR . '/js/index.js'
      ]);
      $this->view('home/index');
    }

    // TEST

    // $owner = Owner::create([
    //   'email' => 'john@example.com',
    //   'password' => 'password',
    //   'firstname' => 'John',
    //   'lastname' => 'Doe',
    //   'phone' => '12345123',
    //   'photo' => NULL
    // ]);

    // $agent = Agent::create([
    //   'email' => 'jane@example.com',
    //   'password' => 'password',
    //   'firstname' => 'Jane',
    //   'lastname' => 'Doe',
    //   'phone' => '12345123',
    //   'photo' => NULL,
    //   'real_estate_id' => 2
    // ]);

    // $realestate = Real_Estate::create([
    //   'name' => 'Ray White',
    //   'password' => 'password',
    //   'address' => 'address',
    //   'email' => 'ray@white.com',
    //   'phone' => '12345123',
    //   'photo' => NULL
    // ]);

    // $property = Property::create([
    //   'address' => 'address',
    //   'payment_schedule' => 'payment_schedule',
    //   'rent_amount' => 'rent_amount',
    //   'photo' => NULL,
    //   'real_estate_id' => NULL,
    //   'agent_id' => NULL,
    //   'owner_id' => NULL
    // ]);

  }

  public function login()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // check user type
      if ($_POST['usertype'] === 'owner') {
        // if owner
        $owner = Owner::get(['email' => $_POST['email']])[0];
        if ($owner) {
          // check the password
          if (validate_password($_POST['password'], $owner->password)) {
            // password matched
            $_SESSION['usertype'] = USERTYPE_OWNER;
            $_SESSION['user'] = $owner;
          } else {
            // wrong password
            Flash::set('error_message', 'Wrong email or password');

          }
        } else {
          // cannot find the user with the email
          Flash::set('error_message', 'Wrong email or password');

        }
      } elseif ($_POST['usertype'] === 'tenant') {
        $tenant = Tenant::get(['email' => $_POST['email']])[0];
        if ($tenant) {
          // check the password
          if (validate_password($_POST['password'], $tenant->password)) {
            // password matched
            $_SESSION['usertype'] = USERTYPE_TENANT;
            $_SESSION['user'] = $tenant;
          } else {
            // wrong password
            Flash::set('error_message', 'Wrong email or password');

          }
        } else {
          // cannot find the user with the email
          Flash::set('error_message', 'Wrong email or password');
        }

      } elseif ($_POST['usertype'] === 'agent') {
        $agent = Agent::get(['email' => $_POST['email']])[0];
        if ($agent) {
          // check the password
          if (validate_password($_POST['password'], $agent->password)) {
            // password matched
            $_SESSION['usertype'] = USERTYPE_AGENT;
            $_SESSION['user'] = $agent;
          } else {
            // wrong password
            Flash::set('error_message', 'Wrong email or password');

          }
        } else {
          // cannot find the user with the email
          Flash::set('error_message', 'Wrong email or password');
        }

      } elseif ($_POST['usertype'] === 'real_estate') {
        // if real estate
        $realestate = Real_Estate::get(['name' => $_POST['name']])[0];
        if ($realestate) {
          // check password
          if (validate_password($_POST['password'], $realestate->password)) {
            $_SESSION['usertype'] = USERTYPE_REALESTATE;
            $_SESSION['user'] = $realestate;
          } else {
            // wrong password
            Flash::set('error_message', 'Wrong password');
          }
        }
      }
    }
    $this->redirect('/');
  }

  public function logout()
  {
    unset($_SESSION['usertype']);
    unset($_SESSION['user']);
    unset($_SESSION['selectedProperty']);
    unset($_SESSION['sidebar']);
    session_destroy();

    $this->redirect('/');
  }

  public function test()
  {
    try {
      $db = Database::getInstance();
      $statement = $db->prepare("
                              DELETE FROM calendar;
                              DELETE FROM chat;
                              DELETE FROM documents;
                              DELETE FROM inspections;
                              DELETE FROM notifications;
                              DELETE FROM payment;
                              DELETE FROM repair_request;
                              DELETE FROM property;
                              DELETE FROM super_user;
                              DELETE FROM tenant;
                              DELETE FROM agent;
                              DELETE FROM owner;
                              DELETE FROM real_estate;");
      $statement->execute();
    } catch (PDOException $e) {
      die();
    }
    $this->redirect('/home/tests');
  }

  public function tests() {
    $this->view('home/test');

  }

}
