<?php 
class Pagination 
{
	private $db;
	private $count_p;

	public function __construct($table) 
	{
		$this->db = new DB_connect;
		switch ($table) {
			case 'topic':
				$sql = 'SELECT count(*) FROM topic';
				break;
			
			case 'comments':
				$sql = 'SELECT count(*) FROM comments WHERE topicID=' . $_GET['topic'];
				break;
		}
		$this->count_p = $this->db->getUserData($sql);
		if ($this->count_p[0][0] != 0) {
			echo "<div class='pagination'><ul>";
			$this->prevPage();
			$this->showPages();
			$this->nextPage();
			echo "</ul></div>";
		}
	}

	private function prevPage()
	{
		if (isset($_GET['page'])) {
			$getPage = $_GET['page'];
		} else {
			$getPage = 0;
		}

		switch ($getPage) {
		 	case 0:
		 	case 1:
		 		echo "<li class='prev-page disabled'>&laquo;";
		 		break;

		 	default:
		 		$getPage -= 1;
		 		$prev = "{$_SERVER['PHP_SELF']}?page={$getPage}";
		 		echo "<li class='prev-page'><a href='{$prev}'>&laquo;</a>";
		 		break;
		}
	}

	private function showPages()
	{
		$this->count_p = ceil($this->count_p[0][0]/3);
		for ($i=1; $i <= $this->count_p; $i++) { 
			echo "<li class='page";
			if (isset($_GET['page'])) {
				if ($_GET['page'] == $i) {
					echo " active";
				} 
				echo "'><a href='?page={$i}'>{$i}</a>";
			} else {
				if ($i == 1) {
					echo " active";
				} 
				echo "'><a href='?page={$i}'>{$i}</a>";
			}
		}
	}

	private function nextPage()
	{
		if ($this->count_p > 1) {
			if (isset($_GET['page'])) {				
				if ($_GET['page'] < $this->count_p) {
					$next = $_GET['page'] + 1;
					echo "<li class='next-page'><a href='?page={$next}'>&raquo;</a>";		
				} else {
					echo "<li class='next-page disabled'>&raquo;";
				}				
			} else {
				echo "<li class='next-page'><a href='?page=2'>&raquo;</a>";
			}
		} else {
			echo "<li class='next-page disabled'>&raquo;";
		}
	}
}
 ?>