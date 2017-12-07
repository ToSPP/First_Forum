<!DOCTYPE html>
<html>
<head>
	<title>My PHP Forum</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<?php 
spl_autoload_register(function ($class) {
	include strtolower($class) . '.php';
});
?>

<?php 
//echo $_SERVER['PHP_SELF'] . "<br>";
//echo $_SERVER['QUERY_STRING'] . "<br>";
//echo $_SERVER['REQUEST_URI'] . "<br>";
 ?>

<?php 
if (substr($_SERVER['QUERY_STRING'], 0, strpos($_SERVER['QUERY_STRING'], '=')) == 'topic') {
	include 'comment_creator.php'; 
	?>
<h1>Topic No. <?= $_GET['topic'] ?></h1>
<?php showOnesTopic($_GET['topic']); ?>
<h2>Comments</h2>
<?php 
	if (isset($_GET['page'])) {
		showComments($_GET['topic'], $_GET['page']);
	} else {
		showComments($_GET['topic'], 1);
	}
	if (isset($_GET['topic'])) {
		$pagination = new Pagination('comments');
	} else {
		$pagination = new Pagination('topic');
	}
 ?>
 <?php include 'comment_form.php'; ?>
 	<form method="post" action=<?php $_SERVER['REQUEST_URI'] ?>>
		<p><input type="text" name="name" class="addName" placeholder="Your name" value="<?php echo $name; ?>"></p>
		<p><textarea name="message" class="addText" placeholder="Your comment"><?php echo $message; ?></textarea></p>
		<p><input type="submit" name="addComment" class="btnAddComment" value="Add comment"></p>
	</form>
	<?php } else {	 ?>
<h1>FORUM</h1>
	<div class="intro">Our FORUM dedicated phasellus gravida fermentum pellentesque. Aenean non neque mollis nisl dapibus eleifend. Sed interdum dui nec dictum elementum. Proin eget semper dolor, ut commodo nibh. Quisque vitae pharetra ligula. Sed dictum, sem sed pellentesque aliquam, tellus sapien dapibus magna, eu suscipit lacus augue sed velit. Ut vehicula sagittis nulla, et aliquet elit. Quisque tincidunt sem nibh, finibus dictum nisl vulputate quis. In vitae nisl et lacus pulvinar ornare id ac libero. Morbi pharetra fringilla erat ut lacinia.</div>
<h2>Forum topics</h2>
	<?php 
		include 'showtopic_view.php';
		if (isset($_GET['topic'])) {
			$pagination = new Pagination('comments');
		} else {
			$pagination = new Pagination('topic');
		}
	 ?>
<h2>Create topic</h2>
<?php include 'topic_creator.php'; ?>
	<form method="post" action=<?php $_SERVER['REQUEST_URI'] ?>>
		<p><input type="text" name="name" class="addName" placeholder="Your name" value="<?php echo $name; ?>"></p>
		<p><input type="text" name="title" class="addTitle" placeholder="Topic title" value="<?php echo $title; ?>"></p>
		<p><textarea name="message" class="addText" placeholder="Topic text"><?php echo $message; ?></textarea></p>
		<p><input type="submit" name="addComment" class="btnAddComment" value="Create topic"></p>
	</form>
	<?php } ?>

</body>
</html>