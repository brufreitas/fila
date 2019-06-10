<?php
if (($MSGKey = ftok("/var/www/html/fila/fila_out.php", "S")) == -1) {
  die("ftok");
}

$seg = msg_get_queue($MSGKey);


$t = 1;

for ($i = 1; $i <= 10; $i++) {
  $s = array (
    "i" => $i,
    "d" => date("H:i:s"),
    "m" => "Hello, this is message `{$i}`",
  );

  if (msg_send($seg, $t, $s)) {
    print "msg_send done...\n"; 
    $stat = msg_stat_queue($seg); 
    print "Messages in the queue: {$stat["msg_qnum"]}\n"; 
  }

  sleep(1);
}


?>