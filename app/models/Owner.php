<?php

class Owner extends Super_User
{

  public function save()
  {
    parent::save();

    $db = Database::get_instance();
    $statement = $db->prepare("INSERT INTO owner VALUES (:id)");
    $statement->execute([
        ':id' => $this->id
    ]);
  }

  public static function create($data)
  {
    $owner = new Owner($data);
    $owner->save();
    return $owner;
  }

}
