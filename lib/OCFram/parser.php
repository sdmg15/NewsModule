<?php 
function parseText($value){ 

$value = preg_replace('#<gras>([\s\S]*?)<\/gras>#Ui', '<strong>$1</strong>',$value);
$value = preg_replace('#<italic>([\s\S]*?)<\/italic>#Ui','<i>$1</i>',$value);
$value = preg_replace('#<link href=([\s\S]*?)>([\s\S]*?)<\/link>#Ui','<a href="$1">$2</a>',$value);
$value = preg_replace('#<quote auteur=([a-z1-9_-]*?)?>([\s\S]*?)<\/quote>#Ui','<blockquote><i>$1 said :  $2</i></blockquote>',$value);

return $value;
	
}
if(isset($_POST['script'])){ 

$content = $_POST['script'];

if(get_magic_quotes_gpc()){ 

	$content = nl2br(stripslashes($content));
}
echo parseText($content);
}





?>