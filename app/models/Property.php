<?php

class Property extends Model
{

  public $id, $address, $payment_schedule, $rent_amount, $photo, $real_estate_id,
    $agent_id, $owner_id, $tenant_id;

  public function getAgent()
  {
    $agent = Agent::get(['id' => $this->agent_id]);
    return $agent ? $agent[0] : null;
  }

  public static function findByOwner($ownerid)
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

  public static function get($data)
  {
    try {
      $db = Database::getInstance();
      $query = "SELECT * FROM property WHERE ";
      $i = 0;
      foreach ($data as $key => $value) {
        $query .= $key . '=:' . $key;
        if ($i != sizeof($data)-1) {
          $query .= ' AND ';
        }
        $i++;
      }
      $statement = $db->prepare($query);
      $statement->execute($data);
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      $result = array_map(function($row) {
        return new Property($row);
      }, $result);
      return $result;
    } catch (Exception $e) {
      return false;
    }
  }

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
        $tmp = Array("time" => $row['timestamp'], "amount" => $row['amount']);
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

  public function addPayment($name, $start, $end, $amount)
  {
    try {
      $db = Database::getInstance();
      $statement = $db->prepare("INSERT INTO payment (tenant_id, property_id, timestamp, rent_period_start, rent_period_end, amount) VALUES
        (:tenant_id, :property_id, :timestamp, :rent_period_start, :rent_period_end, :amount)");
      $statement->execute(['tenant_id' => $this->tenant_id, 'property_id' => $this->id, 'timestamp' => date('Y-m-d G:i:s'), 'rent_period_start' => date("Y-m-d", strtotime($start)), 'rent_period_end' => date("Y-m-d", strtotime($end)), 'amount' => $amount]);
      return true;
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
    return false;
  }

  public function getRepairRequests()
  {
    try {
      $db = Database::getInstance();
      if ($_SESSION['usertype'] == USERTYPE_TENANT) {
        $statement = $db->prepare("SELECT * FROM repair_request WHERE property_id=:property_id AND tenant_id=:tenant_id");
        $statement->execute(['property_id' => $this->id, 'tenant_id' => $_SESSION['user']->id]);
      } else {
        $statement = $db->prepare("SELECT * FROM repair_request WHERE property_id=:property_id");
        $statement->execute(['property_id' => $this->id]);
      }
      $result = Array();
      while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $tmp = Array("tenant_id" => $row['tenant_id'], "property_id" => $row['property_id'],
            "timestamp" => $row['timestamp'], "subject" => $row['subject'], "description" => $row['description'],
            "severity_level" => $row['severity_level'], "status" => $row['status'], "image" => $row['image']);
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

  public function addRepairRequest($subject, $description, $severity, $image)
  {
    try {
      $db = Database::getInstance();
      $statement = $db->prepare("INSERT INTO repair_request (tenant_id, property_id, timestamp, subject, description,
        severity_level, status, image) VALUES (:tenant_id, :property_id, :timestamp, :subject, :description,
        :severity_level, :status, :image)");
      $statement->execute(['tenant_id' => $_SESSION['user']->id, 'property_id' => $this->id, 'timestamp' => date('Y-m-d G:i:s'),
        'subject' => $subject, 'description' => $description, 'severity_level' => $severity, 'status' => 0, 'image' => $image]);
      return true;
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
    return false;
  }

  public function processRepairRequest($timestamp, $value)
  {
    try {
      $db = Database::getInstance();
      if ($value == "approve") {
        $statement = $db->prepare("UPDATE repair_request SET status=1 WHERE property_id=:property_id AND timestamp=:timestamp");
        $statement->execute(['property_id' => $this->id, 'timestamp' => $timestamp]);
      } elseif ($value == "deny") {
        $statement = $db->prepare("UPDATE repair_request SET status=2 WHERE property_id=:property_id AND timestamp=:timestamp");
        $statement->execute(['property_id' => $this->id, 'timestamp' => $timestamp]);
      }
      return true;
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
    return false;
  }

}
