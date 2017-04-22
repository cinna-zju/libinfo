<?php
require 'common.php'
$con = connectSQL();

if (mysqli_query($con, "delete from card where cno = '{$_POST[cno]}'")){
    echo "<script>alert('card deleted succeed!')</script>";
}else {
    echo mysqli_error($con);
}

mysqli_close($con);

?>
