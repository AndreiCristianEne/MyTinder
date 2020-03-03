<?php

// top
require_once 'components/top.php';
  
// bottom
require_once 'components/bottom.php';
?>

<div class="container">
    <h5>Login as admin</h5>
</div>

<div class="container">
  <form action="admin-login-verify.php" method="post">
    <div class="form-group">
      <label for="txtUsername">Username</label>
      <input name="txtUsername" type="text" class="form-control" id="txtUsername"> 
      <label for="txtPassword">Password</label>
      <input name="txtPassword" type="password" class="form-control" id="txtPassword" >
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
    <a href="login.php" class="btn btn-info" role="button">User Login</a>
    <small id="loginHelp" class="form-text text-muted">User login takes you to another login page!</small>
    </form>
  
</div>