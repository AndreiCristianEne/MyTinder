<?php

$id = $_POST['id'];

session_start();

$sajUsers = file_get_contents('users.txt');
$ajUsers = json_decode($sajUsers);

if ( !empty($id) ) {
    foreach ($ajUsers as $iIndex => $jUser) {
        if ($jUser->id == $id) {
            array_splice( $ajUsers , $iIndex , 1 );
            $imagePath = "assets/user-imgs/{$id}.jpg";
            unlink($imagePath);
            file_put_contents('users.txt', json_encode($ajUsers));
            header('Location: admin.php');
            break;
        }
    }
}