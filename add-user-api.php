<?php

// save the properties passed
$id = uniqid();
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

if (empty($sFirstName) || empty($sLastName) || empty($sGender) || empty($sUsability)
 || empty($iAge) ||
 empty($sCity) || empty($sEmail) || empty($sPassword) || empty($sDescription)
) {
    header('Location: add-user.php');
    exit;
}

//backend validation
//defensive coding, assume the user is messing up on purpose
if( !filter_var($sEmail, FILTER_VALIDATE_EMAIL) || !filter_var($iAge, FILTER_VALIDATE_INT) || $iAge < 18) {
  header('Location: add-user.php');
  exit;
}

// get the values from the users "database" 
$sajUsers = file_get_contents('users.txt');
$ajUsers = json_decode($sajUsers);

// create the object with the properties from above if they are valid
$sjUser = '{}';
$jUser = json_decode( $sjUser );
$jUser->id = $id;
$jUser->firstName = $sFirstName;
$jUser->lastName = $sLastName;
$jUser->gender = $sGender;
$jUser->age = $iAge;
$jUser->city = $sCity;
$jUser->email = $sEmail;
$jUser->password = $sPassword;
$jUser->description = $sDescription;
$jUser->usability = $sUsability;
$jUser->likedByThem = array();
$jUser->dislikedByThem = array();
$jUser->likedBy = array();
$jUser->verified = 1;
// hardcode the location only if admin adds user, did not manage to work it out in this case. 
// it works fine if the user creates the account himself
$jUser->locationLat = "55.6541109";
$jUser->locationLong = "12.3494143";

// push the new user into the array from the file
// then save the new array into the file
array_push( $ajUsers, $jUser );
file_put_contents( 'users.txt', json_encode($ajUsers) );

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
header('Location: admin.php');