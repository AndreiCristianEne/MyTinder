<?php
  // top
  require_once 'components/top.php';
  
  // bottom
  require_once 'components/bottom.php';
?>

    <div class="container"> 
    <form>
        <div class="form-group">
            <label for="exampleInputName">First Name</label>
            <input name="txtFirstName" type="text" class="form-control" id="exampleInputName" placeholder="Enter first name">
        </div>
        <div class="form-group">
            <label for="exampleInputLastName">Last Name</label>
            <input name="txtLastName" type="text" class="form-control" id="exampleInputLastName" placeholder="Enter family name">
        </div>
        <div class="form-group">
            <label for="exampleGender">Gender (<b>M</b> / <b>F</b>)</label>
            <select name="txtGender" class="form-control" id="exampleGender">
              <option>Male</option>
              <option>Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputAge">Age</label>
            <input name="txtAge" type="text" class="form-control" id="exampleInputAge" placeholder="Enter age">
        </div>
        <div class="form-group">
            <label for="exampleInputCity">City</label>
            <input name="txtCity" type="text" class="form-control" id="exampleInputCity" placeholder="Enter city">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail">Email address</label>
            <input name="txtEmail" type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted"><b>Important!</b> You'll be needed to confirm your signup by email soon.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword">Password</label>
            <input name="txtPassword" type="password" class="form-control" id="exampleInputPassword" placeholder="Password">
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
            <textarea name="txtDescription" class="form-control" id="exampleInputDescription" rows="3" placeholder="a few words about you..."></textarea>
        </div>
        
  <button type="button" id="btnSubmit" class="btn btn-primary">Submit</button>
</form> 
</div>    

<!-- My own JS -->
<script>

    $("#btnSubmit").click(function() {
        var sFirstName = $("#exampleInputName").val();
        var sLastName = $("#exampleInputLastName").val();
        var sGender = $("#exampleGender").val();
        var iAge = $("#exampleInputAge").val();
        var sCity = $("#exampleInputCity").val();
        var sEmail = $("#exampleInputEmail").val();
        var sPassword = $("#exampleInputPassword").val();
        var sUsability = $("#exampleUsability").val();
        var sDescription = $("#exampleInputDescription").val()

        // Create regexp to validate first and last names
        var sRegular = /^[a-zA-Z- ]{2,20}$/;

        // Check the first name
        if ( !sRegular.test(sFirstName) ) {
            $("#exampleInputName").css("border-style", "ridge");
            $("#exampleInputName").css("border-color", "#ff4d4d");
            $("#exampleInputName").css("border-width", "2.5px");
            swal({
              title: "Invalid first name",
              text: "Only letters & length between 2 and 20!",
              icon: "error",
            });
          } else {
            $("#exampleInputName").css("border-color", "#00e64d");
            $("#exampleInputName").css("border-style", "ridge");
            $("#exampleInputName").css("border-width", "2.5px");
          }
          // Check the last name
          if ( !sRegular.test(sLastName) ) {
            $("#exampleInputLastName").css("border-style", "ridge");
            $("#exampleInputLastName").css("border-color", "#ff4d4d");
            $("#exampleInputLastName").css("border-width", "2.5px");
            swal({
              title: "Invalid last name",
              text: "Only letters & length between 2 and 20!",
              icon: "error",
            });
          } else {
            $("#exampleInputLastName").css("border-color", "#00e64d");
            $("#exampleInputLastName").css("border-style", "ridge");
            $("#exampleInputLastName").css("border-width", "2.5px");
          }
          // Check the gender
          if ( !sGender ) {
            $("#exampleGender").css("border-style", "ridge");
            $("#exampleGender").css("border-color", "#ff4d4d");
            $("#exampleGender").css("border-width", "2.5px");
            swal({
              title: "Invalid gender",
              text: "Are you male or female?",
              icon: "error",
            });
          } else {
            $("#exampleGender").css("border-color", "#00e64d");
            $("#exampleGender").css("border-style", "ridge");
            $("#exampleGender").css("border-width", "2.5px");
          }
          // Check the age
          if ( iAge < 18 || isNaN(iAge) ) {
            $("#exampleInputAge").css("border-style", "ridge");
            $("#exampleInputAge").css("border-color", "#ff4d4d");
            $("#exampleInputAge").css("border-width", "2.5px");
            swal({
              title: "Invalid age",
              text: "You have to be 18 or older to use this app!",
              icon: "error",
            });
          } else {
            $("#exampleInputAge").css("border-color", "#00e64d");
            $("#exampleInputAge").css("border-style", "ridge");
            $("#exampleInputAge").css("border-width", "2.5px");
          }
          // Check the city
          if ( !sCity ) {
            $("#exampleInputCity").css("border-style", "ridge");
            $("#exampleInputCity").css("border-color", "#ff4d4d");
            $("#exampleInputCity").css("border-width", "2.5px");
            swal({
              title: "Invalid city",
              text: "Write a city!",
              icon: "error",
            });
          } else {
            $("#exampleInputCity").css("border-color", "#00e64d");
            $("#exampleInputCity").css("border-style", "ridge");
            $("#exampleInputCity").css("border-width", "2.5px");
          }
          // Check the email
          if ( !sEmail || !sEmail.includes('@') ) {
            $("#exampleInputEmail").css("border-style", "ridge");
            $("#exampleInputEmail").css("border-color", "#ff4d4d");
            $("#exampleInputEmail").css("border-width", "2.5px");
            swal({
              title: "Invalid email",
              text: "Make sure it contains @",
              icon: "error",
            });
          } else {
            $("#exampleInputEmail").css("border-color", "#00e64d");
            $("#exampleInputEmail").css("border-style", "ridge");
            $("#exampleInputEmail").css("border-width", "2.5px");
          }
          // Check the password 
          if ( !sPassword ) {
            $("#exampleInputPassword").css("border-style", "ridge");
            $("#exampleInputPassword").css("border-color", "#ff4d4d");
            $("#exampleInputPassword").css("border-width", "2.5px");
            swal({
              title: "Invalid password",
              text: "You need to provide a password!",
              icon: "error",
            });
          } else {
            $("#exampleInputPassword").css("border-color", "#00e64d");
            $("#exampleInputPassword").css("border-style", "ridge");
            $("#exampleInputPassword").css("border-width", "2.5px");
          }
          // Check the description 
          if ( !sDescription ) {
            $("#exampleInputDescription").css("border-style", "ridge");
            $("#exampleInputDescription").css("border-color", "#ff4d4d");
            $("#exampleInputDescription").css("border-width", "2.5px");
            swal({
              title: "Invalid description",
              text: "Come on, write something about yourself!",
              icon: "error",
            });
          } else {
            $("#exampleInputDescription").css("border-color", "#00e64d");
            $("#exampleInputDescription").css("border-style", "ridge");
            $("#exampleInputDescription").css("border-width", "2.5px");
          }
          // Check the usability
          if ( !sUsability ) {
            $("#exampleUsability").css("border-style", "ridge");
            $("#exampleUsability").css("border-color", "#ff4d4d");
            $("#exampleUsability").css("border-width", "2.5px");
            swal({
              title: "Invalid usability",
              text: "Choose between guest (0) and VIP (1)",
              icon: "error",
            });
          } else {
            $("#exampleUsability").css("border-color", "#00e64d");
            $("#exampleUsability").css("border-style", "ridge");
            $("#exampleUsability").css("border-width", "2.5px");
          }

          function notifyMe() {
            // Let's check if the browser supports notifications
            if (!("Notification" in window)) {
              alert("This browser does not support desktop notification");
            }

            // Let's check whether notification permissions have already been granted
            else if (Notification.permission === "granted") {
              // If it's okay let's create a notification
              var notification = new Notification("Confirmation mail sent");
            }

            // Otherwise, we need to ask the user for permission
            else if (Notification.permission !== "denied") {
              Notification.requestPermission(function (permission) {
                // If the user accepts, let's create a notification
                if (permission === "granted") {
                  var notification = new Notification("Confirmation mail sent");
                }
              });
            }
          }

          // validate inputs and send post request if ok 
          if( sRegular.test(sFirstName) && sRegular.test(sLastName) && sGender && iAge >= 18 && !isNaN(iAge) && sDescription && sCity &&
          sPassword && sUsability && sEmail && sEmail.includes('@') ) {
              
              navigator.geolocation.getCurrentPosition(getPosition);

              function getPosition(position) {
                var lat=position.coords.latitude, long=position.coords.longitude;
                console.log("lat: "+ lat + " long: " + long);
                $.post( 'signup-validate.php' , {
                'txtFirstName': sFirstName, 
                'txtLastName': sLastName, 
                'txtGender': sGender,
                'txtAge': iAge,
                'txtCity': sCity,
                'txtDescription': sDescription,
                'txtEmail': sEmail,
                'txtPassword': sPassword,
                'txtUsability': sUsability,
                'locationLatitude': lat,
                'locationLongitude': long
                }, function( sResponse ){
                    //console.log( sResponse )
                    // show a sweet alert that you will get a email and desktop notification
                    notifyMe();
                    swal({
                      title: "Good job, "+sFirstName+"!",
                      text: "Check your mailbox, you will soon receive a confirmation email!",
                      icon: "success",
                      button: "Ok",
                    });
                })
              }

            
          }

    });

</script>
