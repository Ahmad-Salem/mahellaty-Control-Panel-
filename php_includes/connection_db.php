<?php

	define("LOCALSERVER", "localhost");
	define("USERNAME", "root");
	define("PASS", "");
	define("DBNAME", "mahalaty");


	$connect=mysqli_connect(LOCALSERVER,USERNAME,PASS,DBNAME);


	$sSQL= 'SET CHARACTER SET utf8'; 
	mysqli_query($connect,$sSQL);

// 	if($connect)
// 	{
// 	   echo "ok";
// 	}else{
// 	   echo "not ok";
// }
?>