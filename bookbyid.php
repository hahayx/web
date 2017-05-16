<?php

include_once('./simple/simple_html_dom.php');

$id = $_GET['id'];
$html = new simple_html_dom();
$html->load_file('book-'.$id.'/index.html');
$l = $html->find('html' , 0);
header("Content-Type: text/html;charset=utf-8"); 
//header('Content-Type:application/json');
//echo '{content:"' . $l . '"}'

$remo  = $l->find('header[id="header"]',0);
 $remo->outertext = ''; 
//echo str_replace($remo, '', $l);
echo $l;
$html->clear();
?>