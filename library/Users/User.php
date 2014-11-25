<?php
abstract class Users_User
{
	/**
	 * The bolus information of the user.
	 * @var Users_BolusInformation
	 */
	private $bolusInformation = null;

	/**
	 * The email address of the user.
	 * @var string
	 */
	private $email = "";

	/**
	 * The id of the user.
	 * @var int
	 */
	private $userId = -1;

	/**
	 * The name of the user.
	 * @var string
	 */
	private $name = "";

	public function __construct($name)
	{
		$this->setName($name);
	}

	/**
	 * Gets the bolus information of the user.
	 * @return Users_BolusInformation
	 */
	public function getBolusInformation()
	{
		return $this->bolusInformation;
	}

	/**
	 * Sets the bolus information of the user.
	 * @return Users_BolusInformation
	 */
	public function setBolusInformation(Users_BolusInformation $value)
	{
		$this->bolusInformation = $value;
	}

	/**
	 * Gets the email address of the user.
	 * @return string
	 */
	public function getEmail ()
	{
		return $this->email;
	}

	/**
	 * Sets the email address of the user.
	 * @param string $email
	 */
	public function setEmail ($email)
	{
		$this->email = (string)$email;
	}

	/**
	 * Gets the id of the user.
	 * @return int
	 */
	public function getUserId ()
	{
		return $this->userId;
	}

	/**
	 * Sets the id of the user.
	 * @param int $userId
	 */
	public function setUserId ($userId)
	{
		$this->userId = (int)$userId;
	}

	/**
	 * Gets the name of the user.
	 * @return string
	 */
	public function getName ()
	{
		return $this->name;
	}

	/**
	 * Sets the name of the user.
	 * @param string $name
	 */
	private function setName ($name)
	{
		$this->name = (string)$name;
	}
}