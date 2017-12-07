<?php 
	$name 		= '';
	$title 		= '';
	$message 	= '';
	function addAnswer($a, $text = '') {
		if ($a == 1) {
			$class = 'addTopicSuccess';
			$text = 'Topic was created successfully!';
		} elseif ($a == 2) {
			$class = 'notice';
			$text = 'Add ' . $text . '!';
		} elseif ($a == 3) {
			$class = 'notice';
			$text = 'Topic with same title already exists!';
		}
		echo "
			<div class='{$class}'>{$text}</div>
		";
	}

	if ($_POST) {
		$name = trim(strip_tags($_POST['name']));
		$title = trim(strip_tags($_POST['title']));
		$message = trim(htmlentities($_POST['message'], ENT_QUOTES));
		$db = new DB_connect;
		$titleIsExist = $db->getUserData("SELECT * FROM topic WHERE title = '" . $title . "'");
		if (empty($name)) {
			addAnswer(2, 'your name');
		} 
		if (empty($title)) {
			addAnswer(2, 'topic title');
		}
		if (empty($message)) {
			addAnswer(2, 'message');
		}
		if (!empty($titleIsExist)) {
			addAnswer(3);
		} else {
			if (!empty($name) && !empty($title) && !empty($message)) {
				$topic = new Topic($title, $name, $message);
				addAnswer(1);
				header('Refresh: 3;');
			}
		}
	}
 ?>
