<?php
if ($_SESSION['level'] == 'Admin') { 
  $sql = "SELECT * FROM class  WHERE class_id = :rowid";   
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':rowid', $_GET['rowid']);
	$stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);	 
  
  $sql2 = "SELECT * FROM course";   
  $stmt2 = $conn->prepare($sql2);
	$stmt2->execute();
  $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);	 

  $sql3 = "SELECT * FROM trainer";   
  $stmt3 = $conn->prepare($sql3);
	$stmt3->execute();
  $result3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);	 

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
      <select name="trainerid" required>
        <?php   
        echo '<option value="'. $result['trainer_id'] .'" selected>Current Trainer ID: '. $result['trainer_id'].'</option>';
        foreach($result3 as $row3) {
          echo '<option value="'.$row3['trainer_id'].'">'.$row3['trainer_id'].' - '.$row3['name'].' '.$row3['surname'].'</option>';
        }
        ?>  
      </select>
      <label>Course ID:</label>
      <select name="courseid" required>
        <?php   
        echo '<option value="'. $result['course_id'] .'" selected>Current Course ID: '. $result['course_id'].'</option>';
        foreach($result2 as $row2) {
          echo '<option value="'.$row2['course_id'].'">'.$row2['course_id'].' - '.$row2['course_name'].'</option>';
        }
        ?>  
      </select>
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