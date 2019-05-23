<?php
session_start();
include 'header.php';

echo "<div class='container-login'><h5 class='text-center welcome'> 
" . "<strong>" . $_SESSION['username'] . "</strong>" . "</br>" . "</br>" . " please select the chatroom</br></h5>
<hr><br>";

if(isset($_SESSION['username'])) { 
   
$xml=simplexml_load_file("chatrooms.xml") or die("Error");

echo "<div class='links'></br>";
foreach ($xml->children() as $chatrooms) {
	if($chatrooms->groupname[0]== "Humber College"){
		echo "<a class='groups' href='humbercollege.php'</a>" . $chatrooms->groupname[0] . "</br></br>";
	} else if ($chatrooms->groupname[0]== "Best Friends"){
		echo "<a class='groups' href='bestfriends.php'</a>" . $chatrooms->groupname[0] . "</br></br>";
	} else{
		echo "<a class='groups' href='mainroom.php'</a>" . $chatrooms->groupname[0] . "</br></br></br>";
	}
}

} else {
    echo "Please login to continue";
}
echo "</div>"
?>
	<button id='form-login'><a class="logout" href='logout.php'>Log Out</a></button>
</div>
</html>