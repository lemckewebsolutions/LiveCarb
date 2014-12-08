<?php
class Api_ApiController extends Framework_Request_PageController
{
	/**
	 * The configuration array.
	 * @var Framework_Collection_Array
	 */
	private $configuration = null;

	/**
	 * The request object.
	 * @var Framework_Http_Request
	 */
	private $request = null;

	public function __construct (
			Framework_Http_Request $request,
			Framework_Collection_Array $configuration
	)
	{
		$this->setRequest($request);
		$this->setConfiguration($configuration);
	}

	/**
	 * Gets the database connection.
	 * @return mysqli
	 */
	protected function getDatabaseConnection()
	{
		$configuration = $this->getConfiguration();
		$databaseConfiguration = $configuration->offsetGet("database");

		$databaseConnection = new mysqli(
			$databaseConfiguration->offsetGet("server"),
			$databaseConfiguration->offsetGet("user"),
			$databaseConfiguration->offsetGet("password"),
			$databaseConfiguration->offsetGet("database")
		);

		return $databaseConnection;
	}

	/**
	 * Gets the configuration array.
	 * @return Framework_Collection_Array
	 */
	protected function getConfiguration ()
	{
		return $this->configuration;
	}

	/**
	 * Sets tets the configuration array.
	 * @param Framework_Collection_Array $configuration
	 */
	private function setConfiguration (Framework_Collection_Array $configuration)
	{
		$this->configuration = $configuration;
	}

	/**
	 * Gets the request object.
	 * @return Framework_Http_Request
	 */
	protected function getRequest ()
	{
		return $this->request;
	}

	/**
	 * Sets the request object.
	 * $param Framework_Http_Request $value
	 */
	private function setRequest (Framework_Http_Request $value)
	{
		$this->request = $value;
	}
}