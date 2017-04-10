<?php
$con = mysqli_connect("127.0.0.1","root","951028","test2") or die ("could not connect to mysql");

if (mysqli_query($con, "delete from card where cno = '{$_POST[cno]}'")){
    echo "card deleted succeed!";
}else {
    echo mysqli_error($con);
}

mysqli_close($con);

?>
