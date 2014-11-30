<?php
class WebSite_Commands_RetrieveFacebookUser extends Framework_Database_Command
{
	/**
	 * The facebook object.
	 * @var Facebook
	 */
	private $faceBook = null;

	public function __construct (mysqli $databaseConnection, Facebook $faceBook)
	{
		parent::__construct($databaseConnection);

		$this->setFaceBook($faceBook);
	}

	public function execute()
	{
		$facebook = $this->getFaceBook();
		$facebookUser = null;

		if ($facebook->getUser())
		{
			$userInfoArray = $facebook->api("/me", "GET");
			$facebookUserId = $userInfoArray["id"];

			$facebookUser = $this->getUser($facebookUserId);

			if ($facebookUser === null)
			{
				$this->createUser($facebookUserId, $userInfoArray["name"]);
				$facebookUser = $this->getUser($facebookUserId);
			}
		}

		return $facebookUser;
	}

	/**
	 * Create a user.
	 * @param int $facebookId
	 * @param string $name
	 * @return int
	 */
	private function createUser($facebookId, $name)
	{
		$connection = $this->getDatabaseConnection();

		$connection->query("
			insert into users (facebookuserid, name, lastlogin)
			values (" . $facebookId . ", '" . $name . "', now())
		");

		return $connection->insert_id;
	}

	/**
	 * Gets the user for the given facebook user id.
	 * @param int $facebookUserId
	 * @return Users_FacebookUser
	 */
	private function getUser($facebookUserId)
	{
		$connection = $this->getDatabaseConnection();
		$user = null;

		$result = $connection->query("
			select
			  u.userid,
			  u.facebookuserid,
			  u.name,
			  bi.bolusinformationid,
			  bi.targetsugar,
			  bi.ratio,
			  bi.sensitivity
			from
			  users u
			  left join bolusinformation bi on bi.userid = u.userid
			where
			  u.facebookuserid = " . $facebookUserId
		);

		while($record = $result->fetch_object())
		{
			$user = new Users_FacebookUser($facebookUserId, $record->name);
			$user->setUserId($record->userid);

			if ($record->bolusinformationid > 0)
			{
				$bolusInformation = new Users_BolusInformation(
					$record->targetsugar,
					$record->ratio,
					$record->sensitivity
				);

				$user->setBolusInformation($bolusInformation);
			}
		}

		return $user;
	}

	/**
	 * Gets the facebook object.
	 * @return Facebook
	 */
	private function getFaceBook ()
	{
		return $this->faceBook;
	}

	/**
	 * Sets the facebook object.
	 * @param Facebook $faceBook
	 */
	private function setFaceBook (Facebook $faceBook)
	{
		$this->faceBook = $faceBook;
	}
}
