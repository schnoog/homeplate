<?php



function DeleteFullhost($id){
    DB::query("Delete from fullhost WHERE id = %i",$id);
}





function saveHost($data){
    $host = [];
    $tags = [];
    if(strlen($data['id']) > 0) $host['id'] = $data['id'];

    $host['host_name'] = $data['host_name'];
    $host['hostgroup'] = $data['GRPID'];
    $host['localonly'] = $data['localonly'];
    $host['usedns'] = $data['usedns'];
    $host['host_checkurl'] = $data['host_checkurl'];
    $host['host_state'] = $data['host_state'];
    $host['host_icon'] = $data['host_icon'];
    $host['hostgroup'] = $data['GRPID'];
    $host['hostgroup'] = $data['GRPID'];

    if(strlen($data['host_ipv4']) > 0) $host['host_ipv4'] = $data['host_ipv4'];
    if(strlen($data['host_ipv6']) > 0) $host['host_ipv6'] = $data['host_ipv6'];
    if(strlen($data['host_hostname']) > 0) $host['host_hostname'] = $data['host_hostname'];
    if(strlen($data['host_url']) > 0) $host['host_url'] = $data['host_url'];
    

    
    DB::insertUpdate("fullhost",$host);



    if(isset($data['tags'])){
        if(isset($host['id'])){
            $recid = $host['id'];
            DB::query("Delete from fullhosttag WHERE fullhostid = %i AND tagid NOT IN %li",$recid ,$data['tags']);
        }else{
            $recid =  DB::insertId();
        }

        $res = DB::query("Select tagid from fullhosttag WHERE fullhostid = %i",$recid );
        $new = array_diff($data['tags'],$res);
        $nr = [];

        foreach($new as $newtag){
            $nr[] = [
                'fullhostid' => $recid,
                'tagid' => $newtag

            ];


        }
        DB::insertIgnore('fullhosttag',$nr);


    }



    /*
------------------------------------------hostgroup
------------------------------------------localonly
------------------------------------------usedns
host_ipv4
host_ipv6
host_hostname
host_url
------------------------------------------host_checkurl
------------------------------------------host_state
host_laststatechange
------------------------------------------host_icon

            ------------------------------------------[save] => save
            ------------------------------------------[id] => 1
            ------------------------------------------[host_name] => Bitwarden Vaultwarden
            ------------------------------------------[hostgroup] => Homeserver
            [GRPID] => 3
            ------------------------------------------[[localonly] => 1
            ------------------------------------------[[usedns] => 0
            [host_ipv4] => 192.168.178.34
            [host_ipv6] => fd00::be24:11ff:fe32:1c3a
            [host_hostname] => myvault.schnoogcontrol.de
            [host_url] => https://myvault.schnoogcontrol.de
            ------------------------------------------[host_checkurl] => 1
            ------------------------------------------[host_state] => 0
            [host_laststatechange] => 0
            ------------------------------------------[host_icon] => 4
            [tags] => Array
                (
                    [0] => 2
                    [1] => 14
                )

    */







};









/**
 * 
 */
function GetFullHostDataset(){
    global $CFG;
    $data = [];
    $data['taglist'] = [];
    $data['grouplist'] = [];
    $tid = [];

    $alltags = DB::query('SELECT * FROM fullhosttag INNER JOIN tag ON fullhosttag.tagid = tag.id');
    for($x = 0; $x < count($alltags); $x++){
        $fullhostid = $alltags[$x]['fullhostid'];
        $tag= $alltags[$x]['tag'];
        $data['hosttag'][$fullhostid][] = $tag;
        if(!in_array($tag,$data['taglist'])) $data['taglist'][] = $tag;
        $tid[$fullhostid][] = $alltags[$x]['tagid'];

    }



    $allhosts = DB::query("Select fullhost.*, GRP.id AS GRPID, GRP.hostgroup  from fullhost INNER JOIN fullgroup AS GRP ON fullhost.hostgroup = GRP.id; ");
    for($x=0;$x < count($allhosts);$x++){
        $hostid = $allhosts[$x]['id'];
        $hgroup = $allhosts[$x]['hostgroup'];
        if(!in_array($hgroup,$data['grouplist'] ))$data['grouplist'][$allhosts[$x]['GRPID']] = $hgroup;

        $data['fullhosts'][$hostid] = $allhosts[$x];
        $data['fullhosts'][$hostid]['tag'] = $data['hosttag'][$hostid];
        $data['fullhosts'][$hostid]['tags'] =  implode("|",$data['hosttag'][$hostid]);
        $data['fullhosts'][$hostid]['tagarray'] = $tid[$hostid];
        foreach($data['hosttag'][$hostid] as $htag){


            $data['taghosts'][$htag][] =  $allhosts[$x];
            $data['grouphosts'][$hgroup][] = $allhosts[$x];

        }




    }
    $CFG['fullhostdata'] = $data;

   // print_r($allhosts);
    return [$data,$allhosts];







}



/**
 * 
 * 
 */


 function saveLocalHost($data){
    $host = [];
    $tags = [];
    
    $host['id'] = $data['id'];
    $host['host_name'] = $data['host_name'];
    $host['hostgroup'] = $data['GRPID'];
    $host['localonly'] = $data['localonly'];
    $host['usedns'] = $data['usedns'];
//    $host['host_checkurl'] = $data['host_checkurl'];
    $host['host_state'] = $data['host_state'];
    $host['host_active'] = $data['host_active'];
    $host['host_alarmdeath'] = $data['host_alarmdeath'];
    $host['hostgroup'] = $data['GRPID'];

    if(strlen($data['host_ipv4']) > 0) $host['host_ipv4'] = $data['host_ipv4'];
    if(strlen($data['host_ipv6']) > 0) $host['host_ipv6'] = $data['host_ipv6'];
    if(strlen($data['host_hostname']) > 0) $host['host_hostname'] = $data['host_hostname'];
//    if(strlen($data['host_url']) > 0) $host['host_url'] = $data['host_url'];
    

    //echo "<pre>" . print_r( [ "post" => $data , "host" => $host   ] ,true ) . "</pre>";
    
    DB::insertUpdate("homehost",$host);






    /*

    */







};