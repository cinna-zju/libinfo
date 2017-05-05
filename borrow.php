<?php
require 'common.php';

function check($con)
{
    if($_POST[cno]!=""){
        $result1 = mysqli_query($con, "select * from card where cno='{$_POST[cno]}'");
        errInfo($con);
        $num1 = mysqli_num_rows($result1);
        if($num1==0)
            die("invalid card ID");
    }
    if($_POST[bno]!=""){
        $result2 = mysqli_query($con, "select * from book where bno='{$_POST[bno]}'");
        errInfo($con);
        $num2 = mysqli_num_rows($result2);
        if($num2==0)
            die("invalid book ID");
    }
    if($_POST[cno]!="" && $_POST[bno]!="")
        return 1;
}


$con = connectSQL();

$flag = check($con);

if($_POST[bno]==""){
    $result = mysqli_query($con,"select * from book where bno in
                                        (select bno from borrow where cno = '{$_POST[cno]}')");
    errInfo($con);
    output($result);
    exit();
}
if($flag==1){
    $result = mysqli_query($con, "select stock from book where bno='{$_POST[bno]}'");
    errInfo($con);
    $arr = mysqli_fetch_array($result);
    if ($arr[stock]>0){
        date_default_timezone_set('Asia/Shanghai');
        $bt = date(Ymd);
        $rt = date(Ymd,strtotime("+40 day"));

        //mysqli_autocommit($con, FALSE);??????

        if(mysqli_query($con, "insert into borrow values('{$_POST[cno]}','{$_POST[bno]}',{$bt},{$rt})")){
            mysqli_query($con, "update book set stock=stock-1 where bno='{$_POST[bno]}'");
            echo "borrow successfully</br>";
            $result = mysqli_query($con, "select * from book where bno='{$_POST[bno]}'");
            output($result);

        }
        else errInfo($con);
        #echo "insert into borrow values('{$_POST[cno]}','{$_POST[bno]}',{$bt},{$rt})";
    }else{
        echo "NO STOCK</br>";
        $rlt = mysqli_query($con,"select min(return_date) from borrow where bno='{$_POST[bno]}'");
        errInfo($con);
        $row = mysqli_fetch_array($rlt, MYSQL_ASSOC);
        foreach($row as $k=>$value){
            echo $k.":".$row[$k].", ";
        }
    }
}
mysqli_close($con);

?>
