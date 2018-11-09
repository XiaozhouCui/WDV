<?php

//upload.php

$folder_name = '../view/images/';

if(!empty($_FILES))
{
 $temp_file = $_FILES['file']['tmp_name'];
 $location = $folder_name . $_FILES['file']['name'];
 move_uploaded_file($temp_file, $location);
}

if(isset($_POST["name"]))
{
 $filename = $folder_name.$_POST["name"];
 unlink($filename);
}

$result = array();

$files = scandir('../view/images/');

$output = '<div class="row">';

if(false !== $files)
{
 foreach($files as $file)
 {
  if('.' !=  $file && '..' != $file)
  {
   $output .= '
   <div class=holder>
    <img src="view/images/'.$file.'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
    <button type="button" class="btn btn-link remove_image" id="'.$file.'">Remove</button>
   </div>
   ';
  }
 }
}
$output .= '</div>';
echo $output;

?>
