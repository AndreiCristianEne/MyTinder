<?php
// top
require_once 'components/top.php';
  
// bottom
require_once 'components/bottom.php';

// check that values are passed
if (!isset($_POST['txtFirstName']) || !isset($_POST['txtLastName']) || !isset($_POST['txtGender']) || !isset($_POST['txtUsability']) || !isset($_POST['txtAge']) ||
!isset($_POST['txtCity']) || !isset($_POST['txtEmail']) || !isset($_POST['txtPassword']) || !isset($_POST['txtDescription'])
) {
    header('Location: signup.php');
    exit;
}

// save the properties passed
$id = uniqid();
$sFirstName = $_POST['txtFirstName'];
$sLastName = $_POST['txtLastName'];
$sGender = $_POST['txtGender'];
$iAge = $_POST['txtAge'];
$sCity = $_POST['txtCity'];
$sEmail = $_POST['txtEmail'];
$sPassword = $_POST['txtPassword'];
$sDescription = $_POST['txtDescription'];
$sUsability = $_POST['txtUsability'];
$sLocationLatitude = $_POST['locationLatitude'];
$sLocationLongitude = $_POST['locationLongitude'];

//backend validation
//defensive coding, assume the user is messing up on purpose
if( !filter_var($sEmail, FILTER_VALIDATE_EMAIL) || !filter_var($iAge, FILTER_VALIDATE_INT) || $iAge < 18) {
    header('Location: signup.php');
    exit;
}

// create the object with the properties from above if they are valid
$sjUser = '{}';
$jUser = json_decode( $sjUser );
$jUser->id = $id;
$jUser->firstName = $sFirstName;
$jUser->lastName = $sLastName;
$jUser->gender = $sGender;
$jUser->age = $iAge;
$jUser->city = $sCity;
$jUser->email = $sEmail;
$jUser->password = $sPassword;
$jUser->description = $sDescription;
$jUser->usability = $sUsability;
$jUser->likedByThem = array();
$jUser->dislikedByThem = array();
$jUser->likedBy = array();
$jUser->verified = 0;
$jUser->locationLat = $sLocationLatitude;
$jUser->locationLong = $sLocationLongitude;

// read the users array from the file
$sajUsers = file_get_contents('users.txt');
$ajUsers = json_decode( $sajUsers );

// push the new user into the array from the file
// then save the new array into the file
array_push( $ajUsers, $jUser );
file_put_contents( 'users.txt', json_encode($ajUsers) );

// mail part

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = '';                 // SMTP username
    $mail->Password = '';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('eneandrei59@gmail.com', 'Tinder signup confirmation');
    $mail->addAddress($sEmail, 'Andrei-Cristian Ene');     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Please verify your account';
    $mail->Body    = "<h2>Thank you for signing up, {$sFirstName}!</h2> <br> <p>Click on the link below, and login with these credentials</p> <br> <p><b>Email</b>: {$sEmail}</p> <br> <p><b>Password</b>: {$sPassword}</p> <br> <a href='http://localhost/Tinder/signup-verify.php?id={$id}'>Click here to activate your account!</a>";
    
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}