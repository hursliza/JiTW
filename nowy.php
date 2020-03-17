<?php
	include 'menu.php';
	$BlogName=$_POST["BlogName"];
	$Username=$_POST["Username"];
	$Password=$_POST["Password"];
	$Discr=$_POST["Discr"];
	$Passwd=md5($Password);

	if (!is_dir("./blogs/".$BlogName)){
		mkdir("./blogs/".$BlogName, 0777, true);
		$info = fopen("./blogs/".$BlogName."/info.txt", 'w');
		fputs($info, $Username."\n");
		fputs($info, $Passwd."\n");
		fputs($info, $Discr."\n");
		echo 'Blog created successfully!';
		
		fclose($info);
	}
	else {
		echo 'Unable to create the blog. This blog already exists.';
	}

?>
