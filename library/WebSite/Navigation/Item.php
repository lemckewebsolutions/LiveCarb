<?php
class WebSite_Navigation_Item
{
	private $active = false;

	private $title = "";

	private $url = "";

	public function __construct($title, $url)
	{
		$this->setTitle($title);
		$this->setUrl($url);
	}

	public function getActive ()
	{
		return $this->active;
	}

	public function setActive ($active)
	{
		$this->active = (bool)$active;
	}

	public function getTitle ()
	{
		return $this->title;
	}

	private function setTitle ($title)
	{
		$this->title = (string)$title;
	}

	public function getUrl ()
	{
		return $this->url;
	}

	private function setUrl ($url)
	{
		$this->url = (string)$url;
	}
}