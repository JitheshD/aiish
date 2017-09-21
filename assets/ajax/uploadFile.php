<?php
include_once '../lib/maincore.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$textVal = $_POST["texttest"];

echo "Test Value = $textVal";

//$audioFile = $_FILES["imgfile"];
$myImg   = $_FILES["file"]["name"];
echo "Image-$myImg";

if (isset($myImg)) {
    if (0 < $_FILES['file']['error']) {
        echo 'Error during file upload' . $_FILES['file']['error'];
    } else {
        if (file_exists("".HostRoot."assets/images/" . $_FILES['file']['name'])) {
            echo "File already exists : ".HostRoot."assets/images/" . $_FILES['file']['name'];
        } else {
            move_uploaded_file($_FILES['file']['tmp_name'], "./img/" . $_FILES['file']['name']);
            echo "File successfully uploaded : ".HostRoot."assets/images/" . $_FILES['file']['name'];
        }
    }
} else {
    echo 'Please choose a file';
}



//$audFileName = $_FILES["audFname"];
//$audioFile1 = $_POST["data"];
//$audFileName1 = $_POST["audFname"];

//echo UploadImages($_FILES, "$myImg", "".HostRoot."assets/images");

//echo getSessionMsg(); 
//echo UploadImages($_FILES, "$myImg", "./image");



//    if ( 0 < $_FILES['file']['error'] ) {
//        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
//    }
//    else {
//        move_uploaded_file($_FILES['file']['tmp_name'], './image/' . $_FILES['file']['name']);
//       echo move_uploaded_file($_FILES['file']['tmp_name'], './image/' . $_FILES['file']['name']);
//    }
//    
//    
//    move_uploaded_file(
//
//    // this is where the file is temporarily stored on the server when uploaded
//    // do not change this
//    $_FILES['file']['tmp_name'],
//
//    // this is where you want to put the file and what you want to name it
//    // in this case we are putting in a directory called "uploads"
//    // and giving it the original filename
//    './image/' . $_FILES['file']['name']
//);

?>