<?php
if (strpos($_SERVER["HTTP_HOST"], "livecarb.nl") !== false)
{
	include_once("applications/Website/index.php");
}
elseif (strpos($_SERVER["HTTP_HOST"], "api.livecarb.nl") !== false)
{
	include_once("applications/Api/index.php");
}