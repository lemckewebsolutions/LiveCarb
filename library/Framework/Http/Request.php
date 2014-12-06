<?php
class Framework_Http_Request
{
	/**
	 * The list of posted fields.
	 * @var Framework_Collection_Array
	 */
	private $postFields = null;

	/**
	 * The url of the request.
	 * @var Framework_Http_Url
	 */
	private $requestUrl = null;

	public function __construct(
			Framework_Http_Url $requestUrl,
			Framework_Collection_Array $postFields
	)
	{
		$this->setRequestUrl($requestUrl);
		$this->setPostFields($postFields);
	}

	/**
	 * Gets whether the connection comes from a development environment.
	 * @return bool Whether the connection comes from a development environment.
	 */
	public function isDevelopment ()
	{
		$isDevelopment = false;

		if (strpos($_SERVER["HTTP_HOST"], ".vm") > 0)
		{
			$isDevelopment = true;
		}
		return $isDevelopment;
	}

	/**
	 * Gets the list of posted fields.
	 * @return Framework_Collection_Array
	 */
	public function getPostFields ()
	{
		return $this->postFields;
	}

	/**
	 * Sets the list of posted fields.
	 * @param Framework_Collection_Array $value
	 */
	private function setPostFields (Framework_Collection_Array $value)
	{
		$this->postFields = $value;
	}

	/**
	 * Gets the url of the request.
	 * @return Framework_Http_Url
	 */
	public function getRequestUrl ()
	{
		return $this->requestUrl;
	}

	/**
	 * Sets tets the url of the request.
	 * @param Framework_Http_Url $requestUrl The url of the request.
	 */
	private function setRequestUrl (Framework_Http_Url $requestUrl)
	{
		$this->requestUrl = $requestUrl;
	}
}
