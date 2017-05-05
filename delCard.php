<?php
require 'common.php';

$con = connectSQL();

$res = mysqli_query($con, "select * from card where cno = '{$_POST[cno]}'");
$arr = mysqli_fetch_row($res);
if($arr == FALSE){
    echo "NO CARD RECORD";
    exit();
}
if (mysqli_query($con, "delete from card where cno = '{$_POST[cno]}'")){
    echo "<script>alert('card deleted successfully!')</script>";
}else {
    errInfo($con);
}

mysqli_close($con);

?>
