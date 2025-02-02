<?php

$CFG['dir']['basedir'] = dirname(__DIR__) ;
require_once ( dirname(__DIR__)  ."/includer.php");

$HST = [];

$SCN = [];


//print_r($CFG);
GetScanHosts(); // Load hosts into $HST

//
PingTestPerform(true); // Ping all $HST and update DB

$out = [];

    foreach ($HST as $pinghost){
        $lbl = $pinghost->label;

        if($HST[$lbl]->info == "Updated"){
            $out[] = "$lbl :" . $HST[$lbl]->host_state;
        }
    }


if(count($out)< 1) $out = ['No change'];

print_r($out);





/*

$h1 = new MHost();
$h1->label = "Power.slcontrol.eu";
$h1->hostname = "power.slcontrol.eu";
$h1->ipv4 = "138.201.136.212";
$h1->ipv6 = "2a01:4f8:172:33e1::2";
$h1->ssh_port=22;
$h1->alarming = true;
$hostlist[$h1->label] = $h1;
unset($h1);

*/
