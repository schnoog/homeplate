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



$qry = 'Select * from homehost ORDER BY INET_ATON(host_ipv4)';

$qry ="Select homehost.*, GRP.id AS GRPID, GRP.hostgroup from homehost INNER JOIN hostgroup AS GRP ON homehost.hostgroup = GRP.id ORDER BY INET_ATON(host_ipv4); ";

$res = DB::query($qry);
foreach($res as $entry){
    $hid = $entry['id'];
    $CFG['data']['localhosts'][$hid] = $entry;
}



//echo "<pre>" . print_r($res,true)."</pre>";

$CFG['data']['hostlist'] = $res;

$CFG['hostlist']['edit'] = false;
GetSets();


if(isset($_REQUEST['edit'])){
    if(isset($_REQUEST['id'])){
        $host = $CFG['data']['localhosts'][$_REQUEST['id']];
        //print_r($host);
        $CFG['hostlist']['edit'] = true;
        $smarty->assign('ehost',$host);
        $smarty->assign('targetapi','apilh.php');
    }
}


if(isset($_POST['save'])){
    $dumpdata = $_POST;
    saveLocalHost($_POST);
    $refData = true;
}

if($refData){
    $qry ="Select homehost.*, GRP.id AS GRPID, GRP.hostgroup from homehost INNER JOIN hostgroup AS GRP ON homehost.hostgroup = GRP.id ORDER BY INET_ATON(host_ipv4); ";

    $res = DB::query($qry);
    foreach($res as $entry){
        $hid = $entry['id'];
        $CFG['data']['localhosts'][$hid] = $entry;
    }
    GetSets();
    $CFG['data']['hostlist'] = $res;
}




$template = "localnet.tpl";






$dump = print_r($_SERVER,true);
$filepath = $CFG['dir']['incdir'] . $file;
$smarty->assign('dump',$dump);
$smarty->assign('SET',$CFG['set']);
$smarty->assign('CFG',$CFG);
$smarty->display($template);


