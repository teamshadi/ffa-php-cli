<?php

namespace FfaPhp\Console\Command;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

// http://symfony.com/doc/current/console.html#testing-commands
class TreasuryFfa017Test extends\PHPUnit_Framework_TestCase 
{

    public function setUp() {
        $application = new Application();
        $application->add(new TreasuryFfa017());

        $this->command = $application->find('treasury:ffa017');
        $this->commandTester = new CommandTester($this->command);
    }

    public function testExecuteEmailto()
    {
        $this->commandTester->execute(array(
            'command' => $this->command->getName(),
            '--emailTo' => 'some@email.com;another@email.com'
        ));
    }

}
