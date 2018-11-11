<?php
$files = scandir('../view/images/');

$output = '<div class="bigholder">';

if(false !== $files) {
  foreach($files as $file) {
    if('.' !=  $file && '..' != $file) {
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