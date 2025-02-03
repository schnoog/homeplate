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
//$dump=[];


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

}else{
    if (isset($_COOKIE['remember_me'])) {
        $token = $_COOKIE['remember_me'];
        list($un,$check) = $explode("-",$token);
        if(strlen($un)> 0){
            if(strlen($check)>20){
                $tmp = GetUserSpecKey($un);
                if($token == $tmp){
                    $CFG['session']['loggedin'] = true;                        
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['name'] = $un;


                }
            }
        }
    }

}

//print_r($_COOKIE['remember_me']);
//exit;


if($CFG['session']['loggedin'] == true){
   // echo "<pre>" . print_r($_SERVER,true) . "</pre>";
    $smarty->assign('loggedin',$CFG['session']['loggedin'] );


}
$SECCODE = md5( $_SERVER['HTTP_USER_AGENT'] . $_SERVER['HTTP_COOKIE']);

//GetTags();
//GetNodeTags();
//GetNodes();

/**
 * Homenet -Ping -Test
 */

//start - Load hosts from table
GetHosts();
GetIconSet();



//sort hosts for display acc, to the IPv4 address
$CFG['data']['lastscan'] = getFileAgeInSeconds("/dev/shm/lastscan");
$data = sortHostsByIPv4($CFG['data']);


//Get fullhosts
GetFullHostDataset();

$fullhostdata = $CFG['fullhostdata'];


$dump = $CFG['data'];
if(isset($token)){
    $dump = $token;
}
//$dump = [];


$filepath = $CFG['dir']['incdir'] . $file;
$smarty->assign("basedata",$CFG['basedata'] );
$smarty->assign('seccode',$SECCODE);
$smarty->assign('now',time());
$smarty->assign('data',$data);
$smarty->assign('fullhostdata',$fullhostdata);
$smarty->assign('badgecolos',$CFG['badgecolors']);
$smarty->assign('dump', '<pre>' . print_r([$fullhostdata,$dump],true)."</pre>");
$smarty->assign('CFG',$CFG);
$smarty->assign('name', 'Ned');
$smarty->display('index.tpl');


