<?php
class Products_Product implements Framework_Json_ISerializable
{
	/**
	 * The id of the product.
	 * @var int
	 */
	private $productId = -1;

	/**
	 * The name of the product.
	 * @var string
	 */
	private $productName = "";

	/**
	 * Initializes a new product object.
	 * @param string $productName The name of the product.
	 */
	public function __construct ($productName)
	{
		$this->setProductName($productName);
	}

	/**
	 * Creates a serializable object.
	 * @returns stdClass The serializable object.
	 */
	public function serialize ()
	{
		$jsonObject = new stdClass();
		$jsonObject->productId = $this->getProductId();
		$jsonObject->productName = $this->getProductName();

		return $jsonObject;
	}
		/**
	 * Gets the id of the product.
	 * @return int The id of the product.
	 */
	public function getProductId ()
	{
		return $this->productId;
	}

	/**
	 * Sets the id of the product.
	 * @param type $productId The id of the product.
	 */
	public function setProductId ($productId)
	{
		$this->productId = (int)$productId;
	}

	/**
	 * Gets the name of the product.
	 * @return string The name of the product.
	 */
	public function getProductName ()
	{
		return $this->productName;
	}

	/**
	 * Sets the name of the product.
	 * @param string $productName The name of the product.
	 */
	private function setProductName ($productName)
	{
		$this->productName = (string)$productName;
	}
}
