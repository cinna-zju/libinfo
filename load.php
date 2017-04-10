<?php

if (($_FILES["file"]["type"] == "text/plain")
&& ($_FILES["file"]["size"] < 2000))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Error: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] ) . "byte<br />";
    echo "Stored in: " . $_FILES["file"]["tmp_name"]."</br>";
    }
  }
else
  {
  echo "Invalid file";
  }

$contents = file_get_contents($_FILES["file"]["tmp_name"]);
#echo $contents;
$row = explode("\n", $contents);

$con = mysqli_connect("127.0.0.1","root","951028","test2") or die ("could not connect to mysql");

foreach($row as $value){
    $value = substr($value,1,strlen($value)-2);
    if($value != ""){
        $w = explode(",",$value);
        if( $res = mysqli_query($con, "insert into book values('{$w[0]}','{$w[1]}','{$w[2]}','{$w[3]}',
                                        {$w[4]},'{$w[5]}',{$w[6]},{$w[7]},{$w[8]})")){

            echo $value." inserted</br>";
        }else{
            echo mysqli_error($con)."</br>";
            echo "insert into book values('{$w[0]}','{$w[1]}','{$w[2]}','{$w[3]}',
                                        {$w[4]},'{$w[5]}',{$w[6]},{$w[7]},{$w[8]})</br>";
        }
    }

}
