<?php
$con = mysqli_connect("127.0.0.1","root","951028") or die ("could not connect to mysql");

mysqli_select_db($con, "test2") or die ("no database");

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    //you need to exit the script, if there is an error
    exit();
}

    //

    $result = mysqli_query($con,
        "select bno
        from book
        where bno={$_POST[bno]}");
    $isexist = mysqli_num_rows($result);
    if( $isexist ){
        echo "bno already existed</br>";
        foreach($_POST as $k=>$value){
            if( $_POST[$k] != '' && $k!="bno"){
                $result = mysqli_query($con, "select * from book where bno={$_POST[bno]}");
                $before = mysqli_fetch_array( $result );
                if(mysqli_query($con, "update book set {$k} = {$_POST[$k]} where bno = {$_POST[bno]}"))
                    echo "succeed!</br>
                    {$k} before:{$before[$k]} after:{$_POST[$k]}</br>";
                else echo mysqli_error($con);
            }
        }
    }else{
        foreach($_POST as $k=>$value){
            echo $k.":".$_POST[$k]."</br>";
            if($_POST[$k]!="" && $k!="bno")
                mysqli_query($con, "insert into book(bno,{$k}) values({$_POST[bno]},{$_POST[$k]})");
        }
        #echo mysqli_error($con)."</br>";

        echo "add book succeed!</br>";
        $result = mysqli_query($con, "select * from book where bno={$_POST[bno]}");
        $arr = mysqli_fetch_array($result, MYSQLI_ASSOC);

        foreach($arr as $k=>$value){
            echo "{$k}: {$arr[$k]}</br>";
        }

    }

mysqli_close($con);

?>
