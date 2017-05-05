
<?php
function output($result)
{
    if($result==false) return;
    $row = mysqli_fetch_array($result, MYSQL_ASSOC);
    if($row == null) return;
    echo "<table border=1><tr>";
    foreach($row as $k=>$value){
        echo "<th>".$k."</th>";
    }
    echo "</tr>";
    do{
        echo "<tr>";
        foreach($row as $k=>$value){
            echo "<td>".$row[$k]."</td>";
        }
        echo "</tr>";

    }
    while( $row = mysqli_fetch_array($result, MYSQL_ASSOC));
    echo "</table>";

}

function connectSQL()
{
    $con = mysqli_connect("127.0.0.1","root","951028","test2");

    errInfo($con);

    return $con;
}

function update($con, $POST, $str)
{
    if($str=='card'){
        foreach($POST as $k=>$value){
            if($POST[$k]!=""){
                if($k=="name"||$k=="department"||$k=="type"){
                    mysqli_query($con, "update {$str} set {$k}='{$POST[$k]}' where cno='{$POST[cno]}'");
                    errInfo($con);
                }
            }
        }
    }

    if($str=='book'){
        foreach($POST as $k=>$value){
            if($POST[$k]!=""){
                if($k=="category"||$k=="title"||$k=="press"||$k=="author"){
                    mysqli_query($con, "update {$str} set {$k}='{$POST[$k]}' where bno='{$POST[bno]}'");
                    errInfo($con);
                }else if($k=="year"||$k=="price"||$k=="total"||$k=="stock"){
                    mysqli_query($con, "update {$str} set {$k}={$POST[$k]} where bno='{$POST[bno]}'");
                    errInfo($con);
                }else{
                    mysqli_query($con, "update {$str} set {$k}={$POST[$k]} where bno='{$POST[bno]}'");
                    errInfo($con);

                }

            }
        }
    }
}

function errInfo($con)
{
    $no = mysqli_errno($con);
    if($no){
        echo "error:{$no}</br>";
        if($no==1146) echo "table is not existed!";
        if($no==1149) echo "Please check the input";
        if($no==1406) echo "input is too long";
        if($no==1451) echo "the card has borrow record";
        if($no==1062) echo "the card has already borrowed the book";
        exit();
    }


}
?>
