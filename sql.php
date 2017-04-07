<?php
$con = mysqli_connect("localhost:3306","root","951028", "library");
if (!$con)
  {
      die('Could not connect:');
  }

 $result = mysqli_query($con, "select * from teachers");

 while($row = mysqli_fetch_array($result))
 {
     echo $row['id']." ".$row['name'];
     echo "\n";

 }

mysqli_close($con);
// some code


function addCard($cno, $name, $dpt, $type)
{
    mysqli_query($con, "insert into card values({$cno},{$name},{$dpt},{$type})");

}
?>
