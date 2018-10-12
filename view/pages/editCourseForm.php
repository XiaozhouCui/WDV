<?php
if ($_SESSION['level'] == 'Admin') { 
	$sql = "SELECT * FROM course WHERE course_id = '{$_GET['rowid']}'"; 
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);	 
	?>  
  <h2>Create a new course</h2>
  <form action="controller/updateCourse.php"  method="post">
    <fieldset>
      <legend>Course details</legend>
      <input type="hidden" name="rowid" value="<?php echo $_GET['rowid'] ?>">
      <label>Course name:</label>
      <input type="text" name=coursename value="<?php echo $result['course_name'] ?>"required><br><br>
      <label>Description:</label>
      <input type="text" name=description value="<?php echo $result['description'] ?>" required><br><br>
      <label>Course Level:</label>		
      <select name="level">
        <option value="Low" <?php echo ($result['course_level'] == "Low" ? 'selected="selected"': ''); ?>>Entry Level</option>
        <option value="Medium" <?php echo ($result['course_level'] == "Medium" ? 'selected="selected"': ''); ?>>Medium Level</option>
        <option value="High" <?php echo ($result['course_level'] == "High" ? 'selected="selected"': ''); ?>>High Level</option>
      </select><br><br>
      <label>Price:</label>
      <input type="text" name=price value="<?php echo $result['price'] ?>" required><br><br>
      <input type="hidden" name="actiontype" value="editcourse"/>
      <input type="submit">
      <input type="button" onclick="location.href='index.php';" value="Cancel" />
    </fieldset>
  </form>
	<?php
} else {
	echo '<aside>Only administrator can edit courses.</aside>';
	echo "<aside><a href='index.php'>Go back</a></aside>";
}
?>