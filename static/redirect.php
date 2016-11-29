
<?php
 if(isset($_GET['u'])){
 	$url = $_GET['u'];
	header('location: '.$url);
	exit;
 } elseif(isset($_SERVER['HTTP_REFERER'])){
 	$url = $_SERVER['HTTP_REFERER'];
 } else{
 	$url = "/index.php";
 }
?>

Here is the unknown area, 3 seconds after the return...
<script>

function redirect(){    
	window.location.href='<?php echo $url ?>'
}

window.onload = function(){
	setTimeout(redirect, 3000)
}
</script>