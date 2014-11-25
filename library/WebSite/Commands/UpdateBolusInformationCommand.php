<?php
class WebSite_Commands_UpdateBolusInformationCommand extends Framework_Database_Command
{
	/**
	 * The user to update.
	 * @var Users_FacebookUser
	 */
	private $user = null;

	public function __construct (
			mysqli $databaseConnection,
			Users_User $user
	)
	{
		parent::__construct($databaseConnection);

		$this->setUser($user);
	}

	public function execute()
	{
		$connection = $this->getDatabaseConnection();
		$user = $this->getUser();
		$bolusInformation = $user->getBolusInformation();

		if ($bolusInformation === null)
		{
			return;
		}

		$connection->query("insert into bolusinformation (userid, targetsugar, ratio, sensitivity)
							values
							(
							  " . $user->getUserId() . ",
							  " . $bolusInformation->getTargetSugar() . ",
							  " . $bolusInformation->getRatio() . ",
							  " . $bolusInformation->getSensitivity() . "
							)
							on duplicate key update
							  targetsugar = " . $bolusInformation->getTargetSugar() . ",
							  ratio = " . $bolusInformation->getRatio() . ",
							  sensitivity = " . $bolusInformation->getSensitivity());

		if ($connection->errno > 0)
		{
			echo $connection->error;
		}
	}

	/**
	 * Gets the user to update.
	 * @return Users_FacebookUser
	 */
	private function getUser ()
	{
		return $this->user;
	}

	/**
	 * Sets the user to update.
	 * @param Users_FacebookUser $user
	 */
	private function setUser (Users_FacebookUser $user)
	{
		$this->user = $user;
	}
}