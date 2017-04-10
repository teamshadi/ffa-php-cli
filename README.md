# ffa-php-cli [![Build Status](https://travis-ci.org/shadiakiki1986/ffa-php-cli.svg?branch=master)](https://travis-ci.org/shadiakiki1986/ffa-php-cli)
A [CLI](https://en.wikipedia.org/wiki/Command-line_interface) for `ffa-php-core`

# Installation
Below code snippets are for linux

1. Install php 7
2. Install [composer](https://getcomposer.org/download/)
3. Install package dependencies: `php composer.phar install`

# Usage
The current CLI is in another repository and needs to be rewritten.
This is the rewrite, and it uses [Symfony2/Console](http://symfony.com/doc/current/console.html).
Here are example usages before and after the rewrite:

Currently
```bash
php bin/ffa-old-treasury-debitInterest.php
php bin/ffa-old-treasury-debitInterest.php format=json
php bin/ffa-old-treasury-debitInterest.php format=json       date_month=2015-01
php bin/ffa-old-treasury-debitInterest.php format=emailIfAny
php bin/ffa-old-treasury-debitInterest.php format=emailIfAny accountType=Tanya notifyTracker=true publishToBlog=true
```

To become
```bash
php bin/ffa.php treasury:debit-interest
php bin/ffa.php treasury:debit-interest --format=json
php bin/ffa.php treasury:debit-interest --format=json       --date_month=2015-01
php bin/ffa.php treasury:debit-interest --format=emailIfAny
php bin/ffa.php treasury:debit-interest --format=emailIfAny --accountType=Tanya --notifyTracker --publishToBlog
```

The rewrite process will start with the treasury debit interests report and gradually include all other reports
