<?php

$CFG['dir']['basedir'] = dirname(__DIR__) ;
require_once ( dirname(__DIR__)  ."/includer.php");

$HST = [];

$SCN = [];


//print_r($CFG);
//GetScanHosts();

//print_r($HST);
PingTestPerform();


print_r($HST);



function GetScanHosts(){
    global $HST;
    $qry = 'Select * from homehost ORDER BY INET_ATON(host_ipv4)';
    $all = DB::query($qry);

    for($x=0;$x < count($all);$x++){
        $rec = $all[$x];

        $tmp = new MHost();
        $tmp->label = $rec['host_name'];
        $tmp->hostname = $rec['host_hostname'];
        $tmp->ipv4 = $rec['host_ipv4'];
        $tmp->ipv6 = $rec['host_ipv4'];
        $tmp->id = $rec['id'];        
        $hs = false;
        if($rec['host_state'] == 1) $hs = true;
        $tmp->host_state = $hs;
        $HST[$rec['host_name']] = $tmp;
        unset ($tmp);
    }
}

function UpdateNewStates($newOn,$newOff){
    if(count($newOn)>0){
        DB::query("Update homehost SET host_state = 1 WHERE id IN %li",$newOn);
    }

    if(count($newOff)>0){
        DB::query("Update homehost SET host_state = 1 WHERE id IN %li",$newOff);
    }


}


function PingTestPerform(){
    global $SCN , $HST;
    if(count($HST) < 1) GetScanHosts();
    $SCN['ping'] = new PingTest();
    foreach ($HST as $pinghost){
        $SCN['ping']->AddHost($pinghost);
    }
    $SCN['ping']->RunTest();    
    $results = $SCN['ping']->GetResult();

//    print_r($results);

    $newOn = [];
    $newOff = [];
    foreach ($HST as $pinghost){
        $lbl = $pinghost->label;
        $res = $results[$lbl];
        $HST[$lbl]->info = "";

        if($HST[$lbl]->host_state != $res){
            $HST[$lbl]->info = "Updated";
            $HST[$lbl]->host_state = $res;
            if($res){
                $newOn[] = $HST[$lbl]->id;
            }else{
                $newOff[] = $HST[$lbl]->id;
            }
    
        }
    }
    UpdateNewStates($newOn,$newOff);



}



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