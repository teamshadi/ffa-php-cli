<?php

# This is a utility script that adds "base" and "location" from $argc or $_GET

# defaults
$base="Lebanon";
$location="Beirut";

# If using from CLI
if(isset($argc)) parse_str(implode('&', array_slice($argv, 1)), $_GET);

if(array_key_exists("base",$_GET)) $base=$_GET["base"]; else $_GET['base']=$base;
if(array_key_exists("location",$_GET)) $location=$_GET["location"]; else $_GET['location']=$location;

