<?php
try {
    testOwner();
    testAgent();
    testTenant();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

function testOwner() {
    echo ("<div id='test'><h6>Testing create owner</h6>");
    $owner = Owner::create([
        'email' => "someowner@someowner.com",
        'password' => create_hash("password1"),
        'firstname' => "owner",
        'lastname' => "last",
        'phone' => "0403222222",
        'photo' => 'img/noimage.png'
    ]);
    echo ("<p>Owner created - email is $owner->email</p></div>");

    echo ("<div id='test'><h6>Test getting someowner@someowner.com from database</h6>");
    echo ("<p>Expected outcome = True");

    $result = Owner::get(['email' => 'someowner@someowner.com'])[0];
    if ($result) {
        echo ("<p>Outcome = True</p>");
        passed();
    } else {
        echo ("<p class='fail'>Outcome = False</p>");
        failed();
    }
    echo ("</div>");

    echo ("<div id='test'><h6>Test getting no@no.com from database</h6>");
    echo ("<p>Expected outcome = False");

    $result = Owner::get(['email' => 'no@no.com'])[0];
    if ($result) {
        echo ("<p>Outcome = True</p>");
        failed();
    } else {
        echo ("<p>Outcome = False</p>");
        passed();
    }
    echo ("</div>");
}

function testAgent() {
    echo ("<div id='test'><h6>Testing create agent</h6>");
    $owner = Owner::create([
        'email' => "someagent@someagent.com",
        'password' => create_hash("password1"),
        'firstname' => "agent",
        'lastname' => "smith",
        'phone' => "0403222222",
        'photo' => 'img/noimage.png'
    ]);
    echo ("<p>Owner created - email is $owner->email</p></div>");

    echo ("<div id='test'><h6>Test getting someowner@someowner.com from database</h6>");
    echo ("<p>Expected outcome = True");

    $result = Owner::get(['email' => 'someagent@someagent.com'])[0];
    if ($result) {
        echo ("<p>Outcome = True</p>");
        passed();
    } else {
        echo ("<p class='fail'>Outcome = False</p>");
        failed();
    }
    echo ("</div>");

    echo ("<div id='test'><h6>Test getting agentsome@agentsome.com from database</h6>");
    echo ("<p>Expected outcome = False");

    $result = Owner::get(['email' => 'no@no.com'])[0];
    if ($result) {
        echo ("<p>Outcome = True</p>");
        failed();
    } else {
        echo ("<p>Outcome = False</p>");
        passed();
    }
    echo ("</div>");
}

function testTenant() {

}

function passed() {
    echo ("<p class='pass'>Test Passed!</p>");
}

function failed() {
    echo ("<p class='fail'>Test Failed!</p>");
}

?>


