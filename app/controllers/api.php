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
  
}