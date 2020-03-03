<?php
// disable errors and warnings from the server - with 0 instead of 1
  ini_set( 'display_errors' , 1 );
  // bottom
require_once 'components/bottom.php';

// validate that you have a session
session_start(); // CRUD in this case to check if there is a session
// check if the session exists, if not, take the user back to login
if( !isset($_SESSION['id'] ) ) {
  header('Location: admin-login.php');
  exit;
}

$sId = $_SESSION['id'];

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
<p>Logged in as: <?php echo $sId ?></p>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Gender</th>
      <th scope="col">Age</th>
      <th scope="col">City</th>
      <th scope="col">Delete</th>
      <th scope="col">Update</th>
    </tr>
  </thead>
  <tbody>

  <?php
  foreach( $ajUsers as $jUser ){
    echo "<tr>
            <th scope='row' id='number'>{$jUser->id}</th>
            <td>{$jUser->firstName}</td>
            <td>{$jUser->lastName}</td>
            <td>{$jUser->gender}</td>
            <td>{$jUser->age}</td>
            <td>{$jUser->city}</td>

            <td>
                <form action='delete-user.php' method='post'>
                   <input type='hidden' name='id' value='{$jUser->id}'>  
                   <button type='submit' class='btn btn-danger'><i class='fas fa-trash'></i></button>
                </form>
            </td>

            <td>
                <form action='update-user.php' method='post'>
                   <input type='hidden' name='id' value='{$jUser->id}'>
                   <button type='submit' class='btn btn-warning'><i class='fas fa-edit'></i></button>       
                </form>
            </td>
          </tr>";
  }
  ?>

</tbody>
</table>
<div class="text-left">
  <a href="logout-admin.php" class="btn btn-info">Logout</a>
</div>
<div class="text-right">
    <a href="add-user.php" class="btn btn-success"><i class="fas fa-plus"></i></a>        
</div>

</div>

</body>
</html>
