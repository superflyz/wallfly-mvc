<?php

class Property extends Model
{

  public $id, $address, $payment_schedule, $rent_amount, $photo,
    $agent_id, $owner_id, $tenant_id;

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
        $statement = $db->prepare("SELECT * FROM repair_request WHERE property_id=:property_id AND tenant_id=:tenant_id
          ORDER BY update_timestamp DESC");
        $statement->execute(['property_id' => $this->id, 'tenant_id' => $_SESSION['user']->id]);
      } else {
        $statement = $db->prepare("SELECT * FROM repair_request WHERE property_id=:property_id ORDER BY update_timestamp ASC");
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

  public function addRepairRequest($subject, $description, $severity, $image)
  {
    try {
      $db = Database::getInstance();
      $statement = $db->prepare("INSERT INTO repair_request (tenant_id, property_id, timestamp, update_timestamp, subject, description,
        severity_level, status, image) VALUES (:tenant_id, :property_id, :timestamp, :update_timestamp, :subject, :description,
        :severity_level, :status, :image)");
      $statement->execute(['tenant_id' => $_SESSION['user']->id, 'property_id' => $this->id, 'timestamp' => date('Y-m-d G:i:s'), 'update_timestamp' => date('Y-m-d G:i:s'),
        'subject' => $subject, 'description' => $description, 'severity_level' => $severity, 'status' => 0, 'image' => $image]);
      return true;
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
    return false;
  }

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

  public function getTenant()
  {
    $tenant = Tenant::get(['id' => $this->tenant_id]);
    return $tenant ? $tenant[0] : false;
  }

  public function getOwner()
  {
    $owner = Owner::get(['id' => $this->owner_id]);
    return $owner ? $owner[0] : false;
  }

}
