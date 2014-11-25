<?php
abstract class Framework_Database_Command
{
	/**
	 * The connection with the database.
	 * @var mysqli
	 */
	private $databaseConnection = null;

	/**
	 * @param mysqli $databaseConnection
	 */
	public function __construct(mysqli $databaseConnection)
	{
		$this->setDatabaseConnection($databaseConnection);
	}

	public abstract function execute();

	/**
	 * Gets the connection with the database.
	 * @return mysqli
	 */
	protected function getDatabaseConnection ()
	{
		return $this->databaseConnection;
	}

	/**
	 * Sets the connection with the database.
	 * @param mysqli $databaseConnection
	 */
	private function setDatabaseConnection (mysqli $databaseConnection)
	{
		$this->databaseConnection = $databaseConnection;
	}
}
