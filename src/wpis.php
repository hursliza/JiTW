<?php

	include 'menu.php';
	$Username=$_POST["Username"];
	$Password=$_POST["Password"];
	$Content=$_POST["Content"];

	$access=False;
	foreach(new DirectoryIterator("./blogs/") as $blog){
		if ($blog->isDir() && !$blog->isDot()){
			foreach (new DirectoryIterator($blog->getPathName()) as $file) {
				if ($file->getFileName()=='info.txt'){
					$info=fopen($file->getPathname(), 'r');
					$l1=rtrim(fgets($info), "\r\n");
					$l2=rtrim(fgets($info), "\r\n");
					$l3=rtrim(fgets($info), "\r\n");
					if ($Username==$l1){
						echo "User  found.\n";
						if (md5($Password)==$l2){
							echo "Access granted.\n";
							$blogPath = $blog->getPathname();
							$access = True;
							break;
						}
						else {
							echo "Incorrect password.Access denied";
						}
					}
					fclose($file->getPathname());
				}
			}
		}	
	}


	if ($access) {
		$YYYYMMDD=str_replace("-", "", $_POST["date"]);
		$HHmm=str_replace(":", "", $_POST["time"]);
		$ss=date("s");
		$Name=$YYYYMMDD.$HHmm.$ss;
		$NN =0;
		do {
			$nn=sprintf("%02d", $NN);
			$name=$Name.$nn;
			$NN++;
		} while (file_exists("$blogPath/$name"));
		$where=str_replace(" ", "", "$blogPath/$name");
		echo $where;
		$NewPost=fopen($where, 'w');
		fputs($NewPost, $Content);
		fclose($NewPost);		
		$N = 0;
		for ($i=0; $i <= sizeof($_FILES); $i++) {
			$num='file'.$i;
			$attachment=$_FILES[$num];
			$extension=pathinfo($attachment, PATHINFO_EXTENSION);
			$saveAs=$blog."/".$name.$i.".".$extension;
			echo $saveAs;
			if (!file_exists($saveAs)){
				if (move_uploaded_file($attachment['tmp_name'], $saveAs)) {
					echo 'File added successfully.';
				}
			}
			else {
				echo 'This file already exists.';
			}
		}
	}
		
?>
