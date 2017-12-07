<?php 
trait Message 
{
	protected $name;
	protected $msg;
	protected $ts;
	protected $values;
	protected $db;

	protected function setName($name)
	{
		$this->name = trim(strip_tags($name));
		if (strlen($this->name) > 32) {
			throw new Exception("Name is too long (max 32 char.)");
		}
	}

	protected function setMsg($msg)
	{
		$this->msg = htmlentities($msg, ENT_QUOTES, "utf-8");
		if (strlen($this->msg) > 300) {
			throw new Exception("Message is too long (max 300 char.)");
		}
	}
}
 ?>
