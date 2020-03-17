<?php
include 'menu.php';

$choice = $_POST["options"];
$nick = $_POST["nick"];
$content = $_POST["content"];
$comType = $_POST["comType"];

echo $choice;
$commentDirPath = "./blogs/".$choice;
$dir = $commentDirPath.'.k';
	if (!file_exists($dir)) {
		mkdir($dir, 0755, true);
	}
	echo "<br/>".$dir;

	$num=0;
	while (file_exists($dir."/".$num)) {
		$num++;
	}
	

	$commentFile = fopen($dir."/".$num, "w");
	fputs($commentFile, $comType."\n");
	fputs($commentFile, date('Y-m-d H:i:s')."\n");
	fputs($commentFile, $nick."\n");
	fputs($commentFile, $content."\n");
	fclose($commentFile);
?>
