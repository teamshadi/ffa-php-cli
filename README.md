# ffa-php-cli [![Build Status](https://travis-ci.org/shadiakiki1986/ffa-php-cli.svg?branch=master)](https://travis-ci.org/shadiakiki1986/ffa-php-cli)
A [CLI](https://en.wikipedia.org/wiki/Command-line_interface) for [ffa-php-mock](https://github.com/shadiakiki1986/ffa-php-mock) and `ffa-php-core`

# Installation
Below code snippets are for linux

1. Install php 7
2. Install [composer](https://getcomposer.org/download/)
3. Install package dependencies: `php composer.phar install`

# Usage
The current CLI is in another repository and needs to be rewritten.
This is the rewrite, and it uses [Symfony2/Console](http://symfony.com/doc/current/console.html).
Here are example usages before and after the rewrite:

## treasury: debit interest
Currently in [ffa-php-mock](https://github.com/shadiakiki1986/ffa-php-mock):
```bash
php bin/treasury-debitInterest.php
php bin/treasury-debitInterest.php format=json
php bin/treasury-debitInterest.php format=json       date_month=2015-01
php bin/treasury-debitInterest.php format=emailIfAny
php bin/treasury-debitInterest.php format=emailIfAny accountType=Tanya notifyTracker=true publishToBlog=true
```

To become in this package:
```bash
php bin/ffa.php treasury:debit-interest
php bin/ffa.php treasury:debit-interest --format=json
php bin/ffa.php treasury:debit-interest --format=json       --date_month=2015-01
php bin/ffa.php treasury:debit-interest --format=emailIfAny
php bin/ffa.php treasury:debit-interest --format=emailIfAny --accountType=Tanya --notifyTracker --publishToBlog
```

The rewrite process will start with the treasury debit interests report and gradually include all other reports

## treasury: SOA
Old
```bash
php bin/treasury-soa.php format=email emailTo=shadi@akikieng.com base=Dubai
php bin/treasury-soa.php format=email emailTo=shadi@akikieng.com base=Dubai notifyTracker=true publishToBlog=true
```

To become
```
php bin/ffa.php treasury:soa --base=Dubai --format=email --emailTo="some@email.com;another@email.com"
php bin/ffa.php treasury:soa --base=Dubai --format=email --emailTo="some@email.com;another@email.com" --notifyTracker --publishToBlog
```
