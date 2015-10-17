<?php

require_once '../vendor/autoload.php';

require_once 'config/app.php';
require_once 'config/globals.php';
require_once 'config/database.php';

require_once 'libs/PasswordHash.php';
require_once 'libs/Validator.php';
require_once 'libs/Flash.php';
require_once 'libs/CalendarEvents.php';
require_once 'libs/HandleDocuments.php';
require_once 'libs/Notification.php';


require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'core/Database.php';
require_once 'core/Model.php';

date_default_timezone_set("Australia/brisbane");

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
