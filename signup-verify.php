<?php

$sVerificationKey = $_GET['id'];
// TODO: Validate that there is a key
$sUsers = file_get_contents( 'users.txt' );
// convert the text to object
$ajUsers = json_decode( $sUsers );

foreach( $ajUsers as $jUser ) {
    // TODO: Match the key with the users random key
    // TODO: Change the user from non-verified to verified
    if( $jUser->id == $sVerificationKey ) {
      //match found
      $jUser->verified = 1;
      // save data back to file
      file_put_contents( 'users.txt', json_encode( $ajUsers ) );
      echo "You are verified, thank you!";
      header('Location: login.php');
      exit; // cuz it's unique
   } 
}