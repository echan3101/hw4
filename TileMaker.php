<?php


// var_dump($argv);
// echo $argv[1];
//imagecreatefromjpeg($argv[1]);
// Get the arguments from command line
// loop through each element in the $argv array

//If there isn't an images folder, create it and blank.jpg
// if (!file_exists('images/')) {
//     mkdir('images/', 0777, true);
//     createBlank();
// }
//
// if(!file_exists("blank.jpg")){
//     createBlank();
// }

// if(file_exists("dog.jpg")){
//     header('Content-Type: image/jpeg');
//
//     $im = @imagecreatefromjpeg ("dog.jpg")
//            or die('Cannot Initialize new GD image stream');
//
//      //Display on browser
//      imagejpeg($im);
//
//      imagedestroy($im);
// }

// function createBlank(){
//   header('Content-Type: image/jpeg');
//
//   $im = @imagecreatetruecolor(200, 200)
//          or die('Cannot Initialize new GD image stream');
//
//    //Display on browser
//    imagejpeg($im);
//
//    //Save to images folder
//    imagejpeg($im, 'images/blank.jpg');
//
//    imagedestroy($im);
// }



//If file path is given, create and resize the image
if (!empty($argv[1])) {

  $temp = 'images/temp.jpg';

  //save an image as "temp.jpg" given its file path
  $newImg = imagecreatefromjpeg($argv[1]);
  imagejpeg($newImg, $temp);

  createAll();
  create16tiles();

  //Delete temp.jpg
  unlink($temp);
}

//Resize temp.jpg to all.jpg at 800px x 800px
function createAll(){

  $fileName = "images/temp.jpg";

  if(file_exists($fileName)){

    list($width, $height) = getimagesize($fileName);

    $image_p = imagecreatetruecolor(800, 800);
    $image = imagecreatefromjpeg($fileName);
    imagecopyresampled($image_p, $image, 0,0,0,0, 800, 800, $width, $height);

    imagejpeg($image_p, 'images/all.jpg');
    imagedestroy($image_p);

  }

  else {
    echo "image does not exist";
  }
}

// Creates 16 200x200px tiles from an 800x800px image all.jpg
function create16tiles(){

  $file = "images/all.jpg";

  if(file_exists($file)){

    $image = imagecreatefromjpeg($file);
    $i = 0;

    while($i < 4){
      for ($j = 0; $j <4; $j++){
        $image_p = imagecrop($image, ['x' => $j*200, 'y' => $i*200, 'width' => 200, 'height' => 200]);
        imagejpeg($image_p, 'images/'. $i . $j .'.jpg');
        imagedestroy($image_p);

      }
       $image_y += 200;
       $i++;

    }
  }
}

// Creates 256 200px x 200px images of name a four digit number
// where each digit is between 0 to 3 inclusive
function create256tiles(){
  $temp = "images/temp.jpg";

  if(file_exists($temp)){

    list($width, $height) = getimagesize($temp);

    $image_p = imagecreatetruecolor(800, 800);
    $image = imagecreatefromjpeg($temp);
    imagecopyresampled($image_p, $image, 0,0,0,0, 800, 800, $width, $height);

    imagejpeg($image_p, 'images/all.jpg');
    imagedestroy($image_p);
  }

  $file = "images/all.jpg";

  if(file_exists($file)){

    $image = imagecreatefromjpeg($file);
    $i = 0;

    while($i < 4){
      for ($j = 0; $j <4; $j++){
        $image_p = imagecrop($image, ['x' => $j*200, 'y' => $i*200, 'width' => 200, 'height' => 200]);
        imagejpeg($image_p, 'images/'. $i . $j .'.jpg');
        imagedestroy($image_p);

      }
       $image_y += 200;
       $i++;

    }
  }
}
?>
