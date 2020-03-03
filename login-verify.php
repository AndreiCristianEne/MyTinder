<?php

// top
require_once 'components/top.php';
  
// bottom
require_once 'components/bottom.php';

// check that values are passed
if (!isset($_POST['txtEmail']) || !isset($_POST['txtPassword'])) {
    header('Location: login.php');
    exit;
}

session_start(); 

// what we get from the login
$sEmail = $_POST['txtEmail'];
$sPassword = $_POST['txtPassword'];
$aImage = $_FILES['fileToUpload'];

// get the values from the users "database" 
$sajUsers = file_get_contents('users.txt');
$ajUsers = json_decode($sajUsers);

foreach($ajUsers as $jUser) {
   // check 
  if ($jUser->email == $sEmail && $jUser->password == $sPassword) {
        $_SESSION['id'] = $jUser->id;
        $sOldPath = $aImage['tmp_name'];
        // Create an id that will be unique for the file that we will save for the specific user
        $sUniqueImageName = $jUser->id;
        // Extract the extension of the image
        $sImageName = $aImage['name'];
        $aImageName = explode( '.' , $sImageName ); // andrei.png ['andrei','png']
        // get extension knowing that the last element is the extension
        $sExtension = $aImageName[count($aImageName)-1];
        // Create a variable with the new path
        $sPathToSaveFile = "assets/user-imgs/$sUniqueImageName.$sExtension";
        // save the image to the folder
        if( move_uploaded_file( $sOldPath , $sPathToSaveFile ) ){
            echo "SUCCESS";
        }else{
            echo "ERROR";
        }
        header('Location: user.php');
        exit;     
  } else {
      header('Location: login.php');
  }

}