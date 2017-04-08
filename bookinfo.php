<?php
header('charset:utf-8'); 
header('Content-Type:application/json');

$id = $_GET['id'];
$type = $_GET['type'];
$con = mysql_connect("hdm186864700.my3w.com","hdm186864700","hahaadmin");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("hdm186864700_db", $con);


if($id){
    if(!is_numeric($id)){
        echo 'id is null, i will return. byebye;';
        return;
    }
    $c = "where BookId =". $id;
    $result = mysql_query("SELECT * FROM Novel ". $c);

    echo '{';
    while($row = mysql_fetch_array($result))
      {

        echo '"bookId"'.':"'.$row['BookId'].'",';
        echo '"bookName"'.':"'.$row['BookName'].'",';
        echo '"auther"'.':"'.$row['Auther'].'",';
        echo '"info"'.':"'.myTrim($row['Info']).'",';
        echo '"bookType"'.':"'.$row['BookType'].'",';
        echo '"lastChapterName"'.':"'.$row['LastChapterName'].'"';
      }

    echo '}';
}else if($type){
    if(!is_numeric($type)){
        echo 'type is null, i will return. byebye;';
        return;
    }
    $result = mysql_query("SELECT * FROM Novel where BookType = ". $type);

    $b = '[';
    while($row = mysql_fetch_array($result))
      {
        $b = $b.'{';
        $b = $b. '"bookId"'.':"'.$row['BookId'].'",';
        $b = $b. '"bookName"'.':"'.$row['BookName'].'",';
        $b = $b. '"auther"'.':"'.$row['Auther'].'",';
        $b = $b. '"info"'.':"'.myTrim($row['Info']).'",';
        $b = $b. '"bookType"'.':"'.$row['BookType'].'",';
        $b = $b. '"lastChapterName"'.':"'.$row['LastChapterName'].'"';
        $b = $b.'},';
      }
    $b = $b. ']';
    echo str_replace('},]' , '}]', $b);
}


function myTrim($str)
{
 $search = array(" ","　","\n","\r","\t");
 $replace = array("","","","","");
 return str_replace($search, $replace, $str);
}

mysql_close($con);
?>