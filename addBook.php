<?php
#test
#1,1,1,1,1,
#

function update($con)
{
    foreach($_POST as $k=>$value){
        if($_POST[$k]!=""){
            if($k=="category"||$k=="title"||$k=="press"||$k=="author"){
                mysqli_query($con, "update book set {$k}='{$_POST[$k]}' where bno='{$_POST[bno]}'");
            }
            if($k=="year"||$k=="price"||$k=="total"||$k=="stock"){
                mysqli_query($con, "update book set {$k}={$_POST[$k]} where bno='{$_POST[bno]}'");
            }
        }
    }
}

function check($con)
{
    $result = mysqli_query($con, "select * from book where bno='{$_POST[bno]}'");
    $arr = mysqli_fetch_array($result, MYSQL_ASSOC);
    foreach($arr as $k=>$value){
        echo $k.": ".$arr[$k]."    ";
    }
    echo "</br>";

}

$con = mysqli_connect("127.0.0.1","root","951028") or die ("could not connect to mysql");

mysqli_select_db($con, "test2") or die ("no database");

if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$result = mysqli_query($con,"select bno from book where bno='{$_POST[bno]}'");
if($result==FALSE) die("input error");
else{
    $isexist = mysqli_num_rows($result);
    if( $isexist ){
        echo "modifying</br>";
        echo "before:";
        check($con);
        update($con);
        echo "after:";
        check($con);
        if(mysqli_errno($con)==0)
            echo "item modified successfully</br>";
        else
            echo mysqli_error($con);
    }else{
        mysqli_query($con, "insert into book(bno) values('{$_POST[bno]}')");
        update($con);
        if(mysqli_errno($con)==0)
            echo "item created successfully</br>";
        else
            echo mysqli_error($con);
    }
}

mysqli_close($con);

?>
