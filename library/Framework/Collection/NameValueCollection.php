<?php
/**
 * Represents a collection of string key/value pairs.
 * @package Framework_Collection
 */
class Framework_Collection_NameValueCollection
	extends Framework_Collection_Collections
{
	/**
	 * Determine whether a value exists for the given name.
	 * @param string $name The name for which to determine whether a value exists.
	 * @return bool Whether a value exists for the given name.
	 */
	public function exists($name)
	{
		return array_key_exists($name, $this->array);
	}

	/**
	 * Get the value for the given name.
	 * @param string $name The name for which to return its value.
	 * @return string The value for the given name.
	 * @throws Exception
	 */
	public function get($name)
	{
            if (array_key_exists($name, $this->array) === false)
            {
                    throw new Exception("Undefined offset: " . $name);
            }

            return $this->array[$name];
	}

	/**
	 * Remove the value for the given name.
	 * @param string $name The name for which remove its value.
	 */
	public function remove($name)
	{
            unset($this->array[$name]);
	}

	/**
	 * Set the value for the given name.
	 * @param string $name The name for which to set its value.
	 * @param string $value The value for the given name.
	 */
	public function set($name, $value)
	{
            $this->array[(string)$name] = (string)$value;
	}
}