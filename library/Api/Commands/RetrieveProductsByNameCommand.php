<?php
class Api_Commands_RetrieveProductsByNameCommand extends Framework_Database_Command
{
	/**
	 * The name of the product to search for.
	 * @var string
	 */
	private $productName = "";

	/**
	 * Initializes a new command.
	 * @param mysqli $databaseConnection The connection with the database.
	 * @param string $productName The name of the product to search for.
	 */
	public function __construct (mysqli $databaseConnection, $productName)
	{
		parent::__construct($databaseConnection);

		$this->setProductName($productName);
	}

	public function execute()
	{
		$connection = $this->getDatabaseConnection();
		$products = new Framework_Collection_Array();

		$result = $connection->query("
			select
			  p.productid,
			  p.productname
			from
			  product p
			where
			  p.productname like '%" . $this->getProductName() . "%'");

		while($record = $result->fetch_object())
		{
			$product = new Products_Product($record->productname);
			$product->setProductId($record->productid);

			$products->offsetSet($product->getProductId(), $product);
		}

		return $products;
	}

	/**
	 * @return string
	 */
	private function getProductName ()
	{
		return $this->productName;
	}

	/**
	 * @param string $productName
	 */
	private function setProductName ($productName)
	{
		$this->productName = (string)$productName;
	}
}
