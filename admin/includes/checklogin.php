<?php
session_start();
error_reporting(1);
include('config/db.php');
function check_login()
{
	if(strlen($_SESSION['odmsaid'])==0)
	{	
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="index.php";		
		$_SESSION["id"]="";
		header("Location: http://$host$uri/$extra");
	}
}
?>