<?php 
date_default_timezone_set('Europe/Moscow');
class DB_connect
{
	private $dbh;
	private $host 		= 'localhost';
	private $user 		= 'root';
	private $password 	= '';
	public $sql;
	private $db;

	public function __construct()
	{	
		try {
			$this->dbh = new PDO("mysql:dbname=forum;host=$this->host;charset=utf8", "$this->user", "$this->password");
		} catch (PDOExceprion $e) {
			echo 'Connection error: ' . $e->getMessage();
		}
	}

	public function getAllData($cols, $table, $skip, $numrows)
	{
		$sth = $this->dbh->prepare('SELECT ' . implode(',', $cols) . ' FROM ' . $table . ' ORDER BY id DESC LIMIT ?, ?');
		$sth->bindParam(1, $skip, PDO::PARAM_INT);
		$sth->bindParam(2, $numrows, PDO::PARAM_INT);
		$sth->execute();
		return $sth->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getUserData($sql)
	{
		$sth = $this->dbh->prepare($sql);
		$sth->execute();
		return $sth->fetchAll(PDO::FETCH_NUM);
	}

	public function setData($table, $fields, $values)
	{
		$sth = $this->dbh->prepare('INSERT INTO ' . $table . ' (' . $fields . ') VALUES (?, ?, ?)');
		$sth->execute($values);
	}
}
 ?>
