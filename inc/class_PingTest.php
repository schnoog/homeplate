<?php




class PingTest extends MTest {

    public $timeout = 4.51;
    public  $ips = array();
    public $spool = array();

    public $assoclist = array();



    public function AddHost(MHost $host , $ipv4 = true ){

        //        $this->assoclist[$IPAdress] = $host->label;
        if(!$ipv4){
            $this->spool[$host->ipv6] = false;
            $this->assoclist[$host->ipv6] = $host->label;

        }else{
            if(strlen($host->ipv4)> 7){
                $this->spool[$host->ipv4] = false;
                $this->assoclist[$host->ipv4] = $host->label;
            }else{
                $this->spool[$host->ipv6] = false;
                $this->assoclist[$host->ipv6] = $host->label;
            }
        }
    }

    public function RunTest(){

        unset($this->resultSet );


        $processes = []; // To store processes for each IP
        
        // Launch a ping process for each IP address
        foreach ($this->spool as $ip => &$status) {
            $descriptorspec = [
                1 => ['pipe', 'w'], // stdout
                2 => ['pipe', 'w'], // stderr
            ];

            if (Helper::isValidIPv6($ip)){
                $command = "ping6 -c 1 -W ". $this->timeout ." $ip"; // Ping command
            }else{
                $command = "ping -c 1 -W ". $this->timeout ." $ip"; // Ping command
            }



            $process = proc_open($command, $descriptorspec, $pipes);
            
            if (is_resource($process)) {
                $processes[$ip] = ['process' => $process, 'pipes' => $pipes];
            }
        }
        
        // Collect results
        foreach ($processes as $ip => $process) {
            $pipes = $process['pipes'];
            $processHandle = $process['process'];
        
            // Read stdout and close pipes
            $output = stream_get_contents($pipes[1]);
            fclose($pipes[1]);
            fclose($pipes[2]);
            
            // Check if the ping was successful
            $res = false;

            if (strpos($output, '1 packets transmitted, 1 received') !== false) {
                $this->spool[$ip] = true;
                $res = true;
            }
            $this->resultSet[  $this->assoclist[$ip]   ] = $res;
            // Close the process
            proc_close($processHandle);
        }
        

    }






}