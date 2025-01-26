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
require_once(__DIR__ ."/includer.php");


DB::$dsn = $CFG['db']['dsn'];
DB::$user = $CFG['db']['user'];
DB::$password = $CFG['db']['password'];


$serial ="x";
if (isset($_SERVER['SSL_CLIENT_M_SERIAL'])) $serial = $_SERVER['SSL_CLIENT_M_SERIAL'];

if (!in_array($serial,$CFG['certs']['allowedSerials'])){
    $CFG['session']['loggedin'] = false;
}else{
    $CFG['session']['loggedin'] = true;
}


if($CFG['session']['loggedin'] == true){
   // echo "<pre>" . print_r($_SERVER,true) . "</pre>";
    $smarty->assign('loggedin',$CFG['session']['loggedin'] );


}


$smarty->assign('name', 'Ned');
$smarty->display('test.tpl');


