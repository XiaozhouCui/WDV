<?php 

$sql = "SELECT * FROM login INNER JOIN instructor ON login.login_id = instructor.login_id";    
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($stmt->rowCount()< 1 ) {
  echo "The instructor database is empty.";
} else {
  foreach($result as $row) {?>
    <div class="holder">
      <?php echo $row['name'].' '.$row['surname']; ?><br>
      <?php echo '<p>'. $row['access_level'].'</p>'; ?><br>
      <a href="?pageid=edittrainer&rowid=<?php echo $row['login_id']; ?>">Edit</a><br>
      <a href="?pageid=deletetrainer&rowid=<?php echo $row['login_id']; ?>">Delete</a><br><br>
    </div>  
    <?php
  }
}
?>