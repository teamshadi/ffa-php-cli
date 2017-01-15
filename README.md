# ffa-php-cli
A CLI for `ffa-php-core`

# Installation
Below code snippets are for linux

1. Install php 7
2. Install [composer](https://getcomposer.org/download/)
```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === 'c32408bcd017c577ce80605420e5987ce947a5609e8443dd72cd3867cc3a0cf442e5bf4edddbcbe72246a953a6c48e21') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

3. Install package dependencies
```bash
composer install
```

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
