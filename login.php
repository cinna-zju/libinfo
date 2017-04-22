<?php
require 'common.php';

$con = connectSQL();

$res = mysqli_query($con, "select pw from usr where name='{$_POST[name]}'");
if($res == false){
    mysqli_error($con);
}

else{
    $arr = mysqli_fetch_array($res, MYSQL_ASSOC);
    if($arr==null) {
        echo "<script> alert('not registered'); parent.location.href='/index.html';</script>";
        exit();
    }
    if($arr[pw]==$_POST[pw]){
        echo "<script> parent.location.href='/main.html'; </script>";

    }else{
        echo "<script> alert('wrong password'); parent.location.href='/index.html'</script>";
        exit();
    }

}






?>
