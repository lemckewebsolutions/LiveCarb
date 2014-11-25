<?php
class WebSite_IndexPage extends WebSite_Page
{
	private $carbs = -1;

	private $insuline = -1;

	private $ratio = -1;

	/**
	 * Calculates the needed amount of insuline.
	 * @param int $carbs
	 * @param int $ratio
	 */
	public function calculateInsuline()
	{
		if ($this->getCarbs() > 0 &&
			$this->getRatio() > 0)
		{
			$carbs = $this->getCarbs();
			$ratio = $this->getRatio();

			$this->setInsuline(round(($carbs / $ratio), 1));
		}
	}

	public function getCarbs ()
	{
		return $this->carbs;
	}

	public function setCarbs ($carbs)
	{
		$this->carbs = (int)$carbs;
	}

	public function getInsuline ()
	{
		return $this->insuline;
	}

	private function setInsuline ($insuline)
	{
		$this->insuline = (float)$insuline;
	}

	public function getRatio ()
	{
		return $this->ratio;
	}

	public function setRatio ($ratio)
	{
		$this->ratio = (int)$ratio;
	}
}
