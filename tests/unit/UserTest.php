<?php

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase{
    public function testThatWeCanGetTheFirstName(){
        $user = new User;

        $user->setFirstName('Favour');

        $this->assertEquals($user->getFirstName(), 'Favour');
    }

    public function testThatWeCanGetTheLasttName(){
        $user = new User;

        $user->setLastName('Akpan');

        $this->assertEquals($user->getLastName(), 'Akpan');
    }

    public function testFullNameIsReturned(){
        $user = new User;

        $user->setFirstName('Favour');
        $user->setLastName('Akpan');

        $this->assertEquals($user->getFullName(), 'Favour Akpan');
    }

    public function testFirstAndLastNameAreTrimmed(){
        $user = new User;
        $user->setFirstName(' Favour      ');
        $user->setLastName("     Akpan");

        $this->assertEquals($user->getFirstName(), 'Favour');
        $this->assertEquals($user->getLastName(), 'Akpan');

    }

    public function testEmailAddressCanBeSet(){
        $user = new User;
        $user->setEmail('favour@gmail.com');

        $this->assertEquals($user->getEmail(), 'favour@gmail.com');
    }

    public function testEmailVariablesContainCorrectValues(){
        $user = new User;

        $user->setFirstName('Favour');
        $user->setLastName('Akpan');
        $user->setEmail('favour@gmail.com');

        $emailVariables = $user->getEmailVariables();

        $this->assertArrayHasKey('full_name', $emailVariables);
        $this->assertArrayHasKey('email', $emailVariables);

        $this->assertEquals($emailVariables['full_name'], 'Favour Akpan');
        $this->assertEquals($emailVariables['email'], 'favour@gmail.com');
    }
}