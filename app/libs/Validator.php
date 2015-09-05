<?php

define('ERROR_EMPTY', 0);
define('ERROR_NAME_CONTAINS_NUMERIC', 1);
define('ERROR_PASSWORDS_NOT_MATCH', 2);
define('ERROR_EMAIL_NOT_IN_PROPER_FORMAT', 3);
define('ERROR_PHONE_NOT_IN_PROPER_FORMAT', 4);

class Validator
{

  private static function sanitize($data)
  {
    return htmlspecialchars(stripslashes(trim($data)));
  }

  public static function validate_owner_data($data)
  {
    // 1. check if any of the field is empty
    $emptycheck = self::check_empty($data);
    if ($emptycheck['empty'])
    {
      return [
        'valid' => false,
        'error_code' => ERROR_EMPTY,
        'field' => $emptycheck['field']
      ];
    }
    // 2. check if the repeated password is matched with the original password
    if ($data['password'] != $data['password_repeat']);
    {
      return [
        'valid' => false,
        'error_code' => ERROR_PASSWORDS_NOT_MATCH,
        'field' => 'password_repeat'
      ];
    }
    // 3. check if firstname contains numeric
    if (!ctype_alpha($data['firstname']))
    {
      return [
        'valid' => false,
        'error_code' => ERROR_NAME_CONTAINS_NUMERIC,
        'field' => 'firstname'
      ];
    }
    // 4. check if lastname contains numeric
    if (!ctype_alpha($data['lastname']))
    {
      return [
        'valid' => false,
        'error_code' => ERROR_NAME_CONTAINS_NUMERIC,
        'field' => 'lastname'
      ];
    }
    // 5. check email address
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
      return [
        'valid' => false,
        'error_code' => ERROR_EMAIL_NOT_IN_PROPER_FORMAT,
        'field' => 'email'
      ];
    }
    // 6. check phone number
    if (!ctype_digit($data['phone'])) {
      return [
        'valid' => false,
        'error_code' => ERROR_PHONE_NOT_IN_PROPER_FORMAT,
        'field' => 'phone'
      ];
    }
    return ['valid' => true];
  }

  public static function check_empty($data)
  {
    foreach ($data as $key => $value)
    {
      if ($key !== 'address2')
      {
        if (empty($value))
        {
          return [
            'empty' => true,
            'field' => $key
          ];
        }
      }
    }
    return [
      'empty' => false
    ];
  }

}
