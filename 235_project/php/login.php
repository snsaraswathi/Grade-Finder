<?php
include 'conn.php';
$username = $_GET['username'];
$password = $_GET['password'];
$query="SELECT id,firstname,lastname,phone,EmailId,type from user where id =".$username." and password=".$password;

$result=mysql_query($query) or die(mysql_error());
		
if (mysql_num_rows($result) > 0) {
    while($row = mysql_fetch_assoc($result)){
      if($row['type'] == 1)
      {
        $gradesQuery = "SELECT homeworks,labs,midterm,presentation,project,final from student_grade where student_id=".$username;
        $gradesResult = mysql_query($gradesQuery) or die(mysql_error());
        while($gradesRow = mysql_fetch_assoc($gradesResult))
        {
          $array = array(
                        "firstname"=>$row["firstname"],
                         "lastname"=>$row["lastname"],
                         "email"=>$row["EmailId"],
                         "phone"=>$row["phone"],
                         "type"=>$row["type"],
                         "homeworks"=>$gradesRow["homeworks"],
                         "labs"=>$gradesRow["labs"],
                         "midterm"=>$gradesRow["midterm"],
                         "presentation"=>$gradesRow["presentation"],
                         "project"=>$gradesRow["project"],
                         "final"=>$gradesRow["final"]
                        );
        }
      }
      else
      {
        $array = array(
                        "firstname"=>$row["firstname"],
                        "lastname"=>$row["lastname"],
                        "email"=>$row["EmailId"],
                        "phone"=>$row["phone"],
                        "type"=>$row["type"]
                      );
      }
    }
}
else
{
     $array = array(
                    "error"=>"Invalid Username/Password combination"
                    );
}
header('content-type: application/json; charset=utf-8');
echo $_GET['callback'] . '(' . json_encode($array ). ')';
?>