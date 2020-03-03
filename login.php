<?php

// top
require_once 'components/top.php';
  
// bottom
require_once 'components/bottom.php';
?>

<div class="container">
    <h5>Login as user</h5>
</div>

<div class="container">
  <form action="login-verify.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="txtEmail">Email</label>
      <input name="txtEmail" type="email" class="form-control" id="txtEmail"> 
      <label for="txtPassword">Password</label>
      <input name="txtPassword" type="password" class="form-control" id="txtPassword" >
      <br>
      <div class="form-group">
          <label for="exampleInputFile">Photo upload</label>
          <input name="fileToUpload" type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
          <small id="fileHelp" class="form-text text-muted">Attach a cool-looking photo of yourself</small>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
    <a href="admin-login.php" class="btn btn-info" role="button">Admin Login</a>
    <small id="loginHelp" class="form-text text-muted">Admin login takes you to another login page!</small>
  </form>
  
</div>