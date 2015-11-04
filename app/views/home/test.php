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
    echo ("<div class='test'><p class='line'>Testing create owner</p>");
    echo ("<p>This tests creating an owner. The owner should have an account with the email someowner@someowner.com</p>");
    $owner = Owner::create([
        'email' => "someowner@someowner.com",
        'password' => create_hash("password1"),
        'firstname' => "owner",
        'lastname' => "last",
        'phone' => "0403222222",
        'photo' => 'img/noimage.png'
    ]);
    echo ("<p>Owner created - email is $owner->email</p></div>");

    echo ("<div class='test'><p class='line'>Test getting someowner@someowner.com from database</p>");
    echo ("<p>This test checks to see if the owner was created and stored in the database. The database will return an owner object if it did, otherwise it will return false.</p>");
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

    echo ("<div class='test'><p class='line'>Test getting no@no.com from database</p>");
    echo ("<p>This tests getting an owner which is not in the database. It should return false as there is no owner with the email no@no.com</p>");
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
    echo ("<div class='test'><p class='line'>Testing create real estate</p>");
    echo ("<p>This tests creating a real estate company. The company should have an account with the email ray@white.com</p>");

    $realEstate = Real_Estate::create([
        'name' => "ray white",
        'password' => create_hash("12345678"),
        'address' => "some address",
        'email' => "ray@white.com",
        'phone' => "1231231231",
        'photo' => null
    ]);
    echo ("<p>Real estate created - email is $realEstate->email</p></div>");

    echo ("<div class='test'><p class='line'>Test getting ray@white.com from database</p>");
    echo ("<p>This test checks to see if the real estate company was created and stored in the database. The database will return a real estate object if it did, otherwise it will return false.</p>");
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

    echo ("<div class='test'><p class='line'>Test getting raysome@raysome.com from database</p>");
    echo ("<p>This tests getting a real estate company which is not in the database. It should return false as there is no company with the name ray black</p>");
    echo ("<p>Expected outcome = False");

    $result = Agent::get(['name' => 'ray black'])[0];
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
    echo ("<div class='test'><p class='line'>Testing create agent</p>");
    echo ("<p>This tests creating an agent. The agent should have an account with the email someagent@someagent.com</p>");
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

    echo ("<div class='test'><p class='line'>Test getting someagent@someagent.com from database</p>");
    echo ("<p>This test checks to see if the agent was created and stored in the database. The database will return an agent object if it did, otherwise it will return false.</p>");
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

    echo ("<div class='test'><p class='line'>Test getting agentsome@agentsome.com from database</p>");
    echo ("<p>This tests getting an agent which is not in the database. It should return false as there is no agent with the email agentsome@agentsome.com</p>");
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
    echo ("<div class='test'><p class='line'>Testing create tenant</p>");
    echo ("<p>This tests creating a tenant. The tenant should have an account with the email sometenant@sometenant.com</p>");
    $tenant = Tenant::create([
        'email' => "sometenant@sometenant.com",
        'password' => create_hash("password1"),
        'firstname' => "owner",
        'lastname' => "last",
        'phone' => "0403222222",
        'photo' => 'img/noimage.png'
    ]);
    echo ("<p>Tenant created - email is $tenant->email</p></div>");

    echo ("<div class='test'><p class='line'>Test getting sometenant@sometenant.com from database</p>");
    echo ("<p>This test checks to see if the tenant was created and stored in the database. The database will return a tenant object if it did, otherwise it will return false.</p>");
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

    echo ("<div class='test'><p class='line'>Test getting sometenant1@sometenant.com from database</p>");
    echo ("<p>This tests getting a tenant which is not in the database. It should return false as there is no tenant with the email sometenant1@sometenant.com</p>");
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
    echo ("<div class='test'><p class='line'>Testing create a property</p>");
    echo ("<p>This tests creating a property. The property should have an address of 123 fake street</p>");
    $property = Property::create([
        'address' => strip_tags('123 fake street'),
        'payment_schedule' => strip_tags('WEEKLY'),
        'rent_amount' => strip_tags('400'),
        'owner_id' => Owner::get(['email' => 'someowner@someowner.com'])[0]->id,
        'photo' => '/img/noimage.png'
    ]);
    echo ("<p>Property created - address is $property->address</p></div>");

    echo ("<div class='test'><p class='line'>Test getting 123 fake street from database</p>");
    echo ("<p>This test checks to see if the property was created and stored in the database. The database will return a property object if it did, otherwise it will return false.</p>");
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

    echo ("<div class='test'><p class='line'>Test getting 124 fake street from database</p>");
    echo ("<p>This tests getting a property which is not in the database. It should return false as there is no property with the address 124 fake street</p>");
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


