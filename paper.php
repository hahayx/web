<?php


include_once('./simple/simple_html_dom.php');
header("Content-Type: application/json;charset=utf-8"); 


$bookId = $_GET['bookId'];
$chapterId = $_GET['chapterId'];

/*
echo 'book-'.$bookId.'/'.$chapterId.'.html';
*/
$html = new simple_html_dom();
$html->load_file('book-'.$bookId.'/'.$chapterId.'.html');
$l = $html->find('section' , 0);

$preview = $html->find('a[id="readProgPrev"]', 0)->href;
$next = $html->find('a[id="readProgNext"]',0)->href;

function bookId($link){
	preg_match('/\/(\d+)./', $link, $res);
	if(count($res)>1){
		return $res[1];
	}else{
		return "";
	}
}

function br2nl($text){

    $text=preg_replace('/<br\\s*?\/??>/i','\\n',$text);
	$text=preg_replace('/<\/p>/i','\\n</p>',$text);
	$text=preg_replace('/\r\n　　\r\n/m','\n',$text);
	$text=preg_replace('/\n/m','\\n',$text);
	$text=preg_replace('/\r/m','\\r',$text);
	$text=preg_replace('/\t/m','\\t',$text);

	$text=preg_replace('/<\/div>/i','\\n</div>',$text);
	$text=preg_replace('/&nbsp;/i',' ',$text);
	return strip_tags(preg_replace('/ /i',' ',$text));
}

echo '{"content":"'. br2nl($l->text()).'",';
echo '"previous":"'. bookId($preview).'",';
echo '"next":"'. bookId($next).'"}';
?>