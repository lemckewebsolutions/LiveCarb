<?php
class WebSite_Page extends Framework_Model_Model
{
	/**
	 * The amount of carbs.
	 * @var int
	 */
	private $carbs = -1;

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
	 * The amount of insuline.
	 * @var float
	 */
	private $insuline = -1;

	/**
	 * The ratio of the user.
	 * @var float
	 */
	private $ratio = -1;

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

	/**
	 * The logged in user.
	 * @var Users_User
	 */
	private $user = null;

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
	 * Calculates the needed amount of insuline.
	 * @param int $carbs
	 * @param int $ratio
	 */
	public function calculateInsuline()
	{
		if ($this->getCarbs() > 0 &&
			$this->getRatio() > 0)
		{
			$carbs = $this->getCarbs();
			$ratio = $this->getRatio();

			$this->setInsuline(round(($carbs / $ratio), 1));
		}
	}

	/**
	 * Gets the amount of carbs.
	 * @return int The amount of carbs.
	 */
	public function getCarbs ()
	{
		return $this->carbs;
	}

	/**
	 * Sets the amount of carbs.
	 * @param int $carbs The amount of carbs.
	 */
	public function setCarbs ($carbs)
	{
		$this->carbs = (int)$carbs;
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
	 * Gets the amount of insuline.
	 * @return float The amount of insuline.
	 */
	public function getInsuline ()
	{
		return $this->insuline;
	}

	/**
	 * Sets the amount of insuline.
	 * @param float $insuline The amount of insuline.
	 */
	private function setInsuline ($insuline)
	{
		$this->insuline = (float)$insuline;
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
	 * Gets the ratio of the user.
	 * @return float The ratio of the user.
	 */
	public function getRatio ()
	{
		return $this->ratio;
	}

	/**
	 * Sets the ratio of the user.
	 * @param float $ratio The ratio of the user.
	 */
	public function setRatio ($ratio)
	{
		$this->ratio = (int)$ratio;
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
