<?php 
class DB_connect
{
	private $dbh;
	protected $dsn;
	private $user = 'root';
	private $password = '';

	public function __construct($dsn)
	{
		$this->dsn = $dsn;
		try {
			$this->dbh = new PDO($this->dsn, $user, $password);
		} catch (PDOExceprion $e) {
			echo 'Connection error: ' . $e->getMessage();
		}
	}

}
 ?>
