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

error_reporting(E_ALL);


//$dump = GetFullHostDataset();
session_start();
//sort hosts for display acc, to the IPv4 address

$tmp = NewIcons();
echo phpinfo();
print_r($tmp);

/*
//$dump = $CFG['data'];
//$dump = [];
//$smarty->assign('data',$data);
$smarty->assign('dump', '<pre>' . print_r([$dump],true)."</pre>");
$smarty->assign('CFG',$CFG);
$smarty->assign('name', 'Ned');
//$sm
*/

