<?php


include_once('./simple/simple_html_dom.php');
header("Content-Type: text/html;charset=utf-8"); 

function myTrim($str)
{
 $search = array(" ","　","\n","\r","\t");
 $replace = array("","","","","");
 return str_replace($search, $replace, $str);
}

$id = $_GET['id'];
$html = new simple_html_dom();
$html->load_file('book-'.$id.'/index.html');
$l = $html->find('html' , 0);


$chapter  = $l->find('ol[id="volumes"]',0)->find('a');

$b = '[';
foreach ($chapter as $value) {
    $b = $b.'{';
    $b = $b. '"chapterId"'.':"'.$value->{'data-chapter-id'}.'",';
    $b = $b. '"chapterName"'.':"'.myTrim($value->text()).'",';
    $b = $b. '"link"'.':"'.$value->href.'"';
    $b = $b.'},';
}

$b = $b. ']';
$tx = str_replace('},]' , '}]', $b);

echo $tx;
$html->clear();
?>