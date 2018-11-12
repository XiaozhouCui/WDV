<?php
$ds = DIRECTORY_SEPARATOR;
$path1 = 'view'.$ds.'images'.$ds;
$path2 = '..'.$ds.'view'.$ds.'images'.$ds;
$abspath = dirname(__FILE__).$ds.$path1;

if(!empty($_FILES)) {
  $temp_file = $_FILES['file']['tmp_name'];
  $location = $path2 . $_FILES['file']['name'];
  move_uploaded_file($temp_file, $location);
}

$files = scandir($path2);
$output = '<div class="bigholder">';
if(false !== $files) {
  foreach($files as $file) {
    if('.' !=  $file && '..' != $file) {
      $output .= '
        <div class=holder>
          <img src="'.$path1.$file.'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
          <button type="button" class="btn btn-link remove_image" id="'.$file.'">Remove</button>
        </div>
      ';
    }
  }
}
$output .= '</div>';
echo $output;

if(isset($_POST["name"]))
{
  $filename = $path2.$_POST["name"];
  unlink($filename);
}
?>