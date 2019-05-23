<?php
  session_start();
  include 'header.php';

    if (isset($_REQUEST['submit'])) {
  
    $xml = new DOMDocument('1.0', 'utf-8');

    $xml->preserveWhiteSpace = false;
    $xml->formatOutput = true;
      
    $xml->load("users.xml");
    $root = $xml->getElementsByTagName("users")[0];
    $data = $xml->createElement("password");

    $name = $xml->createElement("username", $_REQUEST['username']);
    $id = $xml->createElement("password", md5($_REQUEST['password']));

    $data->appendChild($name);
    $data->appendChild($id);
    $root->appendChild($data);

    $xml->save("users.xml");  
    $_SESSION['username'] = $_POST['username'];

    echo $_SESSION['username'];
    header("location: chatgroup.php");
    }

  require_once('clientinfo.php');

  $url = 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . 
  urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') . '&redirect_uri=' . 
  urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-login">
<h4 class="display-6 text-center"> Welcome </h4>  
<hr>
<div id="my-signin2"></div>
  <script>
    function onSuccess(googleUser) {
      console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
    }
    function onFailure(error) {
      console.log(error);
    }
    function renderButton() {
      gapi.signin2.render('my-signin2', {
        'scope': 'profile email',
        'width': 400,
        'height': 40,
        'longtitle': true,
        'theme': 'light',
        'onsuccess': onSuccess,
        'onfailure': onFailure
      });
    }
  </script>

  <form id="all-msg-login" method="post" action="login.php">
      <div>
          <input class="input-login" type="text"  name="username" placeholder=" Name"/> <hr>
          <input class="input-login" type="password"  name="password" placeholder=" Password"/> <hr>
      </div></br>
      <button type="submit" name="submit" id="form-login" value="add">Log In</button>
    </form> </br>

  <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
  </div>
  </body>
  </html>
  