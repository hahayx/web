<?php

header('Content-Type: application/json; charset=utf-8');

$id = $_GET['id'];
$type = $_GET['type'];
$con = mysql_connect("hdm186864700.my3w.com","hdm186864700","hahaadmin");
mysql_set_charset('utf8', $con);

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
        echo '"info"'.':"'.br2nl(myTrim($row['Info'])).'",';
        echo '"bookStatus"'.':"'.$row['BookStatus'].'",';
        echo '"bookType"'.':"'.$row['BookType'].'",';
        echo '"src"'.':"https://www.liguanjian.com/xiaoshuo/cover/'.$row['BookId'].'.jpg",';
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
        $b = $b. '"info"'.':"'.br2nl(myTrim($row['Info'])).'",';
        $b = $b. '"bookType"'.':"'.$row['BookType'].'",';
        $b = $b. '"bookStatus"'.':"'.$row['BookStatus'].'",';//1代表连载 2代表完结
		$b = $b. '"src"'.':"https://www.liguanjian.com/xiaoshuo/cover/'.$row['BookId'].'.jpg",';
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

function br2nl($text){
    $text=preg_replace('/<br\\s*?\/??>/i',' ',$text);

	$text=preg_replace('/&nbsp;/i',' ',$text);
	return strip_tags(preg_replace('/ /i',' ',$text));
}

mysql_close($con);
?>