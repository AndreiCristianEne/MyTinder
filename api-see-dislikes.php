<?php

ini_set( 'display_errors' , 0 );

$iId = $_GET['id'];

$sajUsers = file_get_contents('users.txt');
$ajUsers = json_decode($sajUsers);

if ( !empty($iId) ) {
    $jMyUser;
    foreach ($ajUsers as $jUser) {
        if ($jUser->id == $iId) {
            $jMyUser = $jUser;
        }
    }
    if ($jMyUser->usability == '0') {
        echo 'no';
        exit;
    }

    $ajUsersDislikedHim = [];
    foreach ($ajUsers as $jUser) {
        if (in_array($iId, $jUser->dislikedByThem)) {
            array_push($ajUsersDislikedHim, $jUser);
        }
    }
    echo json_encode( $ajUsersDislikedHim );  
}