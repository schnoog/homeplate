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
        return true;
    }
    return false;
}