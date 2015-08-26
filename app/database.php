<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
  'driver' => 'mysql',
  'host' => '127.0.0.1:3307',
  'username' => 'admin',
  'password' => 'password',
  'database' => 'admin'
]);

$capsule->bootEloquent();