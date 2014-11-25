<?php
class WebSite_LogoutPageController extends WebSite_PageController
	implements Framework_Http_IGet
{
	public function get()
	{
		$requestUrl = $this->getRequest()->getRequestUrl();
		$queryString = $requestUrl->getQueryString();
		$redirectUrl = WebSite_UrlPatterns::INDEX;

		if ($queryString->exists("redirect_url") === true)
		{
			$redirectUrl = $queryString->getValue("redirect_url");
		}

		$page = new WebSite_Page(
			$this->getConfiguration(),
			$this->getRequest()
		);
		$page->load();

		$page->destroyFacebookSession();
		unset($_SESSION["user"]);

		header("Location: " . $redirectUrl);
	}
}
