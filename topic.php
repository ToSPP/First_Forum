<?php 
class Topic 
{
	use Message;

	protected $title;
	protected $table 	= 'topic';
	protected $fields 	= 'title, name, msg';
	protected $cols 	= ['title', 'name', 'msg', 'ts'];

	public function __construct($title, $name, $msg)
	{
		$this->setTitle($title);
		$this->setName($name);
		$this->setMsg($msg);
		$this->values = [$this->title, $this->name, $this->msg];
		$db = new DB_connect();
		$db->setData($this->table, $this->fields, $this->values);
	}

	protected function setTitle($title)
	{
		$this->title = htmlentities($title, ENT_QUOTES, "utf-8");
		if (strlen($this->title) > 256) {
			throw new Exception("Title is too long (max 256 char.)");
		}
	} 
}
 ?>
