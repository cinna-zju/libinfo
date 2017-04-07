<?php
$con = mysqli_connect("127.0.0.1","root","951028") or die ("could not connect to mysql");

mysqli_select_db($con, "test2") or die ("no database");

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    //you need to exit the script, if there is an error
    exit();
}

$result = mysqli_query($con, "select stock from book where bno='{$_POST[bno]}'");
$arr = mysqli_fetch_array($result);
if ($arr[stock]>0){
    mysqli_query($con, "update book set stock=stock-1 where bno='{$_POST[bno]}'");
    date_default_timezone_set('Asia/Shanghai');
    $bt = date(Ymd);
    $rt = date(Ymd,strtotime("+40 day"));


    if(mysqli_query($con, "insert into borrow values({$_POST[cno]},{$_POST[bno]},{$bt},{$rt})")){
        echo "borrow successfully";
    }
}

mysqli_close($con);

?>
