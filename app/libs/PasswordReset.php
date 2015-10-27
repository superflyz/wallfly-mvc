<?php
/**
 * Created by PhpStorm.
 * User: jimmykovacevic
 * Date: 27/10/2015
 * Time: 8:26 PM
 */
class PasswordReset
{
    public static function sendReset($email)
    {
        try {
            $db = Database::getInstance();
            $link = uniqid();
            $statement = $db->prepare("INSERT INTO password_reset (email, link) VALUES(:email, :link)");
            $statement->execute(['email' => $email, 'link' => $link]);
            return true;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return false;
    }
}