<?php
class WebSite_ProfilePage extends WebSite_IndexPage
{
	public function storeBolusInformation()
	{
		$request = $this->getRequest();
		$postVars = $request->getPostFields();

		$targetSugar = (float)$postVars->offsetGet("targetSugar");
		$ratio = (int)$postVars->offsetGet("ratio");
		$sensitivity = (float)$postVars->offsetGet("sensitivity");

		if ($this->getFacebookUser() !== null)
		{
			$bolusInformation = new Users_BolusInformation($targetSugar, $ratio, $sensitivity);
			$this->getFacebookUser()->setBolusInformation($bolusInformation);

			$updateInformationCommand = new WebSite_Commands_UpdateBolusInformationCommand(
				$this->getDatabaseConnection(),
				$this->getFacebookUser()
			);

			$updateInformationCommand->execute();
		}
	}
}