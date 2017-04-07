<?php
$con = mysqli_connect("127.0.0.1","root","951028") or die ("could not connect to mysql");

mysqli_select_db($con, "test2") or die ("no database");

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    //you need to exit the script, if there is an error
    exit();
}


$result = mysqli_query($con, "select * from book
            where bno = '{$_POST[word]}'
                or category = '{$_POST[word]}'
                or title = '{$_POST[word]}'
                or press = '{$_POST[word]}'
                or author = '{$_POST[word]}'");

echo "bno, category, title, press, year, author, price</br>";
if($result == FALSE)
    echo "nothing found";
else
    while( $row = mysqli_fetch_row($result)) {
        foreach($row as $value){
            echo $value.", ";
        }
        echo "</br>";
    }

mysqli_close($con);

?>
