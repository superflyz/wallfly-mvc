<?php

define('PATTERN', '#^[a-z0-9\x20]+$#i');



define('ERROR_EMPTY', 0);
define('ERROR_NAME_CONTAINS_NUMERIC', 1);
define('ERROR_PASSWORDS_NOT_MATCH', 2);

class Validator
{

  private static function sanitize($data)
  {
    return htmlspecialchars(stripslashes(trim($data)));
  }

  public static function validate($data)
  {
    $result = ['valid' => true];
    $emptycheck = self::check_empty($data);
    if ($emptycheck['empty'])
    {
      $result['valid'] = false;
      $result['error_code'] = ERROR_EMPTY;
      $result['field'] = $emptycheck['field'];
      return $result;
    }
    print_r($data);
    if ($data['password'] != $data['password_repeat']);
    {
      $result['valid'] = false;
      $result['error_code'] = ERROR_PASSWORDS_NOT_MATCH;
      $result['field'] = 'password_repeat';
      return $result;
    }
    if (!ctype_alpha($data['firstname']))
    {
      $result['valid'] = false;
      $result['error_code'] = ERROR_NAME_CONTAINS_NUMERIC;
      $result['field'] = 'firstname';
      return $result;
    }
    if (!ctype_alpha($data['lastname']))
    {
      $result['valid'] = false;
      $result['error_code'] = ERROR_NAME_CONTAINS_NUMERIC;
      $result['field'] = 'lastname';
      return $result;
    }


    return $result;
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