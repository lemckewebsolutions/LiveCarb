<?php
chdir(__FILE__);

if (strpos($_SERVER["HTTP_HOST"], "api.livecarb.nl") !== false)
{
	include_once("applications/Api/index.php");
}
else
{
	include_once("applications/Website/index.php");
}