<?php
if ($_SESSION['level'] == 'Admin') { 
  $sql = "SELECT * FROM class  WHERE class_id = :rowid";   
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':rowid', $_GET['rowid']);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);	 
  ?>  
  <h2>Update a class</h2>
  <form action="?pageid=editingclass"  method="post">
    <fieldset>
      <legend>Class details</legend>
      <input type="hidden" name="rowid" value="<?php echo $_GET['rowid'] ?>">
      <label>Start Date:</label>
      <input type="date" name="startdate" value="<?php echo $result['start_date'] ?>" required><br><br>
      <label>End Date:</label>
      <input type="date" name="enddate" value="<?php echo $result['end_date'] ?>" required><br><br>
      <label>Class Status:</label>
      <select name="status">
        <option value="Enrollment Open" <?php echo ($result['status'] == "Enrollment Open" ? 'selected="selected"': ''); ?>>Enrollment Open</option>
        <option value="Enrollment Closed" <?php echo ($result['status'] == "Enrollment Closed" ? 'selected="selected"': ''); ?>>Enrollment Closed</option>
        <option value="Completed" <?php echo ($result['status'] == "Completed" ? 'selected="selected"': ''); ?>>Completed</option>
        <option value="Cancelled" <?php echo ($result['status'] == "Cancelled" ? 'selected="selected"': ''); ?>>Cancelled</option>
      </select><br><br>
      <label>Instructor ID:</label>
      <input type="text" name="trainerid" value="<?php echo $result['trainer_id'] ?>" required><br><br>
      <label>Course ID:</label>
      <input type="text" name="courseid" value="<?php echo $result['course_id'] ?>" required><br><br>
      <input type="hidden" name="actiontype" value="editclass"/>
      <input type="submit">
      <input type="button" onclick="location.href='?pageid=showclass';" value="Cancel" />
    </fieldset>
  </form>
	<?php
} else {
	echo '<aside>Only administrator can edit classes.</aside>';
	echo "<aside><a href='index.php'>Go back</a></aside>";
}
?>