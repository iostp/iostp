<?php

header('Content-Type: text/json');
$kitName = $_POST['kitName'];
$kitName = str_replace('/','',str_replace("\\","",$kitName));
header('Content-Disposition: attachment; filename="data_' . $_POST['kitName'] . '.json"');

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
if(mysqli_connect_errno()) {
	echo "Connection Failed: " . mysqli_connect_errno();
	exit();
}


$kitData  = mysql_real_escape_string($_POST['kitData']);

$kitData = str_replace('\\"', '"', $kitData);
$kitData = str_replace('\\\\"','\\"',$kitData);
echo $kitData;
?>