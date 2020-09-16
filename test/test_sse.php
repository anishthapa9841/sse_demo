<?php
/** 
 * unit test to check if the notification is being generated.
 * this code loops through 5 times generating 5 notification in the 5 sec interval and 
 * will clean the database after insert
 * 
 * @var integer
 */

$mysqli = new mysqli("localhost", "root", "root", "db_sse");
if($mysqli->connect_errno) {
  echo "Error failed to connect to mysqli \n";
  echo "errno: ". $mysqli->connect_errno. "\n";
  echo "Error: ". $mysqli->connect_error. "\n";
  exit;
}

echo "strating loop\n";

$not_id_array = array();
for( $i = 0; $i < 3; $i++ ) {
  $sql = "INSERT INTO `tbl_notification` (`title`, `notification_data`, `icon`, `badge`, `tag`, `action_link`, `sound_link`, `is_active`, `order_code`, `priority`, `ttl`, `rel_id`, `type`) VALUES
	(?, ?, NULL, NULL, NULL, NULL, NULL, 'Y', 1, 1, '10000', 1, '')";
  $stmt = $mysqli->prepare($sql);
  $title = "not_test_".$i;
  $notification_data = ": not_data_unit_test_".$i ."\n";
  $stmt->bind_param("ss", $title, $notification_data);
  $stmt->execute();
  $stmt->close();

  $sql2 = "INSERT INTO `tbl_notification_consumer` (`not_id`, `user_id`, `is_read_status`, 
  				`read_datetime`, `is_active`)
					VALUES
					(?, ?, 'N', '', 'Y')";
	$stmt2 = $mysqli->prepare($sql2);
  $not_id = $mysqli->insert_id;
  $not_id_array[] = $not_id;
  $user_id = 1;
  $stmt2->bind_param("ii", $not_id, $user_id);
  $stmt2->execute();
  $stmt2->close();


  sleep(5);
}
echo "end loop\n";


echo "deleting test data\n";

$params = str_repeat('?,', count($not_id_array) - 1). '?';
$types = str_repeat("i", count($not_id_array));

$sql3 = "delete from tbl_notification_consumer where not_id in ($params)";
$stmt3 = $mysqli->prepare($sql3);
$stmt3->bind_param($types, ...$not_id_array);
$stmt3->execute();
$stmt3->close();

$sql4 = "delete from tbl_notification where id in ($params)";
$stmt4 = $mysqli->prepare($sql4);
$stmt4->bind_param($types, ...$not_id_array);
$stmt4->execute();
$stmt4->close();

echo "delete complete\n";

$mysqli->close();

?>