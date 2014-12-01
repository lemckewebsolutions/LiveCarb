<?php
class WebSite_PageView extends Framework_Views_PageView
{
	private function assignBolusWizardInformation()
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

		if ($user !== null &&
			$user->getBolusInformation() !== null)
		{
			$ratio = $user->getBolusInformation()->getRatio();
			$ratioCanBeChanged = false;

			$bolusInformation = $user->getBolusInformation();
			$this->assignVariable("targetSugar", $bolusInformation->getTargetSugar());
			$this->assignVariable("sensitivity", $bolusInformation->getSensitivity());
		}

		$this->assignVariable("title", $page->getTitle());
		$this->assignVariable("carbs", $carbs);
		$this->assignVariable("ratioCanBeChanged", $ratioCanBeChanged);
		$this->assignVariable("ratio", $ratio);
		$this->assignVariable("insuline", $page->getInsuline());
	}

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
		$this->assignVariable("showLogin", ($page->getUser() === null));
		$this->assignVariable("user", $page->getUser());
		$this->assignVariable("loginUrl", $loginUrl);
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