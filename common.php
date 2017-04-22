
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

    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        //you need to exit the script, if there is an error
        exit();
    }
    return $con;
}

function update($con, $POST, $str)
{
    if($str=='card'){
        foreach($POST as $k=>$value){
            if($POST[$k]!=""){
                if($k=="name"||$k=="department"||$k=="type"){
                    mysqli_query($con, "update {$str} set {$k}='{$POST[$k]}' where cno='{$POST[cno]}'");
                }
            }
        }
    }

    if($str=='book'){
        foreach($POST as $k=>$value){
            if($POST[$k]!=""){
                if($k=="category"||$k=="title"||$k=="press"||$k=="author"){
                    mysqli_query($con, "update {$str} set {$k}='{$POST[$k]}' where bno='{$POST[bno]}'");
                }
                if($k=="year"||$k=="price"||$k=="total"||$k=="stock"){
                    mysqli_query($con, "update {$str} set {$k}={$POST[$k]} where bno='{$POST[bno]}'");
                }
            }
        }
    }
    if(mysqli_errno($con)==0)
        return;
    else
        die (mysqli_error($con));
}

?>
