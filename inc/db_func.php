<?php
//$CFG['data']['hosts'] = [];
//$CFG['data']['hostgroups'] = [];


function GetHostgroups(){
    global $CFG;
    $tmp = DB::query("Select * from hostgroup");
    for($x=0; $x < count($tmp);$x++){

        $CFG['data']['hostgroups'][ $tmp[$x]['id'] ] = $tmp[$x]['hostgroup'];
    }
}

function GetHosts(){
    global $CFG;
    GetHostgroups();
    $tmp = DB::query("Select * from homehost");
    for($x=0;$x < count($tmp);$x++){
        $rec = $tmp[$x];    
        $CFG['data']['hosts'][$rec['id']] = [
            'host_name' => $rec['host_name'],
            'hostgroup' => $CFG['data']['hostgroups'][  $rec['hostgroup']],
            'localonly' => $rec['localonly'],
            'usedns' => $rec['usedns'],
            'host_ipv4' => $rec['host_ipv4'],
            'host_ipv6' => $rec['host_ipv6'],
            'host_hostname' => $rec['host_hostname'],
            'host_active' => $rec['host_active'],
            'host_state' => $rec['host_state'],
            'host_laststatechange' => $rec['host_laststatechange'],

        ];
    

    }
}



function GetTags($forcerefresh  = false){
    global $CFG;
    if(( count($CFG['data']['tags']) < 1 ) || ($forcerefresh)){
        $tmp = DB::query("Select * from tag");
        for($x=0; $x < count($tmp);$x++){
            $CFG['data']['tags'][ $tmp[$x]['id'] ] = $tmp[$x]['tag'];
        }
    }
}


function GetNodeTags($forcerefresh = false){
    global $CFG;
    GetTags();
    //$CFG['data']['nodetags']
    if(( count($CFG['data']['nodetags']) < 1 ) || ($forcerefresh)){
        $tmp = DB::query("Select * from nodetag");
        for($x=0;$x < count($tmp);$x++){
            $rec = $tmp[$x];
            $node_id = $rec['node_id'];
            $tag_id = $rec['tag_id'];
            $CFG['data']['nodetags'][$node_id][] = $CFG['data']['tags'][$tag_id];
        }        
    }
}


function GetNodes(){
    global $CFG;
    GetNodeTags();
//    $CFG['data']['nodes']
    $tmp = DB::query("Select * from node");
    for($x=0;$x < count($tmp);$x++){
        $rec = $tmp[$x];
        $CFG['data']['nodes'][$rec['id']] = [
                'name' => $rec['node_name'],
                'url' => $rec['node_url'],
                'private' => $rec['node_private'],
                'label' => $rec['node_label'],
                'activitycheck' => $rec['node_activitycheck'],
                'status' => $rec['node_status'],
                'info' => $rec['node_info'],
                

            ];
            if(isset($CFG['data']['nodetags'][$rec['id']])){
                $CFG['data']['nodes'][$rec['id']]['tag'] = $CFG['data']['nodetags'][$rec['id']];

            }

    }



}



function GetIconSet(){
    global $CFG;
    $data = [];
    $res = DB::query("Select * from icon");
    for($x=0;$x < count($res);$x++){
        $line  = $res[$x];
        $data[$line['id']] =  $line['icon'];
    }

    $CFG['basedata']['iconset'] = $data;
    return $data;
}