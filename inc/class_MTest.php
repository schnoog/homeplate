<?php




abstract class MTest {

    public $resultSet = array();
    public bool $running = false;
    public bool $done = false;

    public function RunTest(){
        
    }

    public function GetResult($label = ""){

        if($label == ""){
            return $this->resultSet;
        }



    }



}