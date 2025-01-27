<?php

use Spatie\Ssh\Ssh;



class SSHDfTest extends SSHTest {
    public $hosts = array();
    public $assoclist = array();

    
    public function AddHost(MHost $host,$parameter="/",$minfree=10){
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
            'minfree' => $minfree,
            'command' => "df -h ".$parameter." | grep '".$parameter."' | awk '{print $5}' | cut -d '%' -f 1",
            'status' => false
        ];
    }



    public function EvaluateTest(){
        unset($this->resultSet);

        foreach ($this->hosts as $ip => &$data) {     
            if( $data['output'] > (100 - $data['minfree'])){
                $this->hosts[$ip]['status'] = false;
            }else{
                $this->hosts[$ip]['status'] = true;
            }
            if(strlen($data['output'])< 1) $this->hosts[$ip]['status'] = false;
            $this->resultSet[ $this->hosts[$ip]['label']] = $this->hosts[$ip]['status'];
     
     
        }
    }    
    















    

}