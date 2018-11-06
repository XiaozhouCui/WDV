<h2>Confirmation</h2>
<form action="?pageid=deletingfile" method="post">
	<fieldset>		
    <p>Are you sure you wan to delete this file?</p>
    <input type="hidden" name="rowid" value="<?php echo $_GET['rowid'] ?>"><br>
    <input type="submit" value="Yes">
    <input type="button" onclick="location.href='index.php';" value="Cancel" />
	</fieldset>
</form>