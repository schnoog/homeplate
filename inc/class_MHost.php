<?php


class MHost {

    public string $label = "";
    public string $hostname = "";
    public string $ipv4 = "";
    public string $ipv6 = "";
    public bool $alarming = false;

    public int $id = 0;

    // SSH
    public string $ssh_username = "homemonitor";
    public string $ssh_authkey = "/var/www/.ssh/id_rsa";
    public  $ssh_port = 22;


    // STATE
    public bool $host_state;

    public string $info = "";



}

