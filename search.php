<?php
require 'common.php';

$con = connectSQL();

$word = explode(",", $_POST[word]);
if($word[1]!=""){
    $result1 = mysqli_query($con, "select * from book where year >= {$word[0]} AND year <= {$word[1]}
                                    OR (price >={$word[0]} AND price <={$word[1]})");
                    #echo "select * from book where year >= {$word[0]} AND year <= {$word[1]}";
    if($result1 ==false)
        errInfo($con);
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
                    or year = '{$_POST[word]}'
                    or price  = '{$_POST[word]}'");
    if($result2 == false)
        errInfo($con);
    else{
        $r2 = mysqli_num_rows($result2);
        if($r2 != 0)
            output($result2);
    }
}

if($r1+$r2==0)
    echo "<script>alert('NOTHING FOUND')</script>";

mysqli_close($con);

?>
