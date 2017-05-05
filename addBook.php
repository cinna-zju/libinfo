<?php

require 'common.php';

$con = connectSQL();

$result = mysqli_query($con,"select bno from book where bno='{$_POST[bno]}'");

errInfo($con);

$isexist = mysqli_num_rows($result);
if( $isexist ){
    echo "modifying</br>before:";
    $result = mysqli_query($con, "select * from book where bno='{$_POST[bno]}'");
    errInfo($con);
    output($result);
    update($con, $_POST, 'book');
    echo "after:";
    $result = mysqli_query($con, "select * from book where bno='{$_POST[bno]}'");
    errInfo($con);
    output($result);
    echo "item modified successfully</br>";
}else{
    mysqli_query($con, "insert into book(bno) values('{$_POST[bno]}')");
    update($con, $_POST, 'book');
    $result = mysqli_query($con, "select * from book where bno='{$_POST[bno]}'");
    errInfo($con);
    output($result);
    echo "item created successfully</br>";

}


mysqli_close($con);

?>
