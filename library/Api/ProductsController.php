<?php
class Api_ProductsController extends Api_ApiController
	implements Framework_Http_IGet
{
	/**
	 * The querystring key that contains the productname.
	 * @var string
	 */
	const PRODUCT_NAME_KEY = "productname";

	public function get()
	{
		header('Content-Type: application/json');

		$request = $this->getRequest();
		$queryString = $request->getRequestUrl()->getQueryString();

		if ($queryString->exists(self::PRODUCT_NAME_KEY) === false)
		{
			header(Framework_Http_Status::FORBIDDEN);
			return "{}";
		}

		$retrieveProductsCommand = new Api_Commands_RetrieveProductsByNameCommand(
				$this->getDatabaseConnection(),
				$queryString->getValue(self::PRODUCT_NAME_KEY)
		);
		$products = $retrieveProductsCommand->execute();

		if ($products->getLength() === 0)
		{
			header(Framework_Http_Status::NOT_FOUND);
			return "{}";
		}

		return Framework_Json_Serializer::serialize($products);
	}
}