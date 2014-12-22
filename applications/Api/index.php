<?php
error_reporting(-1);
ini_set('display_errors', 'On');
chdir("../");
include_once("library/Framework/Core/Bootstrap.php");

$configuration = new Framework_Collection_Array();

if (file_exists("applications/Api/Configuration.Local.php") === true)
{
	include_once("applications/Api/Configuration.Local.php");
}

$requestHandler = new Api_RequestHandler($configuration);
$requestHandler->processRequest();