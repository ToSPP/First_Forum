<?php 
class Comment
{
	use Message;

	protected $topicID;
	protected $table 	= 'comments';
	protected $fields 	= 'name, msg, topicID';
	protected $cols		= ['name', 'msg', 'ts'];

	public function __construct($name, $msg)
	{
		$this->setName($name);
		$this->setMsg($msg);
		$this->getTopicID();
		$this->values = [$this->name, $this->msg, $this->topicID];
		$db = new DB_connect();
		$db->setData($this->table, $this->fields, $this->values);
	}

	protected function getTopicID()
	{
		$this->topicID = $_GET['topic'];
	}

}
 ?>