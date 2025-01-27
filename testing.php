<html><?php
error_reporting(E_ALL);
$SET['dir']['basedir'] = __DIR__;
require_once( $SET['dir']['basedir'] . "/includer.php");

/*
$test = new PingTest();

$test->AddIP("192.168.178.1");
$test->AddIP("192.168.178.2");
$test->AddIP("192.168.178.3");
$test->AddIP("192.168.178.4");
$test->AddIP("192.168.178.5");
$test->AddIP('2a05:5800:20c:3900:5111:f848:3d19:d0c4');

$test->AddIP("192.168.178.27");
$test->RunTest();
print_r($test->spool);
echo PHP_EOL;
echo PHP_EOL;
*/

$h1 = new MHost();
$h1->label = "Homeserver";
$h1->hostname = "homeserver.fritz.box";
$h1->ipv4 = "192.168.178.27";
$h1->ipv6 = "fd00::aaa1:59ff:fea5:23bf";
$h1->alarming = true;
$hostlist[$h1->label] = $h1;
unset($h1);


$h1 = new MHost();
$h1->label = "Power.slcontrol.eu";
$h1->hostname = "power.slcontrol.eu";
$h1->ipv4 = "138.201.136.212";
$h1->ipv6 = "2a01:4f8:172:33e1::2";
$h1->ssh_port=22;
$h1->alarming = true;
$hostlist[$h1->label] = $h1;
unset($h1);

$test['pingtest'] = new PingTest();
$test['pingtest']->AddHost( $hostlist['Homeserver'],false );
$test['pingtest']->AddHost( $hostlist['Power.slcontrol.eu'] );
$test['pingtest']->RunTest();

$test['mdadm'] = new SSHMdadmTest();
$test['mdadm']->AddHost($hostlist['Homeserver'],1);
$test['mdadm']->AddHost($hostlist['Power.slcontrol.eu'],4);
//$test['mdadm']->RunTest();


$test['df'] = new SSHDfTest();
$test['df']->AddHost($hostlist['Homeserver'],"/",30);
$test['df']->AddHost($hostlist['Power.slcontrol.eu'],"/",20);
//$test['df']->RunTest();

Helper::debugout($test,"Tests after run");


Helper::debugout( $test['pingtest']->GetResult() , "pingtest");
//Helper::debugout( $test['mdadm']->GetResult() , "mdadm");
//Helper::debugout( $test['df']->GetResult() , "dfresults");




/*



$sshtest = new SSHMdadmTest();
$sshtest->AddHost("192.168.178.27","homemonitor","/var/www/.ssh/id_rsa",22,1);
$sshtest->AddHost("138.201.136.212","homemonitor","/var/www/.ssh/id_rsa",22,4);


$sshtest->RunTest();

print_r($sshtest->hosts);

echo PHP_EOL;
echo PHP_EOL;


$sshdf = new SSHDfTest();
$sshdf->AddHost("192.168.178.27","homemonitor","/var/www/.ssh/id_rsa",22,"/",60);
//$sshdf->AddHostTest("138.201.136.212","homemonitor","/var/www/.ssh/id_rsa",22,"/",60);
//SSHDfTest
$sshdf->RunTest();

echo PHP_EOL;
echo PHP_EOL;

print_r($sshdf);



*/

?>
</html>
