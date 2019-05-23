<script>

  $message = $_POST['message'];
  
  $(document).ready(function(){

$('#formsubmit').click(function(){
  $.post("bestfriends.php", 
    {message: $('#message').val(), 
    function(data){
      $('#all_messages').html(data);
    }
  ); 
});
});
</script>

<?php
session_start();
include 'header.php';

echo "<div id='all_messages'><div class='top'><h4 class='display-6 text-center'> Best Friends </h4>
<hr><br></div>";

if(isset($_SESSION['username'])) { 

$xml = simplexml_load_file("bestfriends.xml") or die("Error");

foreach ($xml->children() as $messages) {
  echo "<strong>" . $messages->username . "</strong>: ";
  echo $messages->deliveryTime . " " . "</br>";
  echo $messages->text . "</br>" . "</br>";
}


if (isset($_REQUEST['send'])) {
  $xml = new DOMDocument('1.0', 'utf-8');
  $xml->preserveWhiteSpace = false;
  $xml->formatOutput = true;
  $xml->load('bestfriends.xml');

  $root = $xml->getElementsByTagName("chatbox")[0];
  $data = $xml->createElement("message");
  $name = $xml->createElement("username", $_SESSION['username']);
  $msg = $xml->createElement("text", $_REQUEST['message']);

  $Time = $xml->createElement("deliveryTime");
  $Date = new DateTime(); 
  $TimeText = $xml->createTextNode($Date->format('h:i:s A'));
  $Time->appendChild($TimeText);
  
  $data->appendChild($name);
  $data->appendchild($msg);
  $data->appendChild($Time);

  $root->appendchild($data);

  $xml->save("bestfriends.xml");
  
  header("Refresh:0");
}
?>
<hr>
  <form id="all_msg" method="post" action="bestfriends.php">
      <input type="text" id="message"  name="message" placeholder=" Write your message" /> 
      <button type="submit" id="formsubmit" name="send" value="send">Send</button>
    </form>

<?php
echo "</div>";

} else {
  echo "Please login to continue";
  header("location: login.php");
}
?>
