<?php
try{
 $dbh = new PDO('mysql:host=localhost;dbname=gps', 'root', '111111', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

$fh =fopen("E:\\gps3.asc", 'r') ;
$count=0;
while($count<15){
//	$result=mysql_query("select g_id from gps")

	$id= fgets($fh);
	$long = fgets($fh);
	$lag = fgets($fh);

	//if($result)
	$stmt = $dbh->prepare("update gps set g_longitude = $long,  g_lagitude=$lag, g_time=now() where g_id=2");
//	$stmt = $dbh->prepare("insert into gps  values(1,'789977','486666',now())");

	$stmt->execute();
	$count++;

	echo "$id$long$lag";

	flush();
	sleep(2);
}

fclose($fh);

 $dbh = null;  
 }
   catch(PDOExceprion $e){      // 오류 처리
      echo $e->getMessage();
   }
?>

