<?php
  
  session_start();

  $sajUsers = file_get_contents('users.txt');
  $ajUsers = json_decode($sajUsers);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tinder</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    
<div class="container"> 
    <form action="add-user-api.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputName">First Name</label>
            <input name="txtFirstName" type="text" class="form-control" id="exampleInputName">
        </div>
        <div class="form-group">
            <label for="exampleInputLastName">Last Name</label>
            <input name="txtLastName" type="text" class="form-control" id="exampleInputLastName">
        </div>
        <div class="form-group">
            <label for="exampleGender">Gender (<b>M</b> / <b>F</b>)</label>
            <select name="txtGender" class="form-control">
              <option>Male</option>
              <option>Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputAge">Age</label>
            <input name="txtAge" type="text" class="form-control" id="exampleInputAge">
        </div>
        <div class="form-group">
            <label for="exampleInputCity">City</label>
            <input name="txtCity" type="text" class="form-control" id="exampleInputCity">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail">Email address</label>
            <input name="txtEmail" type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted"><b>Important!</b> You'll be needed to confirm your signup by email soon.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword">Password</label>
            <input name="txtPassword" type="text" class="form-control" id="exampleInputPassword">
        </div>
        <div class="form-group">
            <label for="exampleUsability">Choose type of user</label>
            <select name="txtUsability" class="form-control" id="exampleUsability">
              <option>0</option>
              <option>1</option>
            </select>
            <small id="usabilityHelp" class="form-text text-muted"><b>0</b> is normal user (guest), and <b>1</b> is VIP user</small>
        </div>
        <div class="form-group">
            <label for="exampleInputDescription">Description</label>
            <textarea name="txtDescription" class="form-control" id="exampleInputDescription" rows="3"></textarea>
        </div>
        <br>
        <div class="form-group">
            <label for="exampleInputFile">Photo upload</label>
            <input name="fileToUpload" type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
            <small id="fileHelp" class="form-text text-muted">Attach a cool-looking photo of the user</small>
        </div>
        
  <button type="submit" class="btn btn-primary">Add</button>
</form> 
</div>

</body>
</html>