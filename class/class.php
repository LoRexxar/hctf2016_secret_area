<?php
require('config.php');

function filter($string)
{
		$escape = array('\'','\\\\');
		$escape = '/' . implode('|', $escape) . '/';
		$string = preg_replace($escape, '_', $string);

		$safe = array('select', 'insert', 'update', 'delete', 'where');
	 	$safe = '/' . implode('|', $safe) . '/i';
	 	$string = preg_replace($safe, 'hacker', $string);

		$xsssafe = array('img','script','on','svg','link');
		$xsssafe = '/' . implode('|', $xsssafe) . '/i';
		return preg_replace($xsssafe, '', $string);
		

}

header("Content-Security-Policy:default-src 'self'; script-src http://115.28.78.16:12222/static/ 'sha256-n+kMAVS5Xj7r/dvV9ZxAbEX6uEmK+uen+HZXbLhVsVA=' 'sha256-2zDCsAh4JN1o1lpARla6ieQ5KBrjrGpn0OAjeJ1V9kg=' 'sha256-SQQX1KpZM+ueZs+PyglurgqnV7jC8sJkUMsG9KkaFwQ=' 'sha256-JXk13NkH4FW9/ArNuoVR9yRcBH7qGllqf1g5RnJKUVg=' 'sha256-NL8WDWAX7GSifPUosXlt/TUI6H8JU0JlK7ACpDzRVUc=' 'sha256-CCZL85Vslsr/bWQYD45FX+dc7bTfBxfNmJtlmZYFxH4=' 'sha256-2Y8kG4IxBmLRnD13Ne2JV/V106nMhUqzbbVcOdxUH8I=' 'sha256-euY7jS9jMj42KXiApLBMYPZwZ6o97F7vcN8HjBFLOTQ=' 'sha256-V6Bq3u346wy1l0rOIp59A6RSX5gmAiSK40bp5JNrbnw='; font-src http://115.28.78.16:12222/static/ fonts.gstatic.com; style-src 'self' 'unsafe-inline'; img-src 'self'");

session_start();
?>
