<?php
ini_set('display_errors', 'On');

include_once("library/Framework/Core/Bootstrap.php");
include_once("Configuration.Local.php");

$jsonObject = json_decode(file_get_contents("voedingsdatabase.json"));

$databaseConnection = new mysqli(
	$database->offsetGet("server"),
	$database->offsetGet("user"),
	$database->offsetGet("password"),
	$database->offsetGet("database")
);

foreach ($jsonObject->productgroups as $productGroup)
{
	$databaseConnection->query("
		insert into productgroup (productgroupid, productgroup)
		values (" . $productGroup->pgc . ", '" . $productGroup->pgd . "')");
}

foreach ($jsonObject->products as $product)
{
	$databaseConnection->query("
		insert into product (productgroupid, productname, quantity, unit, productinformation, nevoid, version)
		values
		(
			" . $product->pgc . ",
			'" . $product->pd. "',
			" . $product->pa . ",
			'" . $product->pu . "',
			'" . $product->pc . "',
			" . $product->pnc . "
			" . $jsonObject->version . "
		)");

	$productId = $databaseConnection->insert_id;

	$voedingswaarde = $product->nv[0];

	$databaseConnection->query("
		insert into productnutrition (productid, carbs)
		values (" . $productId . ", " . (float)$voedingswaarde->na . ")
	");
}