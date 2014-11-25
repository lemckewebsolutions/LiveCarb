<?php
class Users_BolusInformation
{
	private $targetSugar = -1;

	private $ratio = -1;

	private $sensitivity = -1;

	public function __construct ($targetSugar, $ratio, $sensitivity)
	{
		$this->setTargetSugar($targetSugar);
		$this->setRatio($ratio);
		$this->setSensitivity($sensitivity);
	}

	public function getTargetSugar ()
	{
		return $this->targetSugar;
	}

	private function setTargetSugar ($targetSugar)
	{
		$this->targetSugar = (float)$targetSugar;
	}

	public function getRatio ()
	{
		return $this->ratio;
	}

	private function setRatio ($ratio)
	{
		$this->ratio = (int)$ratio;
	}

	public function getSensitivity ()
	{
		return $this->sensitivity;
	}

	private function setSensitivity ($sensitivity)
	{
		$this->sensitivity = (float)$sensitivity;
	}
}