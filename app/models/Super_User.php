<?php

class Super_User extends Model
{

  public $id, $email, $password, $firstname, $lastname, $phone, $photo;

  public function save()
  {
    parent::save();

    $db = Database::get_instance();
    $result = $db->query("SELECT id FROM super_user WHERE email='{$this->email}'");
    $result = $result->fetchObject();
    $this->id = $result->id;
  }

}
