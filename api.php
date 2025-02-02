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
$seccode = $_POST['seccode'];

if($SECCODE != $seccode) die ("Sorry, security codes don't match");


$template = "set.tpl";
$sectiononly = false;
if(isset($_POST['section'])) {
    $sectiononly = true;
    if($_POST['section'] == "icons") $template = "z_icontable.tpl";

    if($_POST['section'] == "tags") $template = "z_tagtable.tpl";

    if($_POST['section'] == "groups") $template = "z_tagtable.tpl";
}







$dump = print_r($POST,true);
$filepath = $CFG['dir']['incdir'] . $file;
$smarty->assign('sectiononly',$sectiononly);
$smarty->assign('seccode',$SECCODE);
$smarty->assign('dump',$dump);
$smarty->assign('SET',$CFG['set']);
$smarty->assign('CFG',$CFG);
$smarty->assign('name', 'Ned');
$smarty->display($template);

