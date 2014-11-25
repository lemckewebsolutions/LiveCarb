<?php
class Framework_Model_Model
{
	private $title = "";

	public function __construct()
	{
		$this->setTitle("LiveCarb");
	}

	public function load()
	{
		
	}

	public function getTitle ()
	{
		return $this->title;
	}

	private function setTitle ($title)
	{
		$this->title = $title;
	}
}
