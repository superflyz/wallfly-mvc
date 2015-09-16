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
}
