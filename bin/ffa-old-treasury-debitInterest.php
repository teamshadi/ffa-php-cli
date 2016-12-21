<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/argsProcessor.php';
require_once __DIR__.'/../src/contactTracker.php';

$publishToBlog=false;

if(!array_key_exists("date_month",$_GET)) $_GET['date_month']=date('Y-m'); # default
if(!array_key_exists("format",$_GET)) $_GET['format']="html"; # default
if(!in_array($_GET['format'],array("html","json","emailIfAny"))) throw new Exception("Unsupported format. Please use html or json");
if(!array_key_exists("accountType",$_GET)) $_GET['accountType']="Tanya"; # default
if(!array_key_exists("notifyTracker",$_GET)) $_GET['notifyTracker']=false; else $_GET['notifyTracker']=($_GET['notifyTracker']=="true"); # default
if(array_key_exists("publishToBlog",$_GET)) $publishToBlog=strtolower($_GET["publishToBlog"])=="true";

// misc
$accountType=$_GET['accountType'];
$date_month=$_GET['date_month'];

# filename to write to when a month is notified in getDebitInterest
# No need to do this:   sudo chown www-data:www-data /path/to/file
# because the file is only updated when the script is run from the command-line
$emailedMonthsFn = "/tmp/databases-api-getDebitInterest-sent.txt";
if(!is_writable(dirname($emailedMonthsFn)) && $_GET['format']=="emailIfAny") throw new \Exception("Failed to save to cache '".$emailedMonthsFn."' which months have been emailed about");

// check if no need to do anything 
if($_GET['format']=="emailIfAny" && file_exists($emailedMonthsFn)) {
  // only do this check when run from command-line
  $vvv=explode("\n",file_get_contents($emailedMonthsFn));
  if(in_array($date_month.",".$accountType.",".$base,$vvv)) {
    #echo "Email already sent for {$date_month}, {$accountType}, {$base}. Not calculating nor emailing.\n";
    if($_GET['notifyTracker']) { contactTracker("getDebitInterest.php"); }
    return;
  }
}

$mfcl = new \MfBfDriver\Common\MarketflowClient($base,$location,false);
$bfcl = new \MfBfDriver\Common\BankflowClient($base,$location,"FFA Private Bank");
$mfwr = new \MfBfDriver\Marketflow\DebitInterests($mfcl);
$bfwr = new \MfBfDriver\Bankflow\DebitInterests($bfcl);

$dif = new \FfaPhp\Common\DebitInterestsFactory($accountType,$date_month,$mfwr,$bfwr);
$di = $dif->shortcut();

# aggregate
switch($_GET['format']) {
  case "html":
    echo $di->toHtml();
    break;
  case "json":
    echo json_encode($di->interest);
    break;
  case "emailIfAny":
    if(count($di->interest)==0) {
      echo "No data for {$date_month}\n";
      return;
    }

    if($publishToBlog) $di->publish();

    $emailTo = ["s.akiki@ffaprivatebank.com","shadi@akikieng.com"];
    $emailer = new \FfaPhp\Common\Emailer($di, $emailTo);
    $emailer->send();

    # write in file that we've emailed out this month (so as not to re-email next day)
    file_put_contents( $emailedMonthsFn, $date_month.",".$accountType.",".$base."\n",  FILE_APPEND );

    # output to screen for info
    echo "Email sent for {$date_month}, {$accountType}, {$base}\n";

    break;
  default: throw new Exception("Unsupported format {$_GET['format']}. Please use: html");
}

if($_GET['notifyTracker']) { contactTracker("getDebitInterest.php"); }

