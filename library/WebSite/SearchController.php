<?php
class WebSite_SearchController extends WebSite_PageController
	implements Framework_Http_IGet
{
	public function get()
	{
		header('Content-Type: application/json');

		$queryString = $this->getRequest()->getRequestUrl()->getQueryString();

		if ($this->isAjaxRequest() === false ||
			$queryString->exists("productname") === false)
		{
			header("HTTP/1.1 404 Not Found");
			return "";
		}

		$apiRequestUrl = new Framework_Http_Url(
			$this->getConfiguration()->offsetGet("api")->offsetGet("url")
		);
		$productName = $queryString->getValue("productname");

		$apiRequestUrl->getQueryString()->setValue("productname", $productName);

		$curl = curl_init();
		curl_setopt_array(
			$curl,
			array(
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_URL => $apiRequestUrl->getUrl()
			)
		);

		$result = curl_exec($curl);

		echo $result;
	}
}