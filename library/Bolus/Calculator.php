<?php
abstract class Bolus_Calculator
{
	/**
	 * Calculates the amount of insuline needed for the given carbs.
	 * @param float $carbs The amount of carbs.
	 * @param float $ratio The ratio of the user.
	 * @return float The amount of insuline needed.
	 */
	public static function calculateInsuline($carbs, $ratio)
	{
		return round(($carbs / $ratio), 1);
	}
}
