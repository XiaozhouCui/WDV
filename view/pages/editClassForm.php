<?php
if ($_SESSION['level'] == 'Admin' || $_SESSION['level'] == 'Trainer') { 
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
  <form class="needs-validation" action="?pageid=editingclass"  method="post" novalidate>
    <input type="hidden" name="rowid" value="<?php echo $_GET['rowid'] ?>">

    <div class="form-row">
      <div class="col-md-6 mb-3">
        <label>Start Date:</label>
        <input type="date" name="startdate" class="form-control" value="<?php echo $result['start_date'] ?>" required>
        <div class="invalid-feedback">
				  Please select a start date
			  </div>
      </div>
      <div class="col-md-6 mb-3">
        <label>End Date:</label>
        <input type="date" name="enddate" class="form-control" value="<?php echo $result['end_date'] ?>" required>
        <div class="invalid-feedback">
				  Please select an end date
			  </div>
      </div>
    </div>

    <div class="form-row">
      <div class="col-md-6 mb-3">
        <label>Class Status:</label>
        <select name="status" class="form-control" >
          <option value="Enrollment Open" <?php echo ($result['status'] == "Enrollment Open" ? 'selected="selected"': ''); ?>>Enrollment Open</option>
          <option value="Enrollment Closed" <?php echo ($result['status'] == "Enrollment Closed" ? 'selected="selected"': ''); ?>>Enrollment Closed</option>
          <option value="Completed" <?php echo ($result['status'] == "Completed" ? 'selected="selected"': ''); ?>>Completed</option>
          <option value="Cancelled" <?php echo ($result['status'] == "Cancelled" ? 'selected="selected"': ''); ?>>Cancelled</option>
        </select>
        <div class="invalid-feedback">
				  Please select class status
			  </div>
      </div>
      <div class="col-md-6 mb-3">
        <label>Instructor:</label>
        <select name="trainerid" class="form-control" required>
          <?php   
          echo '<option value="'. $result['trainer_id'] .'" selected>Current Trainer ID: '. $result['trainer_id'].'</option>';
          foreach($result3 as $row3) {
            echo '<option value="'.$row3['trainer_id'].'">'.$row3['trainer_id'].' - '.$row3['name'].' '.$row3['surname'].'</option>';
          }
          ?>  
        </select>
        <div class="invalid-feedback">
				  Please select an instructor
			  </div>
      </div>
    </div>

    <div class="form-row">
      <div class="col-md-12 mb-3">
        <label>Course:</label>
        <select name="courseid" class="form-control" required>
          <?php   
          echo '<option value="'. $result['course_id'] .'" selected>Current Course ID: '. $result['course_id'].'</option>';
          foreach($result2 as $row2) {
            echo '<option value="'.$row2['course_id'].'">'.$row2['course_id'].' - '.$row2['course_name'].'</option>';
          }
          ?>  
        </select>
        <div class="invalid-feedback">
				  Please select the corresponding course
			  </div>
      </div>
    </div>

      <input type="hidden" name="actiontype" value="editclass"/>
      <button type="submit" class="btn btn-primary">Submit</button>
      <button type="button" class="btn btn-primary" onclick="location.href='?pageid=showclass';">Cancel</button>
  </form>
	<?php
} else {
	echo '<aside>Only administrator can edit classes.</aside>';
	echo "<aside><a href='index.php'>Go back</a></aside>";
}
?>