<?php 
  // start a session
  // kill a session with session_destroy
  // redirect to the login page

  session_start();
  session_destroy(); // deletes the key for the session in the serverside
  header('Location: login.php');

?>