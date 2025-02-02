<?php


function GetSets(){
    global $CFG;
    $Groups = DB::query('Select * from fullgroup ORDER by id ASC');
    $Tags = DB::query("Select * from tag ORDER by id ASC");
    $Icons = DB::query("Select * from icon ORDER by id ASC ");

    $CFG['set']= [
        'groups' => $Groups,
        'tags' => $Tags,
        'icons' => $Icons,
        

    ];



}










?>