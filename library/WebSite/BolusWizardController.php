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

		$insuline = Bolus_Calculator::calculateInsulineForFood($carbs, $ratio);

		if ($postedFields->offsetGet("sugar") > 0 &&
			$postedFields->offsetGet("targetSugar") > 0 &&
			$postedFields->offsetGet("sensitivity") > 0)
		{
			$sugar = $postedFields->offsetGet("sugar");
			$targetSugar = $postedFields->offsetGet("targetSugar");
			$sensitivity = $postedFields->offsetGet("sensitivity");

			$insuline += Bolus_Calculator::calculateInsulineForCorrection($sugar, $targetSugar, $sensitivity);
		}

		$jsonObject = new stdClass();
		$jsonObject->insuline = $insuline;

		header("HTTP/1.1 200 Ok");
		return json_encode($jsonObject);
	}
}
