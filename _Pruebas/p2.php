

<?php

$imagefile = '../public/uploads/imagenes/WMIGUE-SMALL-62b7c59f21d63.png';


function icreate($filename)
{
  $isize = getimagesize($filename);
  if ($isize['mime']=='image/jpeg')
    return imagecreatefromjpeg($filename);
  elseif ($isize['mime']=='image/png')
    return imagecreatefrompng($filename);
  
}
  

function resizeAspectH($image, $height)
{
  $aspect = imagesx($image) / imagesy($image);
  $width = $height * $aspect;
  $new = imageCreateTrueColor($width, $height);

  imagecopyresampled($new, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));
  return $new;
}

$imgh = icreate($imagefile);
$imgr = resizeAspectH($imgh, 520);

header('Content-type: image/jpeg');
imagejpeg($imgr);
?>

