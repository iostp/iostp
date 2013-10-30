<?php

require_once("../../constants.php");
require_once("MysqliDb.php");

//error_reporting(-1);

trigger_error("starting getDatasources.json.php", E_USER_NOTICE);

$_db = new Mysqlidb($db_host, $db_user, $db_pass, $db_name);

if(mysqli_connect_errno()) {
	echo "Connection Failed: " . mysqli_connect_errno();
	exit();
}

$tags = $_GET['tags'];



$feedQuery = "select distinct FEEDS.FEED_ID FROM FEEDS INNER JOIN FEED_TAG on FEED_TAG.FEED_ID=FEEDS.FEED_ID";

$count = 0;
$params = [];
$arr = [];
$feedQueryWhere = "";
foreach( $tags as $tag ) {
   $feedQueryWhere .= "FEED_TAG.TAG=? OR ";
   $count++;
   $params[] = $tag;
}
if( $count > 0 ) {
    $feedQueryWhere = rtrim($feedQueryWhere," OR ");
    $feedQuery .= (" WHERE (".$feedQueryWhere.")");
}


$rawQuery = "select distinct DATASTREAMS.UID as DS_UID, DATASTREAMS.FEED_ID, DATASTREAMS.UNITS AS UNITS, DATASTREAMS.SYMBOL AS SYMBOL, FEEDS.TITLE AS FEED_TITLE FROM DATASTREAMS INNER JOIN DATASTREAM_TAG on DATASTREAM_TAG.DS_UID=DATASTREAMS.UID INNER JOIN FEEDS on DATASTREAMS.FEED_ID=FEEDS.FEED_ID";

$rawQueryWhere = "";
foreach( $tags as $tag ) {
   $rawQueryWhere .= "DATASTREAM_TAG.TAG=? OR ";
   $params[] = $tag;
}


if( $count > 0 ) {
    $rawQueryWhere .= (" DATASTREAMS.FEED_ID IN (".$feedQuery.")");

    $rawQuery .= (" WHERE (".$rawQueryWhere.")");

    trigger_error("SQL:   ".$rawQuery, E_USER_NOTICE);

    $results = $_db->rawQuery($rawQuery,$params);

    foreach ($results as $row ) {
        $arr[] = '{"datastream" : "'.$row['DS_UID'].'","feed_title" : "'.$row['FEED_TITLE'].'", "units" : "'.$row['UNITS'].'", "symbol" : "'.$row['SYMBOL'].'"}';
    }
}
//

$output = "[".join(",",$arr)."]";
echo $output;
?>
