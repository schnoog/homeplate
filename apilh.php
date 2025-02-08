<?php
/**
 * 
 * Idee: Start-Seit
 * -> HeimNetz Anzeige Status
 *      -> connect /open
 * 
 * 
 * 
 */
$CFG['dir']['basedir'] = __DIR__ ;
require_once($CFG['dir']['basedir'] ."/includer.php");



session_start();

$SECCODE = md5( $_SERVER['HTTP_USER_AGENT'] . $_SERVER['HTTP_COOKIE']);
$seccode = $_REQUEST['seccode'];

if($SECCODE != $seccode) die ("Sorry, security codes don't match");



$template = "set.tpl";
$sectiononly = false;

$action = "";
if(isset($_REQUEST['action'])){
    $action = $_REQUEST['action'];
} 
$debug="";
if(isset($_REQUEST['section'])) {
    $sectiononly = true;
    /**
     * ICONS
     */
    if($_REQUEST['section'] == "icons") {
        $template = "z_icontable.tpl";
        if(strlen($action)> 0){


            $debug = "<pre>" . print_r($_REQUEST,true) . "</pre>";
            $debug = "";
            if($action == "add"){
                $newval = $_REQUEST['newval'];
                if(strlen($newval)> 0){
                    DB::query("INSERT INTO icon (icon) VALUES (%s)",$newval);
                }

            }
            if($action == "update"){
                $id = $_REQUEST['id'];                
                $newval = $_REQUEST['newval'];
                if(strlen($newval)> 0){
                    DB::query("Update icon set icon = %s WHERE id = %i",$newval,$id);
                }


            }
            if($action == "delete"){
                $id = $_REQUEST['id'];
                DB::query("Delete from icon WHERE id = %i",$id);
            }
            if($action == "addicon"){
                $icon = $_REQUEST['icon'];
                DB::query("INSERT INTO icon (icon) VALUES (%s)",$icon);
            }



        }
    }
    /**
     * TAGS
     */
    if($_REQUEST['section'] == "tags") {
        $template = "z_tagtable.tpl";
        if(strlen($action)> 0){
            $debug = "<pre>" . print_r($_REQUEST,true) . "</pre>";
            $debug = "";
            if($action == "add"){
                $newval = $_REQUEST['newval'];
                if(strlen($newval)> 0){
                    DB::query("INSERT INTO tag (tag) VALUES (%s)",$newval);
                }
            }
            if($action == "update"){
                $id = $_REQUEST['id'];
                $newval = $_REQUEST['newval'];
                if(strlen($newval)> 0){
                    DB::query("Update tag set tag = %s WHERE id = %i",$newval,$id);                    
                }
            }
            if($action == "delete"){
                $id = $_REQUEST['id'];
                DB::query("Delete from tag WHERE id = %i",$id);
            }

        }

    }
    /**
     * GROUPS
     */
    if($_REQUEST['section'] == "groups") {
        $template = "z_grouptable.tpl";
        if(strlen($action)> 0){
            $debug = "<pre>" . print_r($_REQUEST,true) . "</pre>";
            $debug ="";
            if($action == "add"){
                $newval = $_REQUEST['newval'];
                if(strlen($newval)> 0){
                    DB::query("INSERT INTO fullgroup (hostgroup) VALUES (%s)",$newval);
                }
            }
            if($action == "update"){
                $id = $_REQUEST['id'];
                $newval = $_REQUEST['newval'];
                if(strlen($newval)> 0){
                    DB::query("Update fullgroup set hostgroup = %s WHERE id = %i",$newval,$id);
                }
            }
            if($action == "delete"){
                $id = $_REQUEST['id'];
                DB::query("Delete from fullgroup WHERE id = %i",$id);
            }

        }

    }
   // GetSets();
}

GetSets();


$smarty->assign("debugme",$debug);


$dump = print_r($POST,true);
$filepath = $CFG['dir']['incdir'] . $file;
$smarty->assign('sectiononly',$sectiononly);
$smarty->assign('seccode',$SECCODE);
$smarty->assign('dump',$dump);
$smarty->assign('SET',$CFG['set']);
$smarty->assign('CFG',$CFG);
$smarty->assign('name', 'Ned');
$smarty->display($template);

