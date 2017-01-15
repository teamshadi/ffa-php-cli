<?php

namespace FfaPhp\Console\Command;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

// http://symfony.com/doc/current/console.html#testing-commands
class TreasuryDebitInterestTest extends\PHPUnit_Framework_TestCase 
{

    public function setUp() {
        $application = new Application();
        $application->add(new TreasuryDebitInterest());

        $this->command = $application->find('treasury:debit-interest');
        $this->commandTester = new CommandTester($this->command);
    }

    public function testExecuteBare()
    {
        $this->commandTester->execute(array(
            'command'  => $this->command->getName()
        ));

        // the output of the command in the console
        //$output = $this->commandTester->getDisplay();
        //$this->assertContains('Username: Wouter', $output);
    }

    public function testExecuteFormatJson()
    {
        $this->commandTester->execute(array(
            'command' => $this->command->getName(),
            '--format' => 'json'
        ));
    }

    public function testExecuteFormatJsonDateMonth()
    {
        $this->commandTester->execute(array(
            'command' => $this->command->getName(),
            '--format' => 'emailIfAny',
            'date_month' => '2015-01'
        ));
    }

    public function testExecuteFormatEmailIfAny()
    {
        $this->commandTester->execute(array(
            'command' => $this->command->getName(),
            '--format' => 'emailIfAny'
        ));
    }

    public function testExecuteFormatEmailIfAnyAccountTypeTanyaNotifyPublish()
    {
        $this->commandTester->execute(array(
            'command' => $this->command->getName(),
            '--format' => 'emailIfAny',
            'accountType' => 'Tanya',
            'notifyTracker',
            'publishToBlog'
        ));
    }

}
