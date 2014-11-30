<?php
class WebSite_IndexPageController extends WebSite_PageController
	implements Framework_Http_IGet, Framework_Http_IPost
{
	public function get()
	{
		$request = $this->getRequest();
		$queryString = $request->getRequestUrl()->getQueryString();

		$page = new WebSite_IndexPage(
				$this->getConfiguration(),
				$this->getRequest()
		);

		$page->load();

		if ($page->getUser() ===  null && $queryString->exists("code") === true)
		{
			$page->loadFacebookUser();
			header("Location: ". WebSite_UrlPatterns::INDEX);
		}

		$view = new WebSite_IndexPageView(
				self::TEMPLATE_PATH . "index.tpl",
				$page
		);

		$this->assignClientCodeFiles($view);

		return $view->parse();
	}

	public function post()
	{
		$page = new WebSite_IndexPage(
				$this->getConfiguration(),
				$this->getRequest()
		);

		$page->load();

		$view = new WebSite_IndexPageView(
				self::TEMPLATE_PATH . "index.tpl",
				$page
		);

		$this->assignClientCodeFiles($view);

		$postedFields = $this->getRequest()->getPostFields();

		if ($postedFields->keyExists("carbs") === true &&
			$postedFields->keyExists("ratio") === true)
		{
			$carbs = $postedFields->offsetGet("carbs");
			$ratio = $postedFields->offsetGet("ratio");

			$page->setCarbs($carbs);
			$page->setRatio($ratio);
		}

		$page->calculateInsuline();

		return $view->parse();
	}
}
