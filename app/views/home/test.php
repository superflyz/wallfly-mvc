<?php
try {
    testOwner();
    testRealEstate();
    testAgent();
    testTenant();
    testPropertyCreate();
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

function testRealEstate() {
    echo ("<div id='test'><h6>Testing create real estate</h6>");
    $realEstate = Real_Estate::create([
        'name' => "ray white",
        'password' => create_hash("12345678"),
        'address' => "some address",
        'email' => "ray@white.com",
        'phone' => "1231231231",
        'photo' => null
    ]);
    echo ("<p>Real estate created - email is $realEstate->email</p></div>");

    echo ("<div id='test'><h6>Test getting ray@white.com from database</h6>");
    echo ("<p>Expected outcome = True");

    $result = Real_Estate::get(['name' => 'ray white'])[0];
    if ($result) {
        echo ("<p>Outcome = True</p>");
        passed();
    } else {
        echo ("<p>Outcome = False</p>");
        failed();
    }
    echo ("</div>");

    echo ("<div id='test'><h6>Test getting raysome@raysome.com from database</h6>");
    echo ("<p>Expected outcome = False");

    $result = Agent::get(['email' => 'raysome@raysome.com'])[0];
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
    $id = Real_Estate::get(['name' => 'ray white'])[0]->id;
    $agent = Agent::create([
        'email' => "someagent@someagent.com",
        'password' => create_hash("password1"),
        'firstname' => "agent",
        'lastname' => "smith",
        'phone' => "0403222222",
        'photo' => 'img/noimage.png',
        'real_estate_id' => $id
    ]);
    echo ("<p>Agent created - email is $agent->email</p></div>");

    echo ("<div id='test'><h6>Test getting someagent@someagent.com from database</h6>");
    echo ("<p>Expected outcome = True");

    $result = Agent::get(['email' => 'someagent@someagent.com'])[0];
    if ($result) {
        echo ("<p>Outcome = True</p>");
        passed();
    } else {
        echo ("<p>Outcome = False</p>");
        failed();
    }
    echo ("</div>");

    echo ("<div id='test'><h6>Test getting agentsome@agentsome.com from database</h6>");
    echo ("<p>Expected outcome = False");

    $result = Agent::get(['email' => 'agentsome@agentsome.com'])[0];
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
    echo ("<div id='test'><h6>Testing create tenant</h6>");
    $tenant = Tenant::create([
        'email' => "sometenant@sometenant.com",
        'password' => create_hash("password1"),
        'firstname' => "owner",
        'lastname' => "last",
        'phone' => "0403222222",
        'photo' => 'img/noimage.png'
    ]);
    echo ("<p>Tenant created - email is $tenant->email</p></div>");

    echo ("<div id='test'><h6>Test getting sometenant@sometenant.com from database</h6>");
    echo ("<p>Expected outcome = True");

    $result = Tenant::get(['email' => 'sometenant@sometenant.com'])[0];
    if ($result) {
        echo ("<p>Outcome = True</p>");
        passed();
    } else {
        echo ("<p class='fail'>Outcome = False</p>");
        failed();
    }
    echo ("</div>");

    echo ("<div id='test'><h6>Test getting sometenant1@sometenant.com from database</h6>");
    echo ("<p>Expected outcome = False");

    $result = Tenant::get(['email' => 'sometenant1@sometenant.com'])[0];
    if ($result) {
        echo ("<p>Outcome = True</p>");
        failed();
    } else {
        echo ("<p>Outcome = False</p>");
        passed();
    }
    echo ("</div>");
}

function testPropertyCreate() {
    echo ("<div id='test'><h6>Testing create a property</h6>");
    $property = Property::create([
        'address' => strip_tags('123 fake street'),
        'payment_schedule' => strip_tags('WEEKLY'),
        'rent_amount' => strip_tags('400'),
        'owner_id' => Owner::get(['email' => 'someowner@someowner.com'])[0]->id,
        'photo' => '/img/noimage.png'
    ]);
    echo ("<p>Property created - address is $property->address</p></div>");

    echo ("<div id='test'><h6>Test getting 123 fake street from database</h6>");
    echo ("<p>Expected outcome = True");

    $result = Property::get(['address' => '123 fake street'])[0];
    if ($result) {
        echo ("<p>Outcome = True</p>");
        passed();
    } else {
        echo ("<p class='fail'>Outcome = False</p>");
        failed();
    }
    echo ("</div>");

    echo ("<div id='test'><h6>Test getting 124 fake street from database</h6>");
    echo ("<p>Expected outcome = False");

    $result = Property::get(['address' => '124 fake street'])[0];
    if ($result) {
        echo ("<p>Outcome = True</p>");
        failed();
    } else {
        echo ("<p>Outcome = False</p>");
        passed();
    }
    echo ("</div>");
}

function passed() {
    echo ("<p class='pass'>Test Passed!</p>");
}

function failed() {
    echo ("<p class='fail'>Test Failed!</p>");
}

?>


