<?php include 'menu.php'; ?>
<form action="wpis.php" method="post">
Username:<br>
<input type="text" name="Username" required="required"> <br>
Passowrd:<br>
<input type="password" name="Password" required="required"> <br><br>
Write your post here:  <br>
<textarea name="Content" rows="10" cols="60"></textarea> <br><br>
<input type = "text" id="date1" name="date" onchange="correctDate()">
<input type = "text" id="time1" name="time" onchange="correctTime()"><br><br>
<div id="attachments">
	<input type="file" name="Attachment1" onclick="newAttachField()"><br>
</div>
<br>
<input type="submit" name="Post" value="Send post">
<input type="reset" name="Reset" value="Reset">
</form>

<script type="text/javascript" src="skrypt.js"></script>
</body>
</html>
