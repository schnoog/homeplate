<?php


require_once(__DIR__ ."/config.php");
require_once(__DIR__ ."/vendor/autoload.php");

use Smarty\Smarty;

$smarty = new Smarty();

$smarty->setCaching(Smarty::CACHING_OFF);

$smarty->setTemplateDir($CFG['dir']['smarty']['templates']);
$smarty->setCompileDir($CFG['dir']['smarty']['templates_compile']);
$smarty->setCacheDir($CFG['dir']['smarty']['cache']);
$smarty->setConfigDir($CFG['dir']['smarty']['config']);

