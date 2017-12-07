<?php 
function showOnesTopic($id)
{
	$cols = ['id', 'title', 'name', 'msg', 'ts'];
	$db = new DB_connect;
	$getData = $db->getUserData('SELECT ' . implode(',', $cols) . ' FROM topic WHERE id = ' . $id);
	$countComments = $db->getUserData('SELECT count(*) FROM comments WHERE topicID=' . $id);
	echo "
		<div class='topicBox'>
		<p><b>Created: </b>{$getData[0][4]} <b>Author: </b>{$getData[0][2]}</p>
		<p><b>Answers: </b>{$countComments[0][0]}</p>
		<p><a href='index.php'>Back to Topic List</a></p>
		<h2>{$getData[0][1]}</h2>
		<p>{$getData[0][3]}</p>
		</div>
		";
}

function showComments($id, $skip)
{
	$cols = ['name', 'msg', 'ts'];
	$db = new DB_connect;
	$skip = ($skip * 3) - 3;
	$getData = $db->getUserData('SELECT ' . implode(',', $cols) . ' FROM comments WHERE topicid = ' . $id . ' ORDER BY id DESC LIMIT ' . $skip . ', 3');
	foreach ($getData as $key => $value) {
		echo "
			<div class='commentBox'>
			<p><b>{$value[2]}</b> {$value[0]}</p>
			<p>{$value[1]}</p>
			</div>
			";
	}
}
 ?>
