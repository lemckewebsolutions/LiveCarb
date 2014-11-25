<?php
class Framework_Request_RequestHandler
{
	protected function executeRequest(Framework_Request_PageController $controller)
	{
		try
		{
			switch ($_SERVER['REQUEST_METHOD'])
			{
				case "GET":
					$output = $controller->get();
					break;
				case "POST":
					$output = $controller->post();
					break;
				default:
					$output = "";
			}
		}
		catch (Exception $exception)
		{
			echo $exception->getMessage();
		}

		return $output;
	}
}
