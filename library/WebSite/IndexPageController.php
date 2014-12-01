<?php
class WebSite_IndexPageController extends WebSite_PageController
	implements Framework_Http_IGet
{
	public function get()
	{
		$request = $this->getRequest();
		$queryString = $request->getRequestUrl()->getQueryString();

		$page = new WebSite_Page(
				$this->getConfiguration(),
				$this->getRequest()
		);

		$page->load();

		if ($page->getUser() ===  null && $queryString->exists("code") === true)
		{
			$page->loadFacebookUser();
			header("Location: ". WebSite_UrlPatterns::INDEX);
		}

		$view = new WebSite_PageView(
				self::TEMPLATE_PATH . "index.tpl",
				$page
		);

		$this->assignClientCodeFiles($view);

		return $view->parse();
	}
}
