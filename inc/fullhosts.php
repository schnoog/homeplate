<?php




function GetFullHostDataset(){
    global $CFG;
    $data = [];
    $data['taglist'] = [];
    $data['grouplist'] = [];

    $alltags = DB::query('SELECT * FROM fullhosttag INNER JOIN tag ON fullhosttag.tagid = tag.id');
    for($x = 0; $x < count($alltags); $x++){
        $fullhostid = $alltags[$x]['fullhostid'];
        $tag= $alltags[$x]['tag'];
        $data['hosttag'][$fullhostid][] = $tag;
        if(!in_array($tag,$data['taglist'])) $data['taglist'][] = $tag;


    }



    $allhosts = DB::query("Select fullhost.*, GRP.id AS GRPID, GRP.hostgroup  from fullhost INNER JOIN fullgroup AS GRP ON fullhost.hostgroup = GRP.id; ");
    for($x=0;$x < count($allhosts);$x++){
        $hostid = $allhosts[$x]['id'];
        $hgroup = $allhosts[$x]['hostgroup'];
        if(!in_array($hgroup,$data['grouplist'] ))$data['grouplist'][$allhosts[$x]['GRPID']] = $hgroup;

        $data['fullhosts'][$hostid] = $allhosts[$x];
        $data['fullhosts'][$hostid]['tag'] = $data['hosttag'][$hostid];
        $data['fullhosts'][$hostid]['tags'] =  implode("|",$data['hosttag'][$hostid]);
        foreach($data['hosttag'][$hostid] as $htag){


            $data['taghosts'][$htag][] =  $allhosts[$x];
            $data['grouphosts'][$hgroup][] = $allhosts[$x];

        }




    }
    $CFG['fullhostdata'] = $data;

   // print_r($allhosts);
    return [$data,$allhosts];







}



