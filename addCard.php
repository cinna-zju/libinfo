<?php
require 'common.php';

$con = connectSQL();

$result = mysqli_query($con,"select cno from card where cno='{$_POST[cno]}'");
errInfo($con);

$isexist = mysqli_num_rows($result);
if( $isexist ){
    echo "modifying</br>before:";
    $result = mysqli_query($con, "select * from card where cno='{$_POST[cno]}'");
    errInfo($con);
    output($result);

    update($con, $_POST, 'card');
    $result = mysqli_query($con, "select * from card where cno='{$_POST[cno]}'");
    echo "</br>after:";
    errInfo($con);
    output($result);
    echo "card modified successfully</br>";

}else{
    mysqli_query($con, "insert into card(cno) values('{$_POST[cno]}')");
    update($con,$_POST,"card");
    $result = mysqli_query($con, "select * from card where cno='{$_POST[cno]}'");
    errInfo($con);
    output($result);
    echo "card created successfully</br>";
}


mysqli_close($con);

?>
