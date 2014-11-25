<?php
function __autoload($className)
{
    $filePath = str_replace("_", "/", $className);

    if (file_exists("library/" . $filePath . ".php") === true)
    {
        include "library/" . $filePath . ".php";
    }
	elseif (file_exists("library/Facebook/" . $filePath . ".php") === true)
    {
        include "library/Facebook/" . $filePath . ".php";
    }
}

