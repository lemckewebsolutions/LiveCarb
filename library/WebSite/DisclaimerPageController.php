<?php
class WebSite_DisclaimerPageController extends WebSite_PageController
	implements Framework_Http_IGet
{
	public function get()
	{
		$page = new WebSite_Page(
				$this->getConfiguration(),
				$this->getRequest(),
				"LiveCarb - Disclaimer"
		);

		$page->load();

		$view = new WebSite_PageView(
				self::TEMPLATE_PATH . "disclaimer.tpl",
				$page
		);

		$this->assignClientCodeFiles($view);

		return $view->parse();
	}
}
