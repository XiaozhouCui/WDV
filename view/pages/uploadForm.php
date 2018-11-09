<?php
if ($_SESSION['level'] == 'Admin' || $_SESSION['level'] == 'Trainer' ) { 
	$sql = "SELECT * FROM class WHERE class_id = '{$_GET['classid']}'"; 
	$stmt = $conn->prepare($sql);
	$stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);	 
  
  if($result['status'] == "Completed" || $result['status'] == "Cancelled") {
    echo "This class is no longer active, file upload is not available.";
    echo "<a href='?pageid=showclass'>Go back</a>";
  } else {  ?> 	  
    <div class="bigholder">
    <h2>Upload file to Class <?php echo $result['class_id'] ?></h2>
    <form action="?pageid=uploading" method="post" enctype="multipart/form-data">
      <fieldset>
        <legend>Upload Learning Materials</legend>
        <label>Class ID: <?php echo $result['class_id'] ?></label>
        <input type="hidden" name="classid" value="<?php echo $result['class_id'] ?>"required><br><br>
        <label>Status: <?php echo $result['status']?></label><br><br>
        <label>Select a file:</label>
        <input type="file" name="contentfile"><br><br>
        <input type="submit" value="Upload"> 
        <input type="button" onclick="location.href='?pageid=showclass';" value="Cancel" />
      </fieldset>
    </form>
    </div><?php
  }
} else {
	echo '<aside>Only Trainer and Admin can upload files.</aside>';
	echo "<aside><a href='index.php'>Go back</a></aside>";
}
?>