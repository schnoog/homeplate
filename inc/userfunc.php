<?php


function LoginUserByName($username,$password){
    $UR = DB::queryFirstRow("Select * from accounts WHERE username LIKE %s",$username);
    if(!$UR) return false;
    //password
    if( password_verify($password,$UR['password'])  ){
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $UR['username'];
		$_SESSION['id'] = $UR['id'];
        setcookie("remember_me", GetUserSpecKey($username), time() + 360000, "/", "", true, true); 
        return true;
    }
    return false;
}


function GetUserSpecKey($username){
    $UR = DB::queryFirstRow("Select * from accounts WHERE username LIKE %s",$username);
    if(!$UR) return false;
    $tmp = $UR['username'] . $UR['password'] . "key";
    return $username . "-". md5($tmp);
}