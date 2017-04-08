<?php
$con = mysqli_connect("127.0.0.1","root","951028") or die ("could not connect to mysql");

mysqli_select_db($con, "test2") or die ("no database");


  if (mysqli_query($con, "delete from card where cno = '{$_POST[cno]}'")){
      echo "card deleted succeed!";
  }else {
      echo mysqli_error($con);
  }
  #mysqli_query($con, "insert into card values({$cno},{$name},{$dpt},{$type})");

mysqli_close($con);

?>
