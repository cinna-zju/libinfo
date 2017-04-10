<?php
function output($result)
{
    if($result==false) return;
    while( $row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
        foreach($row as $k=>$value){
            echo $k.":".$row[$k].", ";
        }
        echo "</br>";
    }

}
$con = mysqli_connect("127.0.0.1","root","951028","test2") or die ("could not connect to mysql");
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
if($_POST[bno]==""){
    $result = mysqli_query($con,"select * from book where bno in
                                        (select bno from borrow where cno = '{$_POST[cno]}')");
    output($result);
    die();
}

$result = mysqli_query($con, "select * from borrow where bno='{$_POST[bno]}' and cno='{$_POST[cno]}'");
$num = mysqli_num_rows($result);
if($num == 0)
    die ("no record");

if(mysqli_query($con, "update book set stock=stock+1 where bno='{$_POST[bno]}'")){
    mysqli_query($con, "delete from borrow where bno='{$_POST[bno]}' and cno='{$_POST[cno]}'");
    echo "book returned succesfully";
}else{
    echo mysqli_error($con);
}

mysqli_close($con);

?>
