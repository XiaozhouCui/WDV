<?php
if ($_SESSION['level'] == 'Admin') { 
	$sql = "SELECT * FROM course WHERE course_id = '{$_GET['rowid']}'"; 
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);	 
	?>  
  
  <form class="needs-validation" action="?pageid=editingcourse" method="post" novalidate>
  <h2>Edit Course Form</h2>
    <input type="hidden" name="rowid" value="<?php echo $_GET['rowid'] ?>">

    <div class="form-group">
      <label>Course name:</label>
      <input type="text" name=coursename class="form-control" value="<?php echo $result['course_name'] ?>"required>
      <div class="invalid-feedback">
        Please provide a valid course name
      </div>
    </div>

    <div class="form-row">
      <div class="col-md-6 mb-3">
        <label>Course Level:</label>		
        <select name="level" class="form-control" >
          <option value="Low" <?php echo ($result['course_level'] == "Low" ? 'selected="selected"': ''); ?>>Entry Level</option>
          <option value="Medium" <?php echo ($result['course_level'] == "Medium" ? 'selected="selected"': ''); ?>>Medium Level</option>
          <option value="High" <?php echo ($result['course_level'] == "High" ? 'selected="selected"': ''); ?>>High Level</option>
        </select>
        <div class="invalid-feedback">
          Please select course level
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <label>Price:</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text">$</div>
          </div>
          <input type="number" name="price" class="form-control" step="0.01" min="0" value="<?php echo $result['price'] ?>" required>
          <div class="invalid-feedback">
            Please provide a valid amount
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label>Description:</label>
      <textarea name="description" class="form-control" rows="5" required><?php echo $result['description'] ?></textarea>
    </div>

    <input type="hidden" name="actiontype" value="editcourse"/>
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="button" class="btn btn-primary" onclick="location.href='?pageid=showcourse';">Cancel</button>

  </form>
	<?php
} else {
	echo '<aside>Only administrator can edit courses.</aside>';
	echo "<aside><a href='index.php'>Go back</a></aside>";
}
?>