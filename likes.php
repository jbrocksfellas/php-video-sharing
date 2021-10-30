<?php 

require('includes/dbconnection.php');
$table = 'videos';
if(isset($_POST['likes'])) {
    $likes = mysqli_real_escape_string($conn, $_POST['likes']);
    $sno = $_POST['sno'];
    $sql = "UPDATE `$table` SET `likes` = '$likes' WHERE `$table`.`sno` = $sno";
    $result = mysqli_query($conn, $sql);
    if($result) {
        echo "success";
    } else {
        echo "failed";
    }
}

if(isset($_POST['moons'])) {
    $moons = mysqli_real_escape_string($conn, $_POST['moons']);
    $sno = $_POST['sno'];
    $sql = "UPDATE `$table` SET `moons` = '$moons' WHERE `$table`.`sno` = $sno";
    $result = mysqli_query($conn, $sql);
    if($result) {
        echo "success";
    } else {
        echo "failed";
    }
}

?>