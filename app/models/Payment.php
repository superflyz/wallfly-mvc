<?php
/**
Unused...?
 */

class Payment extends Model
{
    public function getPayments() {
        try {
            $db = Database::getInstance();
            $statement = $db->prepare("SELECT * FROM payment WHERE property_id=:property_id");
            $statement->execute(['property_id' => $this->id]);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $result = array_map(function($row) {
                return new Payment($row);
            }, $result);
            return $result;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return false;
    }
}