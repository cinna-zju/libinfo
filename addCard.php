<?php
$con = mysqli_connect("127.0.0.1","root","951028") or die ("could not connect to mysql");

mysqli_select_db($con, "test2") or die ("no database");

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    //you need to exit the script, if there is an error
    exit();
}

  echo $_POST[cno], $_POST[name], $_POST[dpt], $_POST[type];
  if (mysqli_query($con, "insert into card values({$_POST[cno]},{$_POST[name]},{$_POST[dpt]},{$_POST[type]})"))
  {
      echo "succeed!";
  }
  #mysqli_query($con, "insert into card values({$cno},{$name},{$dpt},{$type})");

mysqli_close($con);

?>
