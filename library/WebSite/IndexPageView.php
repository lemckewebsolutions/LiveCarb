<?php
class WebSite_IndexPageView extends WebSite_PageView
{
	public function parse ()
	{
		$page = $this->getPage();
		$carbs = 0;
		$ratio = 10;

		if ($page->getCarbs() > 0)
		{
			$carbs = $page->getCarbs();
		}

		if ($page->getRatio() > 0)
		{
			$ratio = $page->getRatio();
		}

		$this->assignVariable("title", $page->getTitle());
		$this->assignVariable("carbs", $carbs);
		$this->assignVariable("ratio", $ratio);
		$this->assignVariable("insuline", $page->getInsuline());

		return parent::parse();
	}
}