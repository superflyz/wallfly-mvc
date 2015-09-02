<?php

class Model
{

  public function __construct($data)
  {
    foreach ($data as $key => $value)
    {
      $this->$key = $value;
    }
  }

  public function save()
  {
    $db = Database::get_instance();
    $variables = get_object_vars($this);
    $statement = "INSERT INTO " . strtolower(get_class($this)) . " (";
    $i = 0;
    foreach ($variables as $key => $value)
    {
      if ($key !== "id")
      {
        $comma = ", ";
        if ($i === sizeof($variables)-1)
        {
          $comma = "";
        }
        $statement .= $key . $comma;
      }
      $i++;
    }
    $statement .= ") VALUES (";
    $i = 0;
    foreach ($variables as $key => $value)
    {
      if ($key !== "id")
      {
        $comma = ", ";
        if ($i === sizeof($variables)-1)
        {
          $comma = "";
        }
        $statement .= ":" . $key . $comma;
      }
      $i++;
    }
    $statement .= ")";
    $statement = $db->prepare($statement);
    foreach ($this as $key => $value)
    {
      if ($key !== "id")
      {
        $statement->bindParam(":" . $key, $variables[$key]);
      }
    }
    $statement->execute();
  }

  public function update()
  {
    $db = Database::get_instance();
    $statement = "UPDATE " . strtolower(get_class($this)) . " SET ";
    $variables = get_object_vars($this);
    $i = 0;
    foreach ($variables as $key => $value)
    {
      if ($key !== "id")
      {
        $comma = ", ";
        if ($i === sizeof($variables)-1)
        {
          $comma = " ";
        }
        $statement .= $key . "=:" . $key . $comma;
      }
      $i++;
    }
    $statement .= "WHERE id=:id";
    $statement = $db->prepare($statement);
    print_r($statement);
    foreach ($this as $key => $value)
    {
      $statement->bindParam(":" . $key, $variables[$key]);
    }
    $statement->execute();
  }

  public function delete()
  {
    $db = Database::get_instance();
    $statement = $db->prepare("DELETE FROM " . strtolower(get_class($this)) . " WHERE id=:id");
    $statement->bindParam(':id', $this->id);
    $statement->execute();
  }

}