<?php
//error_reporting(E_ALL);
$cmd = $_POST['rgb'];

if(($sock=socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
  echo "socket_create() failed: reason: ".socket_strerror(socket_last_error())."\n";
  die;
}

if(($sock_con=socket_connect($sock, '192.168.1.107', 8899))===false) {
  echo "socket_connect() failed: reason: ".socket_strerror(socket_last_error($sock))."\n";
  socket_close($sock);
  die;
}
//send command to the device
if(!empty($cmd)) {
	if(($send_ret=socket_send($sock, $cmd, strlen($cmd),0))===false) {
		echo "socket_write() failed: reason: ".socket_strerror(socket_last_error($sock))."\n";
	}

	if(($cmd=socket_read($sock, 1024, PHP_NORMAL_READ))===false) {
		echo "socket_read() failed: reason: ".socket_strerror(socket_last_error($sock))."\n";
	}
}
//refresh the device information
$cmd="#?";
if(($send_ret=socket_send($sock, $cmd, strlen($cmd),0))===false) {
  echo "socket_write() failed: reason: ".socket_strerror(socket_last_error($sock))."\n";
}
//if($cmd=="#?") { 
   if(($cmd=socket_read($sock, 1024, PHP_NORMAL_READ))===false) {
      echo "socket_read() failed: reason: ".socket_strerror(socket_last_error($sock))."\n";
   }
   $cmd=trim($cmd);
   if(!empty($cmd)) { 
	print $cmd;
   }
//}

socket_close($sock);

//print "01&A0123456&00D3&+22.3125C&FF6B09000000&M\x0d";
?>