<?php

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    protected $user;

    public function setUp():void{
       $this->user = new User;
    }

    /** @test */
    public function thatWeCanGetTheFirstName(){

        $this->user->setFirstName('Favour');

        $this->assertEquals($this->user->getFirstName(), 'Favour');
    }

    public function testThatWeCanGetTheLasttName(){

        $this->user->setLastName('Akpan');

        $this->assertEquals($this->user->getLastName(), 'Akpan');
    }

    public function testFullNameIsReturned(){

        $this->user->setFirstName('Favour');
        $this->user->setLastName('Akpan');

        $this->assertEquals($this->user->getFullName(), 'Favour Akpan');
    }

    public function testFirstAndLastNameAreTrimmed(){
        $this->user->setFirstName(' Favour      ');
        $this->user->setLastName("     Akpan");

        $this->assertEquals($this->user->getFirstName(), 'Favour');
        $this->assertEquals($this->user->getLastName(), 'Akpan');

    }

    public function testEmailAddressCanBeSet(){
        $this->user->setEmail('favour@gmail.com');

        $this->assertEquals($this->user->getEmail(), 'favour@gmail.com');
    }

    public function testEmailVariablesContainCorrectValues(){

        $this->user->setFirstName('Favour');
        $this->user->setLastName('Akpan');
        $this->user->setEmail('favour@gmail.com');

        $emailVariables = $this->user->getEmailVariables();

        $this->assertArrayHasKey('full_name', $emailVariables);
        $this->assertArrayHasKey('email', $emailVariables);

        $this->assertEquals($emailVariables['full_name'], 'Favour Akpan');
        $this->assertEquals($emailVariables['email'], 'favour@gmail.com');
    }
}