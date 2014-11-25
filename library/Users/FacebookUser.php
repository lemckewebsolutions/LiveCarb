<?php
class Users_FacebookUser extends Users_User
{
	private $accessToken = "";

	/**
	 * The facebook id of the user.
	 * @var int
	 */
	private $facebookUserId = -1;

	public function __construct($facebookUserId, $name)
	{
		parent::__construct($name);

		$this->setFacebookUserId($facebookUserId);
	}

	/**
	 * Gets the acces token of the user.
	 * @return string
	 */
	public function getAccessToken ()
	{
		return $this->accessToken;
	}

	/**
	 * Sets tets the acces token of the user.
	 * @param string $accessToken
	 */
	public function setAccessToken ($accessToken)
	{
		$this->accessToken = (string)$accessToken;
	}

	/**
	 * Gets the facebook id of the user.
	 * @return int
	 */
	public function getFacebookUserId ()
	{
		return $this->facebookUserId;
	}

	/**
	 * Sets the facebook id of the user.
	 * @param int $value
	 */
	private function setFacebookUserId ($value)
	{
		$this->facebookUserId = (int)$value;
	}
}