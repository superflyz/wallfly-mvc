<?php

class RealEstate extends Model
{

  public $id, $email, $name, $password, $phone, $photo;

  public function save()
  {
    parent::save();

    $db = Database::get_instance();
    $result = $db->query("SELECT id FROM realestate WHERE email='{$this->email}'");
    $result = $result->fetchObject();
    $this->id = $result->id;
  }

  public static function create($data)
  {
    $realestate = new RealEstate($data);
    $realestate->save();
    return $realestate;
  }

}