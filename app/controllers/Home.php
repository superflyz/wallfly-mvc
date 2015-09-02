<?php

class Home extends Controller
{

  public function index()
  {
    // if not logged in
    if (!Owner::is_authenticated())
    {
      $this->view('home/index');

      // $owner = Owner::create([
      //   'email' => 'anowner@example.com',
      //   'password' => 'password',
      //   'firstname' => 'an',
      //   'lastname' => 'owner',
      //   'phone' => '12345123',
      //   'address' => '123 City St QLD 1234',
      //   'photo' => 'img/anowneratexampledotcom'
      // ]);

      // $owner2 = Owner::create([
      //   'email' => 'anowner2@example.com',
      //   'password' => 'password',
      //   'firstname' => 'an',
      //   'lastname' => 'owner',
      //   'phone' => '12345123',
      //   'address' => '123 City St QLD 1234',
      //   'photo' => 'img/anowneratexampledotcom'
      // ]);
    }
    else
    {
      // TODO: redirect to dashboard
      $this->redirect('/dashboard');
    }
  }
  
}