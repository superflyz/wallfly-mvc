<?php

class Property extends Model
{

  public $id, $address, $payment_schedule, $rent_amount, $photo, $real_estate_id,
    $agent_id, $owner_id;

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
      $statement = $db->prepare("SELECT * FROM payment WHERE property_id=:property_id ORDER BY timestamp DESC");
      $statement->execute(['property_id' => $this->id]);
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

  public function addPayment($amount)
  {
    try {
      $db = Database::getInstance();
      $tenantId = $this->getTenant();
      $statement = $db->prepare("INSERT INTO payment (tenant_id, property_id, timestamp, amount) VALUES
        (:tenant_id, :property_id, :timestamp, :amount)");
      $statement->execute(['tenant_id' => $tenantId, 'property_id' => $this->id, 'timestamp' => date('Y-m-d G:i:s'), 'amount' => $amount]);
      return true;
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
    return false;
  }

  public function getTenant()
  {
    try {
      $db = Database::getInstance();
      $statement = $db->prepare("SELECT * FROM super_user, property, tenant WHERE property.id=:property_id AND tenant.property_id=property.id AND super_user.id=tenant.super_user_id");
      $statement->execute(['property_id' => $this->id]);
      $result = Array();
      while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $tmp = Array("tenant_id" => $row['super_user_id']);
        array_push($result, $tmp);
      }
      if (count($result) == 0) {
        return false;
      }
      return $result[0]['tenant_id'];
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
    return false;
  }
}
