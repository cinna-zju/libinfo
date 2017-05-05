<?php
require 'common.php';

$con = connectSQL();

if($_POST[bno]==""){
    $result = mysqli_query($con,"select * from book where bno in
                    (select bno from borrow where cno = '{$_POST[cno]}')");
    errInfo($con);
    output($result);
    die();
}

$result = mysqli_query($con, "select * from borrow where bno='{$_POST[bno]}' and cno='{$_POST[cno]}'");
errInfo($con);
$num = mysqli_num_rows($result);
if($num == 0)
    die ("no record");

if(mysqli_query($con, "update book set stock=stock+1 where bno='{$_POST[bno]}'")){
    mysqli_query($con, "delete from borrow where bno='{$_POST[bno]}' and cno='{$_POST[cno]}'");

    echo "<script>alert('book returned successfully!')</script>";
}else{
    errInfo($con);
}

mysqli_close($con);

?>
