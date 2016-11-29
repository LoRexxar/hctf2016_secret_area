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

$introduction = $req['introduction'];
$avatar = $req['avatar'];

if(isset($_POST['intro']) && isset($_FILES['avatar'])){

	$intro = $_POST['intro'];
	$mypic = $_FILES['avatar'];

	$picname = $mypic['name'];
	$picsize = $mypic['size'];

	if($picsize > 51200){
		echo "<script>alert('avatar must bu < 500k!')</script>";
		echo "<script>window.location.href='static/redirect.php?u=/profile.php'</script>";
		exit;
	}
	elseif($picsize < 0){
		echo "<script>alert('you must upload avatar')</script>";
		echo "<script>window.location.href='static/redirect.php?u=/profile.php'</script>";
		exit;
	}

	$pic_path ="./upload/".md5($picname.time().rand(1,5000));

	move_uploaded_file($mypic['tmp_name'], $pic_path);

	$query = "update users set introduction = '{$intro}',avatar = '{$pic_path}' where username = '{$user}'";
	$result = $db->query($query);	
	$num_results = $db->affected_rows;

	if($num_results != 0)
	{
		echo "<script>alert('profile changed successfully!')</script>";
	    echo "<script>window.location.href='static/redirect.php?u=/profile.php'</script>";
		exit;
    }
    else
   	{
    	echo "<script>alert('something wrong!')</script>";
    	echo "<script>window.location.href='static/redirect.php?u=/profile.php'</script>";
		exit;
    }
}

?>

<body>

	<div class='col-md-8 col-md-offset-2 text-center head' id='head'>
		<h1 class='white'>welcome ,<?php echo $user;?> 
			<img class="avatar" src="<?php echo $avatar?>" />
		</h1>
	</div>
	<div id='hide' class='col-md-8 col-md-offset-2 text-center'>
		<h2 class='animated fadeInUp delay-05s white'>Improve your personal information</h2>
	</div>

	<div class="container back">
		<form method="post"  class="form-signin" action="profile.php" enctype="multipart/form-data">
			username:<input type="text" disabled="true" class="form-control" name="username" value="<?php echo $user?>">
			introduction:<textarea class="form-control" name="intro"><?php echo $introduction; ?></textarea>
			avatar(<50k):<input type="file" class="form-control" name="avatar">
			<input type="submit" style="display:inline;margin-left:130px" value="submit">
			<input type="button" class="back" style="display:inline; margin-left:50px" value="back">

		</form>
	</div>

<?php
	require('class/footer.php');
?>
