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
    header('Location: index.php');
    exit;
}

if($CFG['session']['loggedin'] == true){
   // echo "<pre>" . print_r($_SERVER,true) . "</pre>";
    $smarty->assign('loggedin',$CFG['session']['loggedin'] );


}

$SECCODE = md5( $_SERVER['HTTP_USER_AGENT'] . $_SERVER['HTTP_COOKIE']);
GetHosts();
GetSets();
NewIcons();
GetIconSet();
GetFullHostDataset();


$template = "hosts.tpl";

$CFG['hostlist']['edit'] = false;

if(isset($_REQUEST['new'])){
    $CFG['hostlist']['edit'] = true;
}

if(isset($_REQUEST['edit'])){
    if(isset($_REQUEST['id'])){
        $host = $CFG['fullhostdata']['fullhosts'][$_REQUEST['id']];
        $CFG['hostlist']['edit'] = true;
    }
}

$dumpdata = [];
if(isset($_POST['save'])){
    $dumpdata = $_POST;
    saveHost($_POST);
}

if(isset($_POST['delete'])){
    $dumpdata = $_POST;
    $id = $_POST['id'];
    DeleteFullhost($id);
    GetFullHostDataset();
}



$smarty->assign('ehost',$host);
$smarty->assign('upd',true);
$smarty->assign("basedata",$CFG['basedata'] );
$dump = "<pre>" . print_r([$dumpdata],true) . "</pre>";
$filepath = $CFG['dir']['incdir'] . $file;
$smarty->assign('sectiononly',$sectiononly);
$smarty->assign('seccode',$SECCODE);
$smarty->assign('dump',$dump);
$smarty->assign('SET',$CFG['set']);
$smarty->assign('CFG',$CFG);
$smarty->assign('name', 'Ned');
$smarty->display($template);


