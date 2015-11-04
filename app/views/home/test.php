<?php
echo ("<p>Removing rows from database</p>");
try {
    $db = Database::getInstance();
    $statement = $db->prepare("
                              DELETE FROM calendar;
                              DELETE FROM chat;
                              DELETE FROM documents;
                              DELETE FROM inspections;
                              DELETE FROM notifications;
                              DELETE FROM payment;
                              DELETE FROM repair_request;
                              DELETE FROM property;
                              DELETE FROM super_user;
                              DELETE FROM tenant;
                              DELETE FROM agent;
                              DELETE FROM owner;
                              DELETE FROM real_estate;");
    $statement->execute();
    echo ("<p>Rows removed</p>");

    echo ("<p>Testing create owner</p>");

    Owner::create([
        'email' => "someowner@someowner.com",
        'password' => create_hash("password1"),
        'firstname' => "owner",
        'lastname' => "last",
        'phone' => "0403222222",
        'photo' => 'img/noimage.png'
    ]);

} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}


