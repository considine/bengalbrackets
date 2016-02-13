<?php
	include ("database.php");
	$sql = "INSERT INTO  `bengalbr_Picks`.`fighter_info` (
`fID` ,
`name` ,
`nickname` ,
`song` ,
`bio` ,
`quote` ,
`netid` ,
`hometown` ,
`weight_class` ,
`bye` ,
`url` ,
`seed`
)
VALUES (
NULL ,  'BYE',  '',  '',  '',  '',  '',  '',  'Heavyweight',  '0',  '',  '20'
);
";
	$results = $db->query($sql);
	echo "hi";



?>