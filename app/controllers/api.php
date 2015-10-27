<?php

class Api extends Controller
{
  
  public function tenantcheck($email)
  {
    header('Content-Type: application/json');
    $response = [ 'available' => false ];
    $tenant = Tenant::get([ 'email' => $email ]);
    if (!$tenant) {
      $response['available'] = true;
    }
    echo json_encode($response);
  }

  public function owner($email)
  {
    header('Content-Type: application/json');
    $owner = Owner::get(['email' => $email])[0];
    $response = [];
    if (!$owner) {
      $response['found'] = false;
    } else {
      $response['found'] = true;
      $response['owner'] = $owner;
    }
    echo json_encode($response);
  }
  
}