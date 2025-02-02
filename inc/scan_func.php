<?php



function GetScanHosts(){
    global $HST;
    $HST=[];
    $qry = 'Select * from homehost ORDER BY INET_ATON(host_ipv4)';
    $all = DB::query($qry);

    for($x=0;$x < count($all);$x++){
        $rec = $all[$x];

        $tmp = new MHost();
        $tmp->label = $rec['host_name'];
        if($rec['host_hostname'])$tmp->hostname = $rec['host_hostname'];
        if($rec['host_ipv4'])$tmp->ipv4 = $rec['host_ipv4'];
        if($rec['host_ipv6'])$tmp->ipv6 = $rec['host_ipv6'];
        $tmp->host_active = $rec['host_active'];
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
        DB::query("Update homehost SET host_state = 0 WHERE id IN %li",$newOff);
    }
}


function PingTestPerform($dbupdate = true){
    global $SCN , $HST;
    //if(count($HST) < 1) GetScanHosts();
    $SCN['ping'] = new PingTest();
    foreach ($HST as $pinghost){
        $SCN['ping']->AddHost($pinghost);
    }
    $SCN['ping']->RunTest();    
    $results = $SCN['ping']->GetResult();
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
    if($dbupdate)    UpdateNewStates($newOn,$newOff);
}
