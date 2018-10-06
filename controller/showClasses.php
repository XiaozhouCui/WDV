<?php 

$sql = "SELECT class.class_id, class.start_date, class.end_date, class.status, course.course_name, instructor.name FROM class INNER JOIN instructor ON class.instructor_id=instructor.instructor_id INNER JOIN course ON class.course_id=course.course_id";    
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($stmt->rowCount()< 1 ) {
  echo "The course database is empty.";
} else {
  foreach($result as $row) {?>
    <div class="holder">      
      <?php echo '<p>Start date: '. $row['start_date'].'</p>'; ?>
      <?php echo '<p>Start date: '. $row['end_date'].'</p>'; ?>
      <?php echo '<p>Status: '. $row['status'].'</p>'; ?>
      <?php echo '<p>Instructor: '. $row['name'].'</p>'; ?>
      <?php echo '<p>Topic: '. $row['course_name'].'</p>'; ?><br>
      <a href="?pageid=showstudent&rowid=<?php echo $row['class_id']; ?>">Show Students</a><br>
      <a href="?pageid=editclass&rowid=<?php echo $row['class_id']; ?>">Edit</a><br>
      <a href="?pageid=deleteclass&rowid=<?php echo $row['class_id']; ?>">Delete</a><br><br>
    </div>  
    <?php
  }
}
?>