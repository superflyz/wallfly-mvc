<?php

class Home extends Controller
{

  public function index()
  {
    if (Owner::is_authenticated()) {
      // if owner is authenticated
      // TODO: display owner dashboard

    } elseif (Tenant::is_authenticated()) {
      // if tenant is authenticated
      // TODO: display tenant dashboard

    } elseif (Agent::is_authenticated()) {
      // if agent is authenticated
      // TODO: display agent dashboard

    } elseif (Real_Estate::is_authenticated()) {
      // if real estate is authenticated
      // TODO: display real estate dashboard

    } else {
      // if no one is authenticated
      // display landing page
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

}
