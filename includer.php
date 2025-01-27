<?php


require_once(__DIR__ ."/config.php");
require_once(__DIR__ ."/vendor/autoload.php");


$CFG['dir']['basedir'] = __DIR__ ;
$CFG['dir']['incdir'] = $CFG['dir']['basedir'] . "/inc/";
$CFG['dir']['smarty']['base'] = $CFG['dir']['incdir']  . "smarty/";
$CFG['dir']['smarty']['cache'] = $CFG['dir']['smarty']['base'] . "cache/";

$CFG['dir']['smarty']['config'] = $CFG['dir']['smarty']['base'] . "config/";
$CFG['dir']['smarty']['templates'] = $CFG['dir']['smarty']['base'] . "templates/";
$CFG['dir']['smarty']['templates_compile'] = $CFG['dir']['smarty']['base'] . "templates_c/";
$CFG['session']['loggedin'] = false;
$CFG['data']['tags'] = [];
$CFG['data']['nodes'] = [];
$CFG['data']['nodetags'] = [];
$CFG['data']['hosts'] = [];
$CFG['data']['hostgroups'] = [];

use Smarty\Smarty;

$smarty = new Smarty();

//require_once($CFG['dir']['incdir']  . "db_func.php");

//require_once($CFG['dir']['incdir']  . "node_func.php");

$files = scandir($CFG['dir']['incdir'] );

// Loop through each file in the directory
foreach ($files as $file) {
    // Get the full path of the file
    $filepath = $CFG['dir']['incdir'] . $file;
    //echo "Going to include $filepath </hr>";
    // Check if the file is a PHP file and is readable
    if (is_file($filepath) && pathinfo($filepath, PATHINFO_EXTENSION) === 'php') {
        require_once $filepath;
    }
}


$smarty->setCaching(Smarty::CACHING_OFF);

$smarty->setTemplateDir($CFG['dir']['smarty']['templates']);
$smarty->setCompileDir($CFG['dir']['smarty']['templates_compile']);
$smarty->setCacheDir($CFG['dir']['smarty']['cache']);
$smarty->setConfigDir($CFG['dir']['smarty']['config']);

