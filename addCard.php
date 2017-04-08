<?php


function update($con)
{
    foreach($_POST as $k=>$value){
        if($_POST[$k]!=""){
            if($k=="name"||$k=="department"||$k=="type"){
                mysqli_query($con, "update card set {$k}='{$_POST[$k]}' where cno='{$_POST[cno]}'");
            }
        }
    }
}

function check($con)
{
    $result = mysqli_query($con, "select * from card where cno='{$_POST[cno]}'");
    $arr = mysqli_fetch_array($result, MYSQL_ASSOC);
    foreach($arr as $k=>$value){
        echo $k.": ".$arr[$k]."    ";
    }
    echo "</br>";

}

$con = mysqli_connect("127.0.0.1","root","951028") or die ("could not connect to mysql");

mysqli_select_db($con, "test2") or die ("no database");

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    //you need to exit the script, if there is an error
    exit();
}

  $result = mysqli_query($con,"select cno from card where cno='{$_POST[cno]}'");
  if($result==FALSE) die(mysqli_error());
  else{
      $isexist = mysqli_num_rows($result);
      if( $isexist ){
          echo "modifying</br>";
          echo "before:";
          check($con);
          update($con);
          echo "after:";
          check($con);
          if(mysqli_errno($con)==0)
              echo "card modified successfully</br>";
          else
              echo mysqli_error($con);
      }else{
          mysqli_query($con, "insert into card(cno) values('{$_POST[cno]}')");
          update($con);
          if(mysqli_errno($con)==0)
              echo "card created successfully</br>";
          else
              echo mysqli_error($con);

      }
  }

mysqli_close($con);

?>
