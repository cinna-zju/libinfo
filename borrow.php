<?php
function check($con)
{
    $result1 = mysqli_query($con, "select * from card where cno='{$_POST[cno]}'");
    $num1 = mysqli_num_rows($result1);
    $result2 = mysqli_query($con, "select * from book where bno='{$_POST[bno]}'");
    $num2 = mysqli_num_rows($result2);
    if($num1==0)
        die("invalid card ID");
    if($num2==0)
        die("invalid book ID");
}

$con = mysqli_connect("127.0.0.1","root","951028") or die ("could not connect to mysql");

mysqli_select_db($con, "test2") or die ("no database");

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    //you need to exit the script, if there is an error
    exit();
}

check($con);

if($_POST[bno]==""){
    $result = mysqli_query($con,"select * from book where bno in
                                        (select bno from borrow where cno = '{$_POST[cno]}')");
    output($result);
    die();
}

$result = mysqli_query($con, "select stock from book where bno='{$_POST[bno]}'");
$arr = mysqli_fetch_array($result);
if ($arr[stock]>0){
    date_default_timezone_set('Asia/Shanghai');
    $bt = date(Ymd);
    $rt = date(Ymd,strtotime("+40 day"));

    //mysqli_autocommit($con, FALSE);??????

    if(mysqli_query($con, "insert into borrow values('{$_POST[cno]}','{$_POST[bno]}',{$bt},{$rt})")){
        mysqli_query($con, "update book set stock=stock-1 where bno='{$_POST[bno]}'");
        echo "borrow successfully";

    }
    else echo mysqli_error($con);
    #echo "insert into borrow values('{$_POST[cno]}','{$_POST[bno]}',{$bt},{$rt})";
}else{
    echo "NO STOCK</br>";
    $rlt = mysqli_query($con,"select min(return_date) from borrow where bno='{$_POST[bno]}'");
    if($rlt==false) die(mysqli_error($con));
    $row = mysqli_fetch_array($rlt, MYSQL_ASSOC);
    foreach($row as $k=>$value){
        echo $k.":".$row[$k].", ";
    }
}

mysqli_close($con);

?>
