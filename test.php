<?php

	$datetime1 = date_create('2018-11-01');
	$datetime2 = date_create('2009-10-13');
	$interval = date_diff($datetime1, $datetime2);
	echo $interval->format('%a');
?>