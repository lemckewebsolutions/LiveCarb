<?php
class WebSite_Page extends Framework_Model_Model
{
	/**
	 * The configuration array.
	 * @var Framework_Collection_Array
	 */
	private $configuration = null;

	/**
	 * The facebook object.
	 * @var Facebook
	 */
	private $faceBook = null;

	/**
	 * The logged in user.
	 * @var Users_User
	 */
	private $user = null;

	/**
	 * The request object.
	 * @var Framework_Http_Request
	 */
	private $request = null;

	/**
	 * The page title.
	 * @var string
	 */
	private $title = "";

	public function __construct(
			Framework_Collection_Array $configuration,
			Framework_Http_Request $request,
			$title = ""
	)
	{
		$this->setConfiguration($configuration);
		$this->setRequest($request);

		if ($title === "")
		{
			$title = "LiveCarb";
		}

		$this->setTitle($title);
	}

	public function destroyFacebookSession()
	{
		$this->getFaceBook()->destroySession();
	}

	public function load()
	{
		$this->loadFacebook();
		$this->loadUser();
	}

	private function loadFacebook()
	{
		$configuration = $this->getConfiguration();
		if ($configuration->offsetExists("faceBook") === true)
		{
			$faceBookConfiguration = $configuration->offsetGet("faceBook");

			$facebook = new Facebook(array(
				"appId"  => $faceBookConfiguration->offsetGet("appId"),
				"secret" => $faceBookConfiguration->offsetGet("appSecret")
			));

			$this->setFaceBook($facebook);
		}
	}

	public function loadFacebookUser()
	{
		if ($this->getFaceBook() !== null)
		{
			$retrieveUserCommand = new WebSite_Commands_RetrieveFacebookUser(
					$this->getDatabaseConnection(),
					$this->getFaceBook()
			);
			$facebookUser = $retrieveUserCommand->execute();

			if ($facebookUser !== null)
			{
				$this->setUser($facebookUser);

				$updateUserCommand = new WebSite_Commands_UpdateUserCommand(
					$this->getDatabaseConnection(),
					$facebookUser
				);

				$updateUserCommand->execute();

				$_SESSION["user"] = $facebookUser;
			}
		}
	}

	private function loadUser()
	{
		if (array_key_exists("user", $_SESSION) === true &&
			$_SESSION["user"] instanceof Users_FacebookUser)
		{
			$this->setUser($_SESSION["user"]);
		}
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
	 * Gets the navigation items.
	 * @return Framework_Collection_Stack
	 */
	public function getNavigationItems()
	{
		$requestUrl = $this->getRequest()->getRequestUrl();
		$navigationItems = new Framework_Collection_Stack();

		$homeItem = new WebSite_Navigation_Item(
			"Home",
			WebSite_UrlPatterns::INDEX
		);

		$disclaimerItem = new WebSite_Navigation_Item(
			"Disclaimer",
			WebSite_UrlPatterns::DISCLAIMER
		);

		switch ($requestUrl->getPath())
		{
			case WebSite_UrlPatterns::INDEX:
				$homeItem->setActive(true);
				break;
			case WebSite_UrlPatterns::DISCLAIMER:
				$disclaimerItem->setActive(true);
				break;
		}

		$navigationItems->push($homeItem);
		$navigationItems->push($disclaimerItem);

		if ($this->getUser() !== null)
		{
			$profileItem = new WebSite_Navigation_Item(
				"Profiel",
				WebSite_UrlPatterns::PROFIEL
			);

			if ($requestUrl->getPath() === WebSite_UrlPatterns::PROFIEL)
			{
				$profileItem->setActive(true);
			}

			$navigationItems->push($profileItem);
		}

		return $navigationItems;
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
	 * Gets the facebook object.
	 * @return Facebook
	 */
	public function getFaceBook ()
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

	/**
	 * Gets the logged in user.
	 * @return Users_User
	 */
	public function getUser ()
	{
		return $this->user;
	}

	/**
	 * Sets the logged in user.
	 * @param Users_User $user
	 */
	protected function setUser (Users_User $user)
	{
		$this->user = $user;
	}

	/**
	 * Gets the request object.
	 * @return Framework_Http_Request
	 */
	public function getRequest ()
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

	public function getTitle ()
	{
		return $this->title;
	}

	private function setTitle ($title)
	{
		$this->title = $title;
	}
}
