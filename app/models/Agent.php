<?php

class Agent extends Model
{

  public $id, $name, $password, $address, $phone, $pic_firstname, $pic_lastname, $email, $pic_email;

  public function save()
  {
    parent::save();

    $db = Database::get_instance();
    $result = $db->query("SELECT id FROM agent WHERE name='{$this->name}'");
    $result = $result->fetchObject();
    $this->id = $result->id;
  }

  public static function create($data)
  {
    $agent = new Agent($data);
    $agent->save();
    return $agent;
  }

  public static function get_one($id)
  {
    $db = Database::get_instance();
    $result = $db->query("SELECT * FROM agent WHERE id=$id");
    $result = $result->fetch(PDO::FETCH_ASSOC);
    return new Agent($result);
  }

}