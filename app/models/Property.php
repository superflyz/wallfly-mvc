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
      $statement->execute(['tenant_id' => $this->tenant_id, 'property_id' => $this->id, 'timestamp' => date('Y-m-d G:i:s'), 'rent_period_start' => $start, 'rent_period_end' => $end, 'amount' => $amount]);
      return true;
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
    return false;
  }

}
