<?php
class WebSite_Commands_UpdateUserCommand extends Framework_Database_Command
{
	/**
	 * The user to update.
	 * @var Users_FacebookUser
	 */
	private $user = null;

	public function __construct (
		mysqli $databaseConnection,
		Users_FacebookUser $user
	)
	{
		parent::__construct($databaseConnection);

		$this->setUser($user);
	}

	public function execute()
	{
		$connection = $this->getDatabaseConnection();
		$facebookUser = $this->getUser();

		if ($this->userExists($facebookUser->getFacebookUserId()) === true)
		{
			$result = $connection->query("
				update users
				set lastlogin = now()
				where facebookuserid = " . $facebookUser->getFacebookUserId()
			);
		}
		else
		{
			$result = $connection->query("
				insert into users (facebookuserid, name, lastlogin)
				values (" . $facebookUser->getFacebookUserId() . ", '" . $facebookUser->getName() . "', now())
			");
		}
	}

	private function userExists($userId)
	{
		$connection = $this->getDatabaseConnection();

		$result = $connection->query("
			select
			  1
			from
			  users u
			where
			  u.facebookuserid = " . $userId
		);

		if ($result->num_rows > 0)
		{
			return true;
		}

		return false;
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
