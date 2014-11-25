<?php
class Framework_Views_View
{
	/**
	 * The path of the template.
	 * @var string
	 */
	private $templatePath = "";

	/**
	 * The variables to be assigned to the template.
	 * @var array
	 */
	protected $variables = array();

	public function __construct ($templatePath)
	{
		$this->setTemplatePath($templatePath);
	}

	/**
	 * Assign a variable to the template.
	 * @param string $name The name of the variable.
	 * @param mixed $value The value of the variable.
	 */
	public function assignVariable($name, $value)
	{
		$this->variables[$name] = $value;
	}

	/**
	 * Include the template file.
	 * @param string $templateFilePath The file system path of the template file.
	 * @throws Exception
	 * @throws Framework_Common_InvalidOperationException
	 * @return string The result of the template file inclusion.
	 */
	public function includeFile($templateFilePath)
	{
		if (file_exists($templateFilePath) === false)
		{
			throw new Framework_Common_InvalidOperationException(
				"Unable to read given template file: " . $templateFilePath
			);
		}

		ob_start();

		$output = "";

		extract($this->variables);

		try
		{
			include($templateFilePath);

			$output = ob_get_contents();
		}
		catch (Exception $exception)
		{
			// Clear the buffer before re-throwing the exception to prevent garbage from being
			// flushed to the output stream.
			ob_end_clean();

			throw $exception;
		}

		ob_end_clean();

		return $output;
	}

	public function parse()
	{
		return $this->includeFile($this->getTemplatePath());
	}

	/**
	 * Gets the path of the template.
	 * @return string The path of the template.
	 */
	protected function getTemplatePath ()
	{
		return $this->templatePath;
	}

	/**
	 * Sets the path of the template.
	 * @param string $templatePath The path of the template.
	 */
	private function setTemplatePath ($templatePath)
	{
		$this->templatePath = (string)$templatePath;
	}
}