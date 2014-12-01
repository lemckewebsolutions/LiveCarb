<?php
class WebSite_Navigation_Item
{
	private $active = false;

	/**
	 * The list of subitems
	 * @var Framework_Collection_Stack
	 */
	private $subItems = null;

	private $title = "";

	private $url = "";

	public function __construct($title, $url)
	{
		$this->setTitle($title);
		$this->setUrl($url);
		$this->setSubItems(new Framework_Collection_Stack());
	}

	public function getActive ()
	{
		return $this->active;
	}

	public function setActive ($active)
	{
		$this->active = (bool)$active;
	}

	/**
	 * Returns a list of subitems.
	 * @return Framework_Collection_Stack
	 */
	public function getSubItems()
	{
		return $this->subItems;
	}

	/**
	 * Sets the list of sub items.
	 * @param Framework_Collection_Stack $subItems
	 */
	private function setSubItems(Framework_Collection_Stack $subItems)
	{
		$this->subItems = $subItems;
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