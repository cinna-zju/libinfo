<?php
function output($result)
{
    if($result==false) return;
    while( $row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
        foreach($row as $k=>$value){
            echo $k.":".$row[$k].", ";
        }
        echo "</br>";
    }

}
$con = mysqli_connect("127.0.0.1","root","951028","test2") or die ("could not connect to mysql");

$word = explode(",", $_POST[word]);
if($word[1]!=""){
    $result1 = mysqli_query($con, "select * from book where year >= {$word[0]} AND year <= {$word[1]}
                                    OR (price >={$word[0]} AND price <={$word[1]})");
                    #echo "select * from book where year >= {$word[0]} AND year <= {$word[1]}";
    if($result1 ==false) die (mysqli_error($con));
    else{
        $r1 = mysqli_num_rows($result1);
        if($r1 != 0)
            output($result1);
    }

}else{
    $result2 = mysqli_query($con, "select * from book
                where bno = '{$_POST[word]}'
                    or category = '{$_POST[word]}'
                    or title = '{$_POST[word]}'
                    or press = '{$_POST[word]}'
                    or author = '{$_POST[word]}'
                    or year = {$_POST[word]}
                    or price  ={$_POST[word]}");
    if($result2 == false) die (mysqli_error($con));
    else{
        $r2 = mysqli_num_rows($result2);
        if($r2 != 0)
            output($result2);
    }
}

if($r1+$r2==0)
    echo "NOTHING FOUND";
mysqli_close($con);

?>
