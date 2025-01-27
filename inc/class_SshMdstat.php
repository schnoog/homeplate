<?php

use Spatie\Ssh\Ssh;



class SSHMdadmTest extends SSHTest {
    public $hosts = array();

    
    public function AddHost(MHost $host,$parameter=""){
        //$IPAdress,$Username,$authkey,$port=22
        if(strlen( $host->ipv4 ) > 0 ){
            $IPAdress =  $host->ipv4;
        }else{
            $IPAdress = $host->ipv6;
        }

        $this->hosts[$IPAdress] = [
            'username' => $host->ssh_username,
            'authkey' => $host->ssh_authkey,
            'port' => $host->ssh_port,
            'label' => $host->label,
            'command' => "cat /proc/mdstat | grep '[UU]' | wc -l | grep ".$parameter." > /dev/null && echo 1 || echo 0",
            'status' => 0
        ];
    }


    public function EvaluateTest(){
        unset($this->resultSet);
        foreach ($this->hosts as $ip => &$data) {     
            if( $data['output'] == "0"  ){
                $this->hosts[$ip]['status'] = false;
            }else{
                $this->hosts[$ip]['status'] = true;
            }
            if(strlen($data['output'])< 1) $this->hosts[$ip]['status'] = false;
            $this->resultSet[ $this->hosts[$ip]['label']] = $this->hosts[$ip]['status'];     
     
        }
    }    
    



}