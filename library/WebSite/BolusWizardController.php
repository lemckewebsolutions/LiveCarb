<?php
class WebSite_BolusWizardController extends Framework_Request_PageController
	implements Framework_Http_IPost
{
	public function post()
	{
		header('Content-Type: application/json');
		return 12;
	}
}
