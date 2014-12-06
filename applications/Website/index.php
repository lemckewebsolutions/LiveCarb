<?php
error_reporting(-1);
ini_set('display_errors', 'On');
include_once("library/Framework/Core/Bootstrap.php");

$configuration = new Framework_Collection_Array();

if (file_exists("applications/Website/Configuration.Local.php") === true)
{
	include_once("applications/Website/Configuration.Local.php");
}

$requestHandler = new WebSite_RequestHandler($configuration);
$requestHandler->processRequest();