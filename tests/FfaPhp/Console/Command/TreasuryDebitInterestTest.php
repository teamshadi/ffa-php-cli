<?php

namespace Ffaphp\Console\Command;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

// http://symfony.com/doc/current/console.html#testing-commands
class TreasuryDebitInterestTest extends\PHPUnit_Framework_TestCase 
{

    public function setUp() {
        $application = new Application();
        $application->add(new TreasuryDebitInterest());

        $command = $application->find('treasury:debit-interest');
        $this->commandTester = new CommandTester($command);
    }

    public function testExecuteBare()
    {
        $commandTester->execute(array(
            'command'  => $command->getName()
        ));

        // the output of the command in the console
        //$output = $commandTester->getDisplay();
        //$this->assertContains('Username: Wouter', $output);
    }

    public function testExecuteFormatJson()
    {
        $commandTester->execute(array(
            'command' => $command->getName(),
            'format' => 'json'
        ));
    }

    public function testExecuteFormatJsonDateMonth()
    {
        $commandTester->execute(array(
            'command' => $command->getName(),
            'format' => 'emailIfAny',
            'date_month' => '2015-01'
        ));
    }

    public function testExecuteFormatEmailIfAny()
    {
        $commandTester->execute(array(
            'command' => $command->getName(),
            'format' => 'emailIfAny'
        ));
    }

    public function testExecuteFormatEmailIfAnyAccountTypeTanyaNotifyPublish()
    {
        $commandTester->execute(array(
            'command' => $command->getName(),
            'format' => 'emailIfAny',
            'accountType' => 'Tanya',
            'notifyTracker',
            'publishToBlog'
        ));
    }

}
