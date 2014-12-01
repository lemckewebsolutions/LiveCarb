<?php
class WebSite_BolusWizardController extends WebSite_PageController
	implements Framework_Http_IPost
{
	public function post()
	{
		$request = $this->getRequest();
		$postedFields = $request->getPostFields();

		header('Content-Type: application/json');

		if ($postedFields->offsetExists("carbs") === false ||
			$postedFields->offsetExists("ratio") === false)
		{
			header("HTTP/1.1 404 Not Found");
			return "{}";
		}

		$carbs = $postedFields->offsetGet("carbs");
		$ratio = $postedFields->offsetGet("ratio");

		$insuline = Bolus_Calculator::calculateInsuline($carbs, $ratio);

		$jsonObject = new stdClass();
		$jsonObject->insuline = $insuline;

		header("HTTP/1.1 200 Ok");
		return json_encode($jsonObject);
	}
}
