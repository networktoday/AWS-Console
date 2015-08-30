#!/usr/bin/php
<?php
/*
|
| ec2-power-button -- @dustyfresh
| ./ec2-power-button <start/stop> <instanceID> <region>
|
| this will toggle an instance on or off, and it's good
| for cronjerbs!
|
*/
error_reporting(0);
$cmd = $argv[1] or die("please supply a command(start/stop)...\n");
$instanceID = $argv[2] or die("please supply an instance ID\n");
$region = $argv[3] or die("Please specify a region. for example: us-east-1\n");
  
require_once "awssdkforphp/vendor/autoload.php";
use Aws\Ec2\Ec2Client;
  
$client = Ec2Client::factory(array(
 'key' => '', // your auth API key
 'secret' => '', // your secret API key
 'region' => "$region",
 ));
  
if($cmd == 'start'){
 $result = $client->startInstances(array(
 'InstanceIds' => array($instanceID,),
 'DryRun' => false,
 ));
} elseif($cmd == 'stop'){
 $result = $client->stopInstances(array(
 'InstanceIds' => array($instanceID,),
 'DryRun' => false,
 ));
}
//print_r($result); // uncomment to see results of request
print "OK\n";
?>
