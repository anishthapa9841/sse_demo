<?php 
// turn below 3 lines for displaying errors
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

//setting default timezone and header for server side event
date_default_timezone_set("Asia/Kathmandu");
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");

//running a contineous while loop for creating only one event socket 
while(1) {
  // for checking the contineous connection
	echo "event: ping\n", "data:" . date('Y-m-d H:i:s') . "\n\n";
  // end checking contineous connection

  // parameters to send to the 
  $last_5_sec = date('Y-m-d H:i:s', strtotime('-5 seconds') );
  $user_id = 1;

  //running the notification query
  $mysqli = new mysqli("localhost", "root", "root", "db_sse");
  if($mysqli->connect_errno) {
    echo "Error failed to connect to mysqli \n";
    echo "errno: ". $mysqli->connect_errno. "\n";
    echo "Error: ". $mysqli->connect_error. "\n";
    exit;
  }
  $sql = "SELECT n.id, n.title, n.notification_data, n.icon, n.badge, n.tag, n.action_link, 
          n.created_datetime,n.is_active, n.order_code, n.priority, n.ttl, n.rel_id,
          nc.user_id, nc.is_read_status, nc.id as nc_id
          FROM tbl_notification n join tbl_notification_consumer nc on n.id = nc.not_id
          WHERE nc.user_id = ? and n.is_active = 'Y' and nc.is_active='Y' and nc.is_read_status= 'N'
          and n.created_datetime >= ? order by n.id";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("is", $user_id, $last_5_sec);
  $stmt->execute();
  $result = $stmt->get_result();  
  while($row = $result->fetch_assoc()) {
    echo "event: notification\n","data:" . json_encode($row) , "\n\n";
  }
  $stmt->close();
  $mysqli->close();
  //end notification query

  //for flushing the result immediately to the user as it is in infinite loop
  while(ob_get_level() > 0 ) {
  	ob_end_flush();
  }
  flush();
  //end flush result

  if ( connection_aborted() ) exit();

	// sleep for 5 second before running the loop again
	sleep(5);
}