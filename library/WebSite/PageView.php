<?php
class WebSite_PageView extends Framework_Views_PageView
{
	private function assignBolusWizardInformation()
	{
		$page = $this->getPage();
		$ratio = 10;
		$ratioCanBeChanged = true;

		$user = $page->getUser();

		if ($user !== null &&
			$user->getBolusInformation() !== null)
		{
			$ratio = $user->getBolusInformation()->getRatio();
			$ratioCanBeChanged = false;

			$bolusInformation = $user->getBolusInformation();
			$ratio = $bolusInformation->getRatio();
			$this->assignVariable("targetSugar", $bolusInformation->getTargetSugar());
			$this->assignVariable("sensitivity", $bolusInformation->getSensitivity());
		}

		$this->assignVariable("title", $page->getTitle());
		$this->assignVariable("ratio", $ratio);
		$this->assignVariable("ratioCanBeChanged", $ratioCanBeChanged);
	}

	public function parse ()
	{
		$page = $this->getPage();
		$facebook = $page->getFacebook();

		$this->assignVariable("title", $page->getTitle());
		$this->assignVariable("navigationItems", $page->getNavigationItems());
		$this->assignVariable("showLogin", ($page->getUser() === null));
		$this->assignVariable("user", $page->getUser());
		$this->assignVariable("loginUrl", $page->getFacebookLoginUrl());
		$this->assignVariable("logoutUrl", $this->getLogoutUrl()->getUrl());

		$this->assignBolusWizardInformation();

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