<?php 
parse_str($_SERVER['QUERY_STRING'], $param_arg);

if (array_key_exists('page', $param_arg) && count(array_keys($param_arg)) < 2) {
	$skip = $param_arg['page'];
	showTopics($skip);
} elseif (empty($param_arg)) {
	$skip = 1;
	showTopics($skip);
}

function showTopics($skip) 
{
	$cols = ['id', 'title', 'name', 'ts'];
	$db = new DB_connect;
	$skip = ($skip * 3) - 3;
	$topicToView = $db->getAllData($cols, 'topic', $skip, 3);
	foreach ($topicToView as $key => $value) {
		$countComments = $db->getUserData('SELECT count(*) FROM comments WHERE topicID=' . $value['id']);
		echo "
			<div class='topicBox'>
			<h3><a href='?topic={$value['id']}'>{$value['title']}</a></h3>
			<p><b>Created: </b>{$value['ts']} <b>Author: </b>{$value['name']}</p>
			<p><b>Answers: </b>{$countComments[0][0]}</p>
			</div>
			";
	}
}
?>