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

//  createAll();
  //create16tiles();
  create256tiles();

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
    echo "image does not exist.";
  }
}

// Creates 16 200x200px tiles from an 800x800px image all.jpg
function create16tiles(){

  $file = "images/all.jpg";

  if(file_exists($file)){

    $image = imagecreatefromjpeg($file);


    for($i=0; $i < 4; $i++){
      for ($j = 0; $j <4; $j++){
        $image_p = imagecrop($image, ['x' => $j*200, 'y' => $i*200, 'width' => 200, 'height' => 200]);
        imagejpeg($image_p, 'images/'. $i . $j .'.jpg');
        imagedestroy($image_p);

      }
       $image_y += 200;

    }
  }
}

// Creates 256 200px x 200px images of name a four digit number
// where each digit is between 0 to 3 inclusive
function create256tiles(){

    for($i = 0; $i < 4; $i++){
      for ($j = 0; $j < 4; $j++){

        $ij = "images/" . $i . $j . ".jpg";

        if(file_exists($ij)){

          list($width, $height) = getimagesize($ij);

          $image_p = imagecreatetruecolor(800, 800);
          $image = imagecreatefromjpeg($ij);

          imagecopyresampled($image_p, $image, 0,0,0,0, 800, 800, $width, $height);

          imagejpeg($image_p, "images/" . $i . $j . "temp.jpg");
          imagedestroy($image_p);

        for ($n = 0; $n < 4; $n++){
          for ($m = 0; $m < 4; $m++){

            echo $i . $j . $n . $m;
            echo "\n";

            $image_p = imagecreatetruecolor(200, 200);

            $image = imagecreatefromjpeg("images/" . $i . $j . "temp.jpg");

            imagecopyresampled($image_p, $image, 0,0, $i*200 + $n*50, $j*200 + $m*50, 800, 800, 200, 200);

          // $image_p = imagecrop($image, ['x' => $i*200 + $n*50, 'y' => $j*200 + $m*50, 'width' => 50, 'height' => 50]);
            imagejpeg($image_p, 'test/'. $i . $n . $j . $m . '.jpg');

            imagedestroy($image_p);
            imagedestroy($image);


          }
        }
      }
    }


}
}
?>
