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
$serial ="x";
if (isset($_SERVER['SSL_CLIENT_M_SERIAL'])) $serial = $_SERVER['SSL_CLIENT_M_SERIAL'];
$serial ="1234";
if (!in_array($serial,$CFG['certs']['allowedSerials'])){
    $CFG['session']['loggedin'] = false;
}else{
    $CFG['session']['loggedin'] = true;
}

if(isset($_SESSION)){
    if(isset($_SESSION['loggedin'])) $CFG['session']['loggedin'] = true;

}

if($CFG['session']['loggedin'] != true){
    header('Loction: index.php');
}

if($CFG['session']['loggedin'] == true){
   // echo "<pre>" . print_r($_SERVER,true) . "</pre>";
    $smarty->assign('loggedin',$CFG['session']['loggedin'] );


}

$SECCODE = md5( $_SERVER['HTTP_USER_AGENT'] . $_SERVER['HTTP_COOKIE']);

GetSets();

$template = "set.tpl";
$sectiononly = false;
if(isset($_POST['section'])) {
    $sectiononly = true;
    if($_POST['section'] == "icons") $template = "z_icontable.tpl";

    if($_POST['section'] == "tags") $template = "z_tagtable.tpl";

    if($_POST['section'] == "groups") $template = "z_tagtable.tpl";
}







$dump = print_r($_SERVER,true);
$filepath = $CFG['dir']['incdir'] . $file;
$smarty->assign('sectiononly',$sectiononly);
$smarty->assign('seccode',$SECCODE);
$smarty->assign('dump',$dump);
$smarty->assign('SET',$CFG['set']);
$smarty->assign('CFG',$CFG);
$smarty->assign('name', 'Ned');
$smarty->display('set.tpl');


