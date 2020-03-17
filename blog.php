<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
   <?php
	error_reporting(1);
	include 'menu.php';

	$name = "";
	if (isset($_GET['name'])) {
		$ex =$_GET['name'];
		$name = "./blogs/".$ex;
	}

        if ($name == "") {
        foreach (new DirectoryIterator("./blogs/") as $blogdir) {
             if ($blogdir->isDir() && !$blogdir->isDot()) {
                $blog = $blogdir->getFilename();
                echo sprintf("<a href=\"blog.php?name=%s\">%s</a><br/>", $blog, $blog);
             }
         }

      } else {

			$exist = false;
			if (file_exists($name)) {
				$exist = true;
				$des = fopen($name . "/info.txt", 'r');
				$line_num = 1;
				while (($line = fgets($des)) !== false) {
					if ($line_num == 1) {
						echo "<h1>Blog owner: " . $line . "</h1><h2>Description:</h2>";
					} else if ($line_num > 2) {
						echo "<p>". $line . "</p>";
					}
					$line_num ++;
				}
				fclose($des);

				$path = "/\d{16}$/";
				foreach (new DirectoryIterator($name) as $file) {
					$FILE=str_replace(" ", "", $file);
					if (!$file->isDir()  && preg_match($path, $FILE)){
						$contents = file_get_contents($file->getPathName());
						echo "<h2>Post: " . $FILE . "</h2>";
						echo "<textarea rows=10 cols=60>".$contents."</textarea>";

						$pathAtt = '/' . $file . '[1-3]/';
						foreach (new DirectoryIterator($name) as $attachment) {
							if (preg_match($pathAtt, $attachment)) {
						    		echo sprintf('Attached file: <a href="./%s/%s">%s</a><br/>', $ex, $attachment, $attachment);
						 	}
						}
						echo "<br/>";
						if (file_exists("$name/$file.k")) {
							foreach (new DirectoryIterator("$name/$file.k") as $comFile) {
								if(!$comFile->isDot() && !$comFile->isDir()){
									$readCom = fopen($comFile->getPathName(), 'r');
									$line_num = 1;
									while (($line = fgets($readCom)) !== false) {
										if ($line_num == 1) {
											echo "<i>Comment Type: </i>" . $line . "<br/>";
										} else if ($line_num == 2) {
											echo "<i>Date: </i>". $line . "<br/>";
										} else if ($line_num == 3) {
											echo "<i>Author:</i>" . $line . "<br/>";
										} else if ($line_num >= 4) {
											echo $line . "<br/>";
										}
										$line_num ++;
									}
									fclose($fic);
									echo "<br />";

								}
							}
						}
						echo sprintf('<a href="./createComment.php?name=% /%s">Comment on post</a><br />', $ex, $file);
					}
				}
      }

		if (!$exist) {
			echo "Blog not found.<br/>";
		}
	}

   ?>
</body>
</html>
