<?php


//echo dirname(__DIR__) . "<hr>";


require_once( dirname(__DIR__)."/includer.php");

$serial = $_SERVER['SSL_CLIENT_M_SERIAL'];

if (!in_array($serial,$CFG['certs']['allowedSerials'])){

    die ("Seems like you are not allowed to see anything here");
    

}
$CFG['session']['loggedin'] = true;
//echo "<pre>" . print_r($_SERVER,true) . "</pre>";
//echo phpinfo();
header('Location: https://homeplate.schnoogcontrol.de/');
exit;

?>
