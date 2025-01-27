<?php


class Helper{

    public static function isValidIPv6($var) {
        return filter_var($var, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false;
    }

    public static function debugout($data,$label =""){


            if (php_sapi_name() === 'cli'){
                if(strlen($label)>0) echo $label . PHP_EOL;
                echo print_r($data,true);
            }else{
                if(strlen($label)>0) echo $label . "<br />";
                echo "<pre>" . print_r($data,true) . "</pre>";
            }




    }


}