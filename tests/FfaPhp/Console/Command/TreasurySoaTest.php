<?php

namespace FfaPhp\Console\Command;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

// http://symfony.com/doc/current/console.html#testing-commands
class TreasurySoaTest extends\PHPUnit_Framework_TestCase 
{

    public function setUp() {
        $application = new Application();
        $application->add(new TreasurySoa());

        $this->command = $application->find('treasury:soa');
        $this->commandTester = new CommandTester($this->command);
    }

    public function testExecuteFormatEmail()
    {
        $this->commandTester->execute(array(
            'command' => $this->command->getName(),
            '--base' => 'Dubai',
            '--format' => 'email',
            '--emailTo' => 'some@email.com;another@email.com'
        ));
    }

    public function testExecuteFormatEmailNotifyPublish()
    {
        $this->commandTester->execute(array(
            'command' => $this->command->getName(),
            '--base' => 'Dubai',
            '--format' => 'email',
            '--emailTo' => 'some@email.com;another@email.com',
            'notifyTracker',
            'publishToBlog'
        ));
    }

}
