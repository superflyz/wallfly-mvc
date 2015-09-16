<?php

class Super_User extends Model
{

  public $id, $email, $password, $firstname, $lastname, $phone, $photo;

  public function save()
  {
    try {
      $db = Database::getInstance();
      $db->beginTransaction();
      $statement = $db->prepare("INSERT INTO super_user (email, password, firstname,
        lastname, phone, photo) VALUES (:email, :password, :firstname, :lastname,
        :phone, :photo)");
      $statement->execute([
        ':email' => $this->email,
        ':password' => $this->password,
        ':firstname' => $this->firstname,
        ':lastname' => $this->lastname,
        ':phone' => $this->phone,
        ':photo' => $this->photo
      ]);
      $this->id = $db->lastInsertId();
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

}
