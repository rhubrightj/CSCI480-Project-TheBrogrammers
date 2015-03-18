<?php
session_start();
//error_reporting(0);
require 'functions/general.php';
require 'functions/users.php';

$errors = array();
if (empty($_POST) == false) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if (empty($username) === true || empty($password) === true){
		$errors[] = 'You need to enter a username and password';
	} 
	
	mysql_connect('localhost', 'root', '') or die('could not connect');
    mysql_select_db('qrusers') or die('could not find db');
	$username = sanitize($username);
	$query = mysql_query("SELECT * FROM users WHERE username = '$username'");
	$numrows = mysql_num_rows($query);
	echo $numrows;
	
	
	if (userExists($username) == false) {
		$errors[] = 'We can\'t find that username.  Please retype.';
	}
	else {
		//log the user in
		$login = login($username, $password);
		if ($login == false){
			$errors[] = 'That username/password combination is incorrect.';
		}
		else {
			echo 'ok';
			//set the user session
			$_SESSION['username'] = $username;
			//redirect to dashboard
			header('Location: ./dashboard.php');
		}
	}
	print_r($errors);
}
?>