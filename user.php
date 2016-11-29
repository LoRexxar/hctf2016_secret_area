<?php
require('class/header.php');

if(!isset($_SESSION['user']))
	{
		echo "<script>alert('you need login first!')</script>";
		echo "<script>window.location.href='static/redirect.php?u=/index.php'</script>";
		exit;	
	}

$user = $_SESSION['user'];

$query="select * from users where username = '{$user}'";
$result=$db->query($query);
$req=$result->fetch_assoc();

$avatar = $req['avatar'];

?>

<div class='col-md-8 col-md-offset-2 text-center head' id="head">
	<h1 class='white'>welcome ,<?php echo $user ?>  
		<img class="avatar" src="<?php echo $avatar?>" />
	</h1>
</div>

<div id='hide' class='col-md-8 col-md-offset-2 text-center'><h2 class='animated fadeInUp delay-05s white'>Try to send message to others</h2></div>

<div class="container back">

	<div class="list-group-item warn">
		<h3>
		Tips:
		</h3>
		<p>
		If you come here for the first time, you can click <a href="./profile.php">here</a> to modify you profile.
		</p>
	</div>

	<form method="post" action="submit.php">
	To:<input type="text" class="form-control" style="max-width:200px; margin-bottom:15px" name="to">
	<textarea class="form-control" name="message"></textarea>
	<input type="submit" style="margin-left:450px;" value="Send">
	</form>

<ul class='list-group' style='background-color: #333'>

<?php

$query="select message from m where user = '".$user."'";
$result=$db->query($query);
@ $num_results = $result->num_rows;

	for($i=0;$i < $num_results; $i++)
	{
		$row = $result->fetch_assoc();
		echo " <li class=\"list-group-item\">".$row['message']."</li>";
	}

	@$result->free();
	$db->close();

require('class/footer.php');
?>

