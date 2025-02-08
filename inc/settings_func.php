<?php


function GetSets(){
    global $CFG;
    $Groups = DB::query('Select * from fullgroup ORDER by id ASC');
    $LGroups = DB::query('Select * from hostgroup ORDER by id ASC');    
    $Tags = DB::query("Select * from tag ORDER by id ASC");
    $Icons = DB::query("Select * from icon ORDER by id ASC ");

    $CFG['set']= [
        'groups' => $Groups,
        'tags' => $Tags,
        'icons' => $Icons,
        

    ];

    for($x=0;$x < count($Groups);$x++){
        $CFG['set']['groupsbyid'][$Groups[$x]['id'] ] = $Groups[$x]['hostgroup'];
    }

    for($x=0;$x < count($LGroups);$x++){
        $CFG['set']['lgroupsbyid'][$LGroups[$x]['id'] ] = $Groups[$x]['hostgroup'];
    }

    for($x=0;$x < count($Tags);$x++){
        $CFG['set']['tagsbyid'][$Tags[$x]['id'] ] = $Tags[$x]['tag'];
    }

    for($x=0;$x < count($Icons);$x++){
        $CFG['set']['iconsbyid'][$Icons[$x]['id'] ] = $Icons[$x]['icon'];
    }

    for($x=0;$x < count($Icons);$x++){
        $CFG['set']['iconsImagebyid'][$Icons[$x]['id'] ] = '<img src="assets/img/icons/' .  $Icons[$x]['icon'] .'" height="60px" style="margin-right: 10px;">';
    }


    $CFG['set']['unused']['groups'] = DB::queryFirstColumn('SELECT t1.id from fullgroup t1 left join fullhost t2 on t1.id = t2.hostgroup WHERE t2.hostgroup IS NULL');
    $CFG['set']['unused']['tags'] = DB::queryFirstColumn('SELECT t1.id from tag t1 left join  fullhosttag  t2 on t1.id = t2.tagid WHERE t2.tagid IS NULL');
    $CFG['set']['unused']['icons'] = DB::queryFirstColumn('SELECT t1.id from icon t1 left join fullhost t2 on t1.id = t2.host_icon WHERE t2.host_icon IS NULL');
    $CFG['set']['options']['yesno'] = [
        0 => "No",
        1 => "Yes"
    ];
    $CFG['set']['options']['activeinactive'] = [
        0 => "Inactive",
        1 => "Active"
    ];




}



function IconPool(){
    global $CFG;
    $idir = $CFG['dir']['basedir'] . "/assets/img/icons/";
    $files = scandir($idir);

    $pics= [];
    // Loop through each file in the directory
    foreach ($files as $file) {
        $filepath = $idir . $file;
        // Get the full path of the file
        //echo "Going to include $filepath </hr>";
        // Check if the file is a PHP file and is readable
        if (is_file($filepath) && pathinfo($filepath, PATHINFO_EXTENSION) === 'png') {
            $pics[] = $file;
        }
    }
    $CFG['set']['imageset'] = $pics;
return $pics;

}


function NewIcons(){
    global $CFG;
    $res = DB::queryFirstColumn('select icon from icon;');
    $pool = IconPool();
    $tmp = array_diff($pool,$res);
    $CFG['set']['newimages'] = $tmp;

    return $tmp;



}



?>