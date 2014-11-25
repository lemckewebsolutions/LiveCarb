<?php
class Framework_Views_PageView extends Framework_Views_View
{
	private $cssFiles = null;

	private $footerJsFiles = null;

	private $headerJsFiles = null;

	/**
	 * The model that loads all the data.
	 * @var Framework_Model_Model
	 */
	private $page = null;

	public function __construct ($templatePath, Framework_Model_Model $page)
	{
		parent::__construct($templatePath);

		$this->setCssFiles(new Framework_Collection_Stack());
		$this->setFooterJsFiles(new Framework_Collection_Stack());
		$this->setHeaderJsFiles(new Framework_Collection_Stack());

		$this->setPage($page);
	}

	public function parse()
	{
		$this->assignVariable("cssFiles", $this->getCssFiles());
		$this->assignVariable("footerJsFiles", $this->getFooterJsFiles());
		$this->assignVariable("headerJsFiles", $this->getHeaderJsFiles());

		return parent::parse();
	}

	/**
	 * Returns the list of css files.
	 * @return Framework_Collection_Stack
	 */
	public function getCssFiles()
	{
		return $this->cssFiles;
	}

	/**
	 * Sets the list of css files.
	 * @param Framework_Collection_Stack $value
	 */
	private function setCssFiles(Framework_Collection_Stack $value)
	{
		$this->cssFiles = $value;
	}

	/**
	 * Returns the list of js files for in the footer.
	 * @return Framework_Collection_Stack
	 */
	public function getFooterJsFiles()
	{
		return $this->footerJsFiles;
	}

	/**
	 * Sets the list of js files for in the footer.
	 * @param Framework_Collection_Stack $value
	 */
	private function setFooterJsFiles(Framework_Collection_Stack $value)
	{
		$this->footerJsFiles = $value;
	}

	/**
	 * Returns the list of js files for in the header.
	 * @return Framework_Collection_Stack
	 */
	public function getHeaderJsFiles()
	{
		return $this->headerJsFiles;
	}

	/**
	 * Sets the list of js files for in the header.
	 * @param Framework_Collection_Stack $value
	 */
	private function setHeaderJsFiles(Framework_Collection_Stack $value)
	{
		$this->headerJsFiles = $value;
	}

	/**
	 * Gets the page (model) object.
	 * @return Framework_Model_Model
	 */
	protected function getPage ()
	{
		return $this->page;
	}

	/**
	 * Sets the page (model) object.
	 * @param Framework_Model_Model $page
	 */
	private function setPage (Framework_Model_Model $page)
	{
		$this->page = $page;
	}
}
