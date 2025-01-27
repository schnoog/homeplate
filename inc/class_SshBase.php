<?php

use Spatie\Ssh\Ssh;

abstract class SSHTest extends MTest {

    public $hosts = array();
    public int $sshport = 22;
    
 
    abstract public function AddHost(MHost $host,$parameter=null);


    public function RunTest(){
        $this->running = true;
        $this->done = false;
        $this->ExecuteTest();
        $this->EvaluateTest();
        $this->running = false;
        $this->done = true;
    }




    public function ExecuteTest(){


        // Launch a ping process for each IP address
        foreach ($this->hosts as $ip => &$data) {
            $descriptorspec = [
                1 => ['pipe', 'w'], // stdout
                2 => ['pipe', 'w'], // stderr
            ];

            $bcmd = "echo '" . base64_encode($data['command']) . "' | base64 -d | bash -";


            $command = "ssh -i " . $data['authkey'] ." " . $data['username'] . "@" . $ip . " -p"  . $data['port'] . " -t " . '"' . $bcmd.'"';
           // echo PHP_EOL . $command . PHP_EOL;  
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
            $this->hosts[$ip]['output']  = trim($output);
        
            // Close the process
            proc_close($processHandle);
        }
        


    }


    abstract public function EvaluateTest();





}