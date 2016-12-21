<?php

// http://symfony.com/doc/current/components/console.html
require __DIR__.'/../vendor/autoload.php';
use Symfony\Component\Console\Application;
$application = new Application();
$application->add(new \FfaPhp\Console\Command\TreasuryDebitInterest());
$application->run();
