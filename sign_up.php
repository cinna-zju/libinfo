<?php

require 'common.php';

if($_POST[pw]!=$_POST[rpw]){
    echo "<script>alert('password does not match');</script>";
    echo "<script>parent.location.href='./sign_up.html';</script>";
    exit();
}
$con = connectSQL();
$currentTime = new DateTime();

$result = mysqli_query($con,"insert into usr value('{$_POST[name]}','{$_POST[pw]}','{$currentTime->format('Y-m-d H:i:s')}')");

$no = mysqli_errno($con);
if ($no){
    echo "ERROR: {$no}</br>";
    if ($no == 1062) echo "User already exists";
}else{
    echo "<script>alert('registered successfully')</script>";
    echo "<script>parent.location.href='./index.html';</script>";
}

mysqli_close($con);

?>
