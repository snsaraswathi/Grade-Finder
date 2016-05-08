<?php
include 'conn.php';
$class_id = $_GET['class_id'];
$query="SELECT class_description from class where class_id =".$class_id;
$result=mysql_query($query) or die(mysql_error());

if (mysql_num_rows($result)  > 0) {
    while($row = mysql_fetch_assoc($result))
    {
      $array = array(
        "class_description"=>$row["class_description"],
      );
    }
}
header('content-type: application/json; charset=utf-8');
echo $_GET['callback'] . '(' . json_encode($array ). ')';
?>