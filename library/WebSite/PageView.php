<?php
class WebSite_PageView extends Framework_Views_PageView
{
	public function parse ()
	{
		$page = $this->getPage();
		$facebook = $page->getFacebook();

		$loginUrl = $facebook->getLoginUrl(
			array(
				"redirect_uri" => "http://www.livecarb.nl"
			)
		);

		$this->assignVariable("title", $page->getTitle());
		$this->assignVariable("navigationItems", $page->getNavigationItems());
		$this->assignVariable("showLogin", ($page->getFacebookUser() === null));
		$this->assignVariable("facebookUser", $page->getFacebookUser());
		$this->assignVariable("loginUrl", $loginUrl);
		$this->assignVariable("logoutUrl", $this->getLogoutUrl()->getUrl());

		return parent::parse();
	}

	/**
	 * Gets the url to logout.
	 * @return Framework_Http_Url
	 */
	private function getLogoutUrl()
	{
		$logoutUrl = new Framework_Http_Url(WebSite_UrlPatterns::LOGOUT);
		$logoutUrl->getQueryString()->setValue(
			"redirect_url",
			$this->getPage()->getRequest()->getRequestUrl()->getPath()
		);

		return $logoutUrl;
	}
}