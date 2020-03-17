<?php	include 'menu.php'; ?>

<form action="koment.php" method="POST" enctype="multipart/form-data">
	<h1>Create a comment</h1>
	<select name="options">
	 <?php
		if (isset($_GET['name'])) {
                        $name =$_GET['name'];
                    }
                    if ($name == "") {
                        foreach (new DirectoryIterator("./blogs/") as $blog) {
                            if ($blog->isDir() && !$blog->isDot()) {
                                foreach (new DirectoryIterator($blog->getPathName()) as $file) {
                                		 echo "<option>" . $blog."/". basename($file) . "</option>";
		       
				}
                            }
                        }
                    }
                    else{
                        echo "<option>" . $name . "</option>";
                    }
        ?>
        </select>
        <h2>Nickname:</h2>
        <input type="text" name="nick">
        <h2>Write your comment here::</h2>
	<textarea name="content" rows="7" cols="90"></textarea></td>
        <h2>Choose the comment's type:</h2>
        <select name="comType">
                    <option>Positive</option>
                    <option>Neutral</option>
                    <option>Negative</option>
        </select> <br/><br/>
        <input type="submit" value="Send" name="comment" />
        <input type="reset" value="Reset">
</form>

</body>
</html>
