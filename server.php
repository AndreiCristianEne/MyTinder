<?php

ini_set( 'display_errors' , 0 );

$idGet = $_GET['id'];
$idUser = $_POST['idUser'];
$idOption = $_POST['idOption'];
$option = $_POST['option'];

$sajUsers = file_get_contents('users.txt');
$ajUsers = json_decode( $sajUsers );

if ( !empty($idGet) ) {
    $jMyUser;
    // save the user in an object
    foreach ($ajUsers as $jUser) {
        if ($jUser->id == $idGet) {
            $jMyUser = $jUser;
        }
    }
    //echo json_encode($jMyUser);

    $ajOtherUsers = [];
    foreach ($ajUsers as $jUser) {
        if ($jUser->id != $idGet && !in_array($jUser->id, $jMyUser->likedByThem) && !in_array($jUser->id, $jMyUser->dislikedByThem)) {
            array_push($ajOtherUsers, $jUser);
        }
    }
    echo json_encode($ajOtherUsers);
}

if ( !empty($idUser) && !empty($idOption) && !empty($option) ) {
    foreach ( $ajUsers as $jUser ) {
        if ( $idUser == $jUser->id) {
            if ($option == "like") {
               array_push($jUser->likedByThem, $idOption);
               foreach ($ajUsers as $jUser2) {
                 if ($jUser2->id == $idOption) {
                    array_push($jUser2->likedBy, $idUser);
                 }   
               }

            } else if ($option == "nope") {
               array_push($jUser->dislikedByThem, $idOption);
            }
        }
        file_put_contents('users.txt', json_encode($ajUsers));
    }
}