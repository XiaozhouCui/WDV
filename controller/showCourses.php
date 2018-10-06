<?php 

$sql = "SELECT course_id, course_name, course_level, price FROM course";    
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($stmt->rowCount()< 1 ) {
  echo "The course database is empty.";
} else {
  foreach($result as $row) {?>
    <div class="holder">
      <?php echo '<p>'. $row['course_name'].'</p>'; ?><br>
      <?php echo '<p>Course Level: '. $row['course_level'].'</p>'; ?><br>
      <?php echo '<p>Price: $'. $row['price'].'</p>'; ?><br>
      <a href="?pageid=editcourse&rowid=<?php echo $row['course_id']; ?>">Edit</a><br>
      <a href="?pageid=deletecourse&rowid=<?php echo $row['course_id']; ?>">Delete</a><br><br>
    </div>  
    <?php
  }
}
?>