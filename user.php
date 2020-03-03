<?php
  // disable errors and warnings from the server - with 0 instead of 1
  ini_set( 'display_errors' , 1 );
  // bottom
require_once 'components/bottom.php';

// validate that you have a session
session_start(); // CRUD in this case to check if there is a session
// check if the session exists, if not, take the user back to login
if( !isset($_SESSION['id'] ) ) {
  header('Location: login.php');
  exit;
}

$iId = $_SESSION['id'];

// get the users
$sajUsers = file_get_contents('users.txt');
$ajUsers = json_decode($sajUsers);

foreach($ajUsers as $jUser) {
  if ($jUser->id == $iId) {
      $sFirstName = $jUser->firstName;
      $sLastName = $jUser->lastName;
      $sGender = $jUser->gender;
      $sAge = $jUser->age;
      $sCity = $jUser->city;
      $sEmail = $jUser->email;
      $sDescription = $jUser->description;
      $sLat = $jUser->locationLat;
      $sLong = $jUser->locationLong;
      $sImage = "assets/user-imgs/{$iId}.jpg";
  }
 
  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tinder</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8PD1Mgc3UKgEd0H0MjknXyRHLg8LGO6A&callback=initMap"
    async defer></script>
    <script>
      console.log("hi");
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: <?php echo $sLat ?>, lng: <?php echo $sLong ?>},
          zoom: 10
        });
        var marker = new google.maps.Marker({
          position: {lat: <?php echo $sLat ?>, lng: <?php echo $sLong ?>},
          map: map
        });
      }
    </script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- My CSS -->
    <link rel="stylesheet" href="user.css">
    <style>
      #map {
        height: 400px;
      }
    </style>
</head>
<body>

<div class="row">
  <div class="col-4">

    <p> Welcome, <b><?php echo $sFirstName.' '.$sLastName?></b> </p>
    <img class="img-fluid" src="<?php echo $sImage?>">
    <p> <b>Age</b>: <?php echo $sAge?> </p>
    <p> <b>Gender</b>: <?php echo $sGender?> </p>
    <p> <b>City</b>: <?php echo $sCity?> </p>
    <p> <b>Email</b>: <?php echo $sEmail?> </p>
    <p> <b>Description</b>:  <?php echo $sDescription?></p> 
    <div id="map"></div>
    <br>
    <div class="text-center">
      <a href="logout.php" class="btn btn-info">Logout</a>
    </div>
    <br> <br>
    <div class="text-center">
      <blockquote class="blockquote">
        <p class="mb-0">Below you can see your matches</p>
        <div id="myDiv"></div>
      </blockquote>
    </div>
    <br> <br>
    <div class="text-center">
      <button type="button" class="btn btn-danger" id="btnSeeDislikes">See who disliked me</button>
      <div id="divDislikes"></div>
    </div>
  </div>
  
  <div class="col-8">
    <div class="card text-center" style="left: 7em; width:50em; height:41em; background-color: whitesmoke; border: 0.5px solid grey ;border-radius: 5px;">
        <img class="mx-auto d-block" style="width:15em; height:20em;" src="" alt="Card image" id="imgPerson">
        <div class="card-body">
          <h5 id="person_name" class="text-center card-title font-weight-bold">Name of person</h5>
          <p hidden id="person_id"></p>
          <p id="person_gender" class="card-text text-center">gender</p>
          <p id="person_age" class="card-text text-center">age</p>
          <p id="person_desc" class="card-text text-center">description</p>
          <p id="person_city" class="card-text text-center">city</p> 
          <div class="actions">
            <button type="button" class="btn btn-danger" id="btnNope">Nope 👎</button>
            <button type="button" class="btn btn-primary" id="btnLike">Like 💗</button>
          </div>
        </div>
    </div>
  </div>

</div>

<script>

  var aUsers = [];
  var aUsersThatLikedMe = [];
  callUsers();
  var likeAudio = new Audio("assets/like.mp3");
  var dislikeAudio = new Audio("assets/dislike.mp3");
  
  function emptyCard() {
    $("#imgPerson").attr("src", "assets/logo/logo.png");
    $("#person_id").text( "-" );
    $("#person_name").text( "There is no one new" );
    $("#person_age").html( "-" );
    $("#person_gender").html( "-" );
    $("#person_desc").text( "-" );
    $("#person_city").html( "-" );
    $("#btnNope").attr( "disabled", "disabled" );
    $("#btnLike").attr( "disabled", "disabled" );
  }

  function populateCard(user) {
      $("#imgPerson").attr("src", "assets/user-imgs/"+user.id+".jpg");
      $("#person_id").text( user.id );
      $("#person_name").text( user.firstName + " " + user.lastName );
      $("#person_age").html( "<i>" + user.age + "</i>" );
      $("#person_gender").html( "<i>" + user.gender + "</i>" );
      $("#person_desc").text( user.description );
      $("#person_city").html( "<b>" + user.city + "</b>" );           
   }

  function callUsers() {
    $.get( 'server.php' , {'id': "<?php echo $iId ?>"} , function( sResponse ){
      var jResponse = JSON.parse( sResponse );
      aUsers = jResponse;
      //console.log(aUsers);
      if (aUsers.length > 0) {
        populateCard(aUsers[0]);
      } 
      else {
        emptyCard();
      }
      })
  }

  $("#btnSeeDislikes").click(function() {
    $.get( 'api-see-dislikes.php' , {'id': "<?php echo $iId ?>"} , function( sResponse ){
        // get an array with all users that disliked you
        if ( sResponse == "no" ) {
          swal({
              title: "Invalid command",
              text: "You need to be a VIP user to see the dislikes",
              icon: "error",
            });
        } else {
          var jResponse = JSON.parse( sResponse );
          aUsersThatDislikedMe = jResponse;
          //console.log(aUsersThatDislikedMe);
          $("#divDislikes").empty();
          aUsersThatDislikedMe.forEach((user)=> {
            $("#divDislikes").append("<button type='button' class='btn btn-default'>" + user.firstName + " " + user.lastName + "   <span class='badge badge-danger'>" + user.email + "</span></button><br><br>");
          });
        } 
    })
  });

    $("#btnNope").click(function() {
      dislikeAudio.play();
      console.log("dislike");
      $.post( 'server.php' , {'idUser': "<?php echo $iId ?>", 'idOption': $("#person_id").text(), 'option': 'nope'} , function( sResponse ){
          console.log( sResponse );
      })
      aUsers = aUsers.splice(1);
      if (aUsers.length > 0) {
        populateCard(aUsers[0]);
      } 
      else {
        emptyCard();
      }
    });

    $("#btnLike").click(function() {
      likeAudio.play();
      console.log("like");
      $.post( 'server.php' , {'idUser': "<?php echo $iId ?>", 'idOption': $("#person_id").text(), 'option': 'like'} , function( sResponse ){
          console.log( sResponse );
      })
      aUsers = aUsers.splice(1);
      if (aUsers.length > 0) {
        populateCard(aUsers[0]);
      } 
      else {
        emptyCard();
      }
    }); 

    setInterval(function() {

      $.get( 'api-user-like.php' , {'id': "<?php echo $iId ?>"} , function( sResponse ){
        var jResponse = JSON.parse( sResponse );
        aUsersThatLikedMe = jResponse;
        //console.log(aUsersThatLikedMe);
        if (aUsersThatLikedMe.length > 0) {
          if (!localStorage.users) {
            localStorage.users = JSON.stringify(aUsersThatLikedMe);
          }
          if (JSON.parse( localStorage.users ).length != aUsersThatLikedMe.length) {
            localStorage.users = JSON.stringify(aUsersThatLikedMe); 
          }
          // delete localStorage.users;
          $("#myDiv").empty();
          aUsersThatLikedMe.forEach((user)=> {
            $("#myDiv").append("<button type='button' class='btn btn-primary'>" + user.firstName + " " + user.lastName + "   <span class='badge badge-light'>" + user.email + "</span></button><br><br>");
          });
        }
      })
    }, 3000);

    setInterval(function() {
      callUsers();
      $('#btnNope').prop('disabled', false);
      $('#btnLike').prop('disabled', false);
    }, 10000)
      
</script>