<?php
class WebSite_IndexPageView extends WebSite_PageView
{
	public function parse ()
	{
		$page = $this->getPage();
		$carbs = 0;
		$ratio = 10;
		$ratioCanBeChanged = true;

		if ($page->getCarbs() > 0)
		{
			$carbs = $page->getCarbs();
		}

		if ($page->getRatio() > 0)
		{
			$ratio = $page->getRatio();
		}

		$user = $page->getUser();

		if (
			$user !== null &&
			$user->getBolusInformation() !== null &&
			$user->getBolusInformation()->getRatio() > 0
		)
		{
			$ratio = $user->getBolusInformation()->getRatio();
			$ratioCanBeChanged = false;
		}

		$this->assignVariable("title", $page->getTitle());
		$this->assignVariable("carbs", $carbs);
		$this->assignVariable("ratioCanBeChanged", $ratioCanBeChanged);
		$this->assignVariable("ratio", $ratio);
		$this->assignVariable("insuline", $page->getInsuline());

		return parent::parse();
	}
}