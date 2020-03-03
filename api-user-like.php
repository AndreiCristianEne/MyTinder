<?php

ini_set( 'display_errors' , 0 );

$iId = $_GET['id'];

$sajUsers = file_get_contents('users.txt');
$ajUsers = json_decode($sajUsers);

//echo json_encode($ajUsers);

if ( !empty($iId) ) {
    $ajOtherUsers = [];
    foreach ($ajUsers as $jUser) {
        if ($jUser->id != $iId) {
            array_push($ajOtherUsers, $jUser);
        }
    }
    //echo json_encode( $ajOtherUsers );
    $ajUsersLikedHim = [];
    foreach ($ajOtherUsers as $jUser) {
        if (in_array($iId, $jUser->likedByThem) && in_array($iId, $jUser->likedBy)) {
            array_push($ajUsersLikedHim, $jUser);
        }
    }
    echo json_encode( $ajUsersLikedHim );  
}