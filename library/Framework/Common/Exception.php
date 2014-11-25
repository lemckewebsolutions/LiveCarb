<?php
/**
 * The base class for all exceptions (used in PHP >= 5.3).
 * @package Framework_Common
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
class Framework_Common_Exception
	extends Exception
{
	/**
	 * Initialize a new Exception object.
	 * @param string $message A message describing the exception.
	 * @param Exception $previous A previous exception which has caused this exception to be thrown.
	 * @param int $code An error code identifying the exception.
	 */
	public function __construct($message = "", Exception $previous = null, $code = 0)
	{
		parent::__construct($message, $code, $previous);
	}
}