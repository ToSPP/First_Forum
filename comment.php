<?php 
class Comment
{
	protected $name;
	protected $msg;
	protected $ts;

	public function __construct($name, $msg)
	{
		$this->setname($name);
		$this->setmsg($msg);
	}

	protected function setname($name)
	{
		$this->name = trim(strip_tags($name));
		if (strlen($this->name) > 32) {
			throw new Exception("Name is too long (max 32 char.)");
		}
	}

	protected function setmsg($msg)
	{
		$this->msg = htmlspecialchars($msg);
		if (strlen($this->msg) > 300) {
			throw new Exception("Message is too long (max 300 char.)");
		}
	}

	protected function getdata()
	{

	}

}
 ?>