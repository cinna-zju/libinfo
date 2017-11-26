<?php
require 'common.php';

$con = connectSQL();

$res = mysqli_query($con, "select pw from usr where name='{$_POST[name]}'");
# echo "<script> alert('{$_POST[name]}');</script>";
if($res == false){
    errInfo($con);
}

else{
    $arr = mysqli_fetch_row($res);
    if($arr==null) {
        echo "<script> alert('not registered'); parent.location.href='./index.html';</script>";
        exit();
    }
    if($arr[0]==$_POST[pw]){
        echo "<script> parent.location.href='./main.html'; </script>";

    }else{
	echo "<script>alert('$arr[1],$_POST[pw]');</script>";
        echo "<script> alert('wrong password'); parent.location.href='./index.html'</script>";
        exit();
    }

}






?>
