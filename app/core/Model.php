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
    try {
      $db = Database::getInstance();
      $variables = get_object_vars($this);
      $parentclass = get_parent_class($this);
      $tablename = $parentclass !== 'Model' ? $parentclass : get_class($this);
      $tablename = strtolower($tablename);
      $statement = "INSERT INTO " . $tablename . " (";
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
      $this->id = $db->lastInsertId();
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function update()
  {
    $db = Database::getInstance();
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
    foreach ($this as $key => $value)
    {
      $statement->bindParam(":" . $key, $variables[$key]);
    }
    $statement->execute();
  }

  public function delete()
  {
    $db = Database::getInstance();
    $statement = $db->prepare("DELETE FROM " . strtolower(get_class($this)) . " WHERE id=:id");
    $statement->bindParam(':id', $this->id);
    $statement->execute();

  }

  public static function create($data)
  {
    $classname = get_called_class();
    $object = new $classname($data);
    $object->save();
    return $object;
  }

}
