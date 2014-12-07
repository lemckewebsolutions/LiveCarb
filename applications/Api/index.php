<?php
error_reporting(-1);
ini_set('display_errors', 'On');
include_once("library/Framework/Core/Bootstrap.php");

$configuration = new Framework_Collection_Array();

if (file_exists("applications/Api/Configuration.Local.php") === true)
{
	include_once("applications/Api/Configuration.Local.php");
}

echo "The API is still under construction.";