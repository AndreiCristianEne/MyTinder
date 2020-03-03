<?php

$id = $_POST['id'];
$sFirstName = $_POST['txtFirstName'];
$sLastName = $_POST['txtLastName'];
$sGender = $_POST['txtGender'];
$iAge = $_POST['txtAge'];
$sCity = $_POST['txtCity'];
$sEmail = $_POST['txtEmail'];
$sPassword = $_POST['txtPassword'];
$sDescription = $_POST['txtDescription'];
$sUsability = $_POST['txtUsability'];
$aImage = $_FILES['fileToUpload'];

// get the values from the users "database" 
$sajUsers = file_get_contents('users.txt');
$ajUsers = json_decode($sajUsers);

foreach($ajUsers as $jUser) {
   if ($jUser->id == $id) {
       $jUser->firstName = $sFirstName;
       $jUser->lastName = $sLastName;
       $jUser->gender = $sGender;
       $jUser->city = $sCity;
       $jUser->age = $iAge;
       $jUser->email = $sEmail;
       $jUser->password = $sPassword;
       $jUser->description = $sDescription;
       $jUser->usability = $sUsability;
       $sOldPath = $aImage['tmp_name'];
       // Create an id that will be unique for the file that we will save for the specific user
       $sUniqueImageName = $id;
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
       file_put_contents( 'users.txt', json_encode($ajUsers) );
       header('Location: admin.php');
       break;
       }
}    