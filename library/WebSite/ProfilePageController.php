<?php
class WebSite_ProfilePageController extends WebSite_PageController
	implements Framework_Http_IGet, Framework_Http_IPost
{
	protected function assignClientCodeFiles (Framework_Views_PageView $view)
	{
		$view->getFooterJsFiles()->push("profile.js");

		parent::assignClientCodeFiles($view);
	}

	public function get()
	{
		$page = new WebSite_ProfilePage(
				$this->getConfiguration(),
				$this->getRequest()
		);

		$page->load();

		if ($page->getUser() === null)
		{
			header("Location: http://www.livecarb.nl");
			return;
		}

		$view = new WebSite_PageView(
				self::TEMPLATE_PATH . "profile.tpl",
				$page
		);

		$this->assignClientCodeFiles($view);

		return $view->parse();
	}

	public function post()
	{
		$page = new WebSite_ProfilePage(
				$this->getConfiguration(),
				$this->getRequest()
		);

		$page->load();
		$page->storeBolusInformation();

		if ($page->getUser() === null)
		{
			header("Location: http://www.livecarb.nl");
			return;
		}

		$view = new WebSite_PageView(
				self::TEMPLATE_PATH . "profile.tpl",
				$page
		);

		$this->assignClientCodeFiles($view);

		return $view->parse();
	}
}
