<?php
class WebSite_ProfilePage extends WebSite_Page
{
	public function storeBolusInformation()
	{
		$request = $this->getRequest();
		$postVars = $request->getPostFields();

		$targetSugar = (float)$postVars->offsetGet("targetSugar");
		$ratio = (int)$postVars->offsetGet("ratio");
		$sensitivity = (float)$postVars->offsetGet("sensitivity");

		if ($this->getUser() !== null)
		{
			$bolusInformation = new Users_BolusInformation($targetSugar, $ratio, $sensitivity);
			$this->getUser()->setBolusInformation($bolusInformation);

			$updateInformationCommand = new WebSite_Commands_UpdateBolusInformationCommand(
				$this->getDatabaseConnection(),
				$this->getUser()
			);

			$updateInformationCommand->execute();
		}
	}
}
