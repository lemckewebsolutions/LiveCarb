<?php
abstract class Bolus_Calculator
{
	/**
	 * Calculates the amount of insuline needed for the given carbs.
	 * @param float $carbs The amount of carbs.
	 * @param float $ratio The ratio of the user.
	 * @return float The amount of insuline needed.
	 */
	public static function calculateInsulineForFood($carbs, $ratio)
	{
		return round(($carbs / $ratio), 1);
	}

	/**
	 * Calculates the amount of insuline needed to correct the bloodsugar.
	 * @param float $sugar The current bloodsugar.
	 * @param float $targetSugar The target bloodsugar.
	 * @param float $sensitivity The sensitivity of the user.
	 * @return float The amount of insuline needed.
	 */
	public static function calculateInsulineForCorrection($sugar, $targetSugar, $sensitivity)
	{
		$insuline = ($sugar - $targetSugar) / $sensitivity;

		return round($insuline, 1);
	}
}
