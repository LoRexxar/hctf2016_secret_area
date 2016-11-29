<?php
require('class/header.php');

if(!empty($_POST['user']) && !empty($_POST['pass'])){

	$user=trim($_POST['user']);
	$pass=md5(trim($_POST['pass']));

	if(!get_magic_quotes_gpc()) { 
	        $user = addslashes($user);
	        $pass = addslashes($pass);
	} 

	$query="select * from users where username = '".$user."'";
	$result = $db->query($query);
	$num_results = $result->num_rows;

	if($num_results>0)
	{
		echo "<script>alert('This Username is exited!')</script>";
		echo "<script>window.location.href='static/redirect.php?u=/register.php'</script>";
		exit;	
	}else{
		$query = "insert into users (username,password) values ('".$user."' , '".$pass."')";
		$result = $db->query($query);	
		header('location:static/redirect.php?u=/index.php');
		exit;
	}

	$db->close();
}
?>
<div class="container back">
<div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                  <h1 class="white">神秘的聊天板</h1>
                  <h2 class="animated fadeInUp delay-05s white">rigeister pages</h2>
                </div>
</div>
<form method="post" class="form-signin" action="register.php">
	<div class="row">
	<h4 class="white">username:</h4><input type="text" class="form-control" name="user" >
	</div>
	<div class="row">
	<h4 class="white">password:</h4><input type="password"class="form-control"  name="pass" >
	</div>
	<input type="submit" value="submit">
</form>

<?php
	require('class/footer.php');
?>
