<?php

require 'common.php';

if($_POST[pw]!=$_POST[rpw]){
    echo "<script>alert('password does not match');</script>";
    exit();
}
$con = connectSQL();

$result = mysqli_query($con,"insert into usr value('{$_POST[name]}','{$_POST[pw]}')");

errInfo($con);
mysqli_close($con);

?>
