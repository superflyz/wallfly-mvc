<?php

class Property extends Model
{

  public $id, $address, $payment_schedule, $rent_amount, $photo,
    $agent_id, $owner_id, $tenant_id;

  //Returns the Agent linked to the property if one exists, null otherwise.
  public function getAgent()
  {
    $agent = Agent::get(['id' => $this->agent_id]);
    return $agent ? $agent[0] : null;
  }

  public static function find_by_owner($ownerid)
  {
    try {
      $db = Database::getInstance();
      $result = $db->query("SELECT * FROM property WHERE owner_id={$ownerid}");
      $owners = [];
      while ($result = $result->fetchObject()) {
        $owners[] = new Property($result);
      }
      return $owners;
    } catch (Exception $e) {

    }

  }

  //Gets all payments made for a property. Returns an array map with timestamp, amount, payee name if a payment exists.
  //Returns false if property has no payments for made.
  public function getPayments()
  {
    try {
      $db = Database::getInstance();
      if ($_SESSION['usertype'] != USERTYPE_TENANT) {
        $statement = $db->prepare("SELECT * FROM payment WHERE property_id=:property_id ORDER BY timestamp DESC");
        $statement->execute(['property_id' => $this->id]);
      } else {
        $statement = $db->prepare("SELECT * FROM payment WHERE property_id=:property_id AND tenant_id=:tenant_id ORDER BY timestamp DESC");
        $statement->execute(['property_id' => $this->id, 'tenant_id' => $_SESSION['user']->id]);
      }
      $result = Array();
      while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $tmp = Array("time" => $row['timestamp'], "amount" => $row['amount'], "payee" => $row['payee_name']);
        array_push($result, $tmp);
      }
      if (count($result) == 0) {
        return false;
      }
      return $result;
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
    return false;
  }

  //Adds a payment to the database for a property. Returns true if successful, false otherwise.
  public function addPayment($name, $start, $end, $amount)
  {
    try {
      $db = Database::getInstance();
      $statement = $db->prepare("INSERT INTO payment (tenant_id, property_id, timestamp, rent_period_start, rent_period_end, amount, payee_name) VALUES
        (:tenant_id, :property_id, :timestamp, :rent_period_start, :rent_period_end, :amount, :payee_name)");
      $statement->execute(['tenant_id' => $this->tenant_id, 'property_id' => $this->id, 'timestamp' => date('Y-m-d G:i:s'),
        'rent_period_start' => date("Y-m-d", strtotime($start)), 'rent_period_end' => date("Y-m-d", strtotime($end)), 'amount' => $amount, 'payee_name' => $name]);
      return true;
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
    return false;
  }

  //Gets and returns an array of all repair requests for a property. Returns false if no requests exist.
  public function getRepairRequests()
  {
    try {
      $db = Database::getInstance();
      if ($_SESSION['usertype'] == USERTYPE_TENANT) {
        $statement = $db->prepare("SELECT * FROM repair_request WHERE property_id=:property_id AND tenant_id=:tenant_id
          ORDER BY update_timestamp DESC");
        $statement->execute(['property_id' => $this->id, 'tenant_id' => $_SESSION['user']->id]);
      } else {
        $statement = $db->prepare("SELECT * FROM repair_request WHERE property_id=:property_id ORDER BY status ASC");
        $statement->execute(['property_id' => $this->id]);
      }
      $result = Array();
      while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $tmp = Array("tenant_id" => $row['tenant_id'], "property_id" => $row['property_id'],
            "timestamp" => $row['timestamp'], "update_timestamp" => $row['update_timestamp'], "subject" => $row['subject'], "description" => $row['description'],
            "severity_level" => $row['severity_level'], "status" => $row['status'], "image" => $row['image'],
            "comment" => $row['comment']);
        array_push($result, $tmp);
      }
      if (count($result) == 0) {
        return false;
      }
      return $result;
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
    return false;
  }

  //Adds a repair request for a property. Returns true if successful, false otherwise.
  public function addRepairRequest($subject, $description, $severity, $image)
  {
    try {
      $db = Database::getInstance();
      $statement = $db->prepare("INSERT INTO repair_request (tenant_id, property_id, timestamp, update_timestamp, subject, description,
        severity_level, status, image) VALUES (:tenant_id, :property_id, :timestamp, :update_timestamp, :subject, :description,
        :severity_level, :status, :image)");
      $statement->execute(['tenant_id' => $_SESSION['user']->id, 'property_id' => $this->id, 'timestamp' => date('Y-m-d G:i:s'), 'update_timestamp' => date('Y-m-d G:i:s'),
        'subject' => $subject, 'description' => $description, 'severity_level' => $severity, 'status' => 0, 'image' => WEBDIR . $image]);
      return true;
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
    return false;
  }

  //Allows an Agent or Owner to repair or deny a repair request. Returns true if a request status was updated,
  //false otherwise.
  public function processRepairRequest($timestamp, $value, $comment)
  {
    try {
      $db = Database::getInstance();
      if ($value == "approve") {
        $statement = $db->prepare("UPDATE repair_request SET status=1, comment=:comment, update_timestamp=:update_timestamp WHERE property_id=:property_id AND timestamp=:timestamp");
        $statement->execute(['comment' => $comment, 'update_timestamp' => date('Y-m-d G:i:s'), 'property_id' => $this->id, 'timestamp' => $timestamp]);
      } elseif ($value == "deny") {
        $statement = $db->prepare("UPDATE repair_request SET status=2, comment=:comment, update_timestamp=:update_timestamp WHERE property_id=:property_id AND timestamp=:timestamp");
        $statement->execute(['comment' => $comment, 'update_timestamp' => date('Y-m-d G:i:s'), 'property_id' => $this->id, 'timestamp' => $timestamp]);
      }
      return true;
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
    return false;
  }

  //Allows a tenant to change the severity of a repair request. Returns true if successful, false otherwise.
  public function changeSeverity($timestamp, $severity)
  {
    try {
      $db = Database::getInstance();
      $statement = $db->prepare("UPDATE repair_request SET severity_level=:severity_level, update_timestamp=:update_timestamp WHERE property_id=:property_id AND timestamp=:timestamp");
      $statement->execute(['severity_level' => $severity, 'update_timestamp' => date('Y-m-d G:i:s'), 'property_id' => $this->id, 'timestamp' => $timestamp]);
      return true;
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
    return false;
  }

  public function getRealEstate()
  {
    if ($agent = $this->getAgent()) {
      return $agent->getRealEstate();
    } else {
      return false;
    }
  }

  //Gets and returns a Tenant linked to the property if one exists, false otherwise.
  public function getTenant()
  {
    $tenant = Tenant::get(['id' => $this->tenant_id]);
    return $tenant ? $tenant[0] : false;
  }

  //Gets and returns an Owner linked to the property if one exists, false otherwise.
  public function getOwner()
  {
    $owner = Owner::get(['id' => $this->owner_id]);
    return $owner ? $owner[0] : false;
  }

  //Links a tenant to the property.
  public function setTenant($tenant)
  {
    $this->tenant_id = $tenant->id;
    $this->update();
  }

  //Gets the amount of rent charged for the property.
  public function getRent()
  {
    return $this->rent_amount;
  }

  //Gets and returns a property from the database if one exists, false otherwise. Data should be in the form of
  //key, value pairs.
  public static function get($data)
  {
    $query = "SELECT * FROM property WHERE ";
    $i = 0;
    foreach ($data as $key => $value) {
      $query .= $key . '=:' . $key;
      if ($i !== sizeof($data)-1) {
        $query .= ' AND ';
      }
      $i++;
    }
    try {
      $db = Database::getInstance();
      $statement = $db->prepare($query);
      $statement->execute($data);
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      if ($result) {
        $result = array_map(function($row) {
          return new Property($row);
        }, $result);
        return $result;
      } else {
        return false;
      }
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }

}
