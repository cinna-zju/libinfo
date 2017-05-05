<?php
require 'common.php';

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

$con = connectSQL();

$i_count = 0;
$u_count = 0;
foreach($row as $value){
    $value = substr($value,1,strlen($value)-2);
    if($value != ""){
        $w = explode(",",$value);
        $result = mysqli_query($con,"select bno from book where bno='{$w[0]}'");
        if($result==FALSE)
            errInfo($con);
        else{
            $isexist = mysqli_num_rows($result);

            if($isexist == 0){
                    mysqli_query($con, "insert into book values('{$w[0]}',
                        '{$w[1]}','{$w[2]}','{$w[3]}',{$w[4]},'{$w[5]}',{$w[6]},
                        {$w[7]},{$w[8]})");
                    $result = mysqli_query($con, "select * from book where bno='{$w[0]}'");
                    output($result);
                    $i_count += 1;
            }else{
                $arr=[
                    "bno"=>$w[0],
                    "category"=>$w[1],
                    "title"=>$w[2],
                    "press"=>$w[3],
                    "year"=>$w[4],
                    "author"=>$w[5],
                    "price"=>$w[6],
                    "total"=>$w[7],
                    "stock"=>$w[8],
                ];
                update($con, $arr, 'book');
                $u_count += 1;
            }
        }
    }

}
echo "{$i_count} rows inserted, {$u_count} rows updated";
