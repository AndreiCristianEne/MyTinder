<?php

// top
require_once 'components/top.php';
  
// bottom
require_once 'components/bottom.php';

// check that values are passed
if (!isset($_POST['txtUsername']) || !isset($_POST['txtPassword'])) {
    header('Location: admin-login.php');
    exit;
}

// what we get from the login as admin
$sUsername = $_POST['txtUsername'];
$sPassword = $_POST['txtPassword'];

// get the values from the admins "database" 
$sajAdmins = file_get_contents('admins.txt');
$ajAdmins = json_decode($sajAdmins);

session_start(); 

foreach($ajAdmins as $jAdmin) {
    // check 
   if ($jAdmin->username == $sUsername && $jAdmin->password == $sPassword) {
         $_SESSION['id'] = $jAdmin->username;
         header('Location: admin.php');
         exit;     
   } else {
       header('Location: admin-login.php');
   }
 
 }