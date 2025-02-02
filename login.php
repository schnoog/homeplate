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

session_start();

if($CFG['session']['loggedin'] == true){
   // echo "<pre>" . print_r($_SERVER,true) . "</pre>";
    $smarty->assign('loggedin',$CFG['session']['loggedin'] );


}


$msg = "please enter your username / password";
if(isset($_POST['username'])){
    $un = $_POST['username'];
    if(isset($_POST['password'])){
        $pw = $_POST['password'];
        if(LoginUserByName($un,$pw)){
            $msg = "logged in";
            header('Location: /index.php');
            exit;


        }else{
            $msg ="Wrong login credentials";
        }

    }


}



$smarty->assign('msg',$msg);

$filepath = $CFG['dir']['incdir'] . $file;

$smarty->assign('now',time());
$smarty->assign('data',$data);
$smarty->assign('fullhostdata',$fullhostdata);
$smarty->assign('badgecolos',$CFG['badgecolors']);
$smarty->assign('dump', '<pre>' . print_r([$_SESSION,$CFG['basedata'],$fullhostdata,$dump],true)."</pre>");
$smarty->assign('CFG',$CFG);
$smarty->assign('name', 'Ned');
$smarty->display('login.tpl');


