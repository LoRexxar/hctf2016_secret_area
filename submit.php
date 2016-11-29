<?php
require('class/class.php');

if(!isset($_SESSION['user'])){
	header('location:static/redirect.php?u=/index.php');
	exit;
}

if(empty($_POST['to']) && empty($_POST['message'])){
	header('location:static/redirect.php?u=/user.php');
	exit;
}

$user = filter(trim($_POST['to']));
$message = filter(trim($_POST['message']));

$query = "insert into m (user,message) values ('".$user."' , '".$message."')";
$result=$db->query($query);

$db->close();

function GetIP(){
	 if(!empty($_SERVER["HTTP_CLIENT_IP"])){
			$cip = $_SERVER["HTTP_CLIENT_IP"];
		}
		elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
			$cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		}
		elseif(!empty($_SERVER["REMOTE_ADDR"])){
			$cip = $_SERVER["REMOTE_ADDR"];
		}
		else{
			$cip = "NULL";
		}
		 return $cip;
	}

$file  = 'it51zlog.log';
$content = sprintf("ip: %s , from: %s , to: %s , message: %s \r\n", GetIP(), $_SESSION['user'], $user, $message);
$f  = file_put_contents($file, $content,FILE_APPEND);

header('location:static/redirect.php?u=/user.php');
exit;
?>
