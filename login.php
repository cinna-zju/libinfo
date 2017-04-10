<?php
$user=$_POST[name];
$pw=$_POST[pw];

$con = mysqli_connect("127.0.0.1","{$user}","{$pw}","test2") or die ("could not connect to mysql");
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    //you need to exit the script, if there is an error
    exit();
}else{
    echo "login successfully!";
    $GLOBALS["flag"]=1;

}


?>
