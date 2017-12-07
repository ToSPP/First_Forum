<?php
	$name 		= '';
	$title 		= '';
	$message 	= '';

function addAnswer($a, $text = '') {
	if ($a == 1) {
		$class = 'addTopicSuccess';
		$text = 'Your comment was added!';
	} elseif ($a == 2) {
		$class = 'notice';
		$text = 'Add ' . $text . '!';
	} 
	echo "
		<div class='{$class}'>{$text}</div>
	";
}

if ($_POST) {
	$name = trim(strip_tags($_POST['name']));
	$message = trim(htmlentities($_POST['message'], ENT_QUOTES));
	if (empty($name)) {
		addAnswer(2, 'your name');
	} 
	if (empty($message)) {
		addAnswer(2, 'your comment');
	} else {
		if (!empty($name) && !empty($message)) {
			$topic = new Comment($name, $message);
			addAnswer(1);
			header('Refresh: 3;');
		}
	}
}
?>