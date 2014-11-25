<?php
/**
 * Provides access to the query string and its values.
 * @package Framework_Http
 */
class Framework_Http_QueryString
	implements Iterator
{
    /**
     * The values of the parameters defined in the query string.
     * @var array
     */
    private $values = array();

    /**
     * Initialize a new QueryString object.
     * @param string $queryString The full query string, excluding the question mark.
     */
    public function __construct($queryString)
    {
        $pairs = preg_split("/&/", $queryString, -1, PREG_SPLIT_NO_EMPTY);
        $stripSlashes = (get_magic_quotes_gpc() === 1);

        // The query string is parsed, and a list of parameters is created. Each parameter
        // is stored as a single value and as an array.
        foreach ($pairs as $pair)
        {
            $eqPos = strpos($pair, "=");

            if ($eqPos === false)
            {
                $name = $pair;
                $value = "";
            }
            else
            {
                $name = substr($pair, 0, $eqPos);
                $value = substr($pair, $eqPos + 1);
            }

            if ($stripSlashes === true)
            {
                $value = stripslashes($value);
            }

            if (array_key_exists($name, $this->values) === false)
            {
                $this->values[$name] = array($value);
            }
            else
            {
                $this->values[$name][] = $value;
            }
        }
    }

    /**
     * Get the full query string, excluding the question mark.
     * @return string The full query string, excluding the question mark.
     */
    public function __toString()
    {
        $queryString = "";

        foreach ($this->values as $name => $values)
        {
            foreach ($values as $value)
            {
                if ($queryString !== "")
                {
                    $queryString .= "&";
                }

                $queryString .= urlencode($name);

                if ($value !== "")
                {
                    // URL encode all characters, except the equals sign and square brackets, as
                    // some parties (Google Analytics and various marketing partners) cannot seem
                    // to this whole "internet" thing down. They rely on these characters to be
                    // unencoded, so we'll have to make it work.
                    $queryString .= "=" . str_replace(
                        array("%3D", "%5B", "%5D", "%28", "%29", "%7C", "%5E", "%2F", "%25"),
                        array("=", "[", "]", "(", ")", "|", "^", "/","%"),
                        urlencode($value)
                    );
                }
            }
        }

        return $queryString;
    }

    /**
     * Get the value of the current element.
     * @return string The value of the current element.
     */
    public function current()
    {
        if ($this->exists($this->key()) === true)
        {
            return $this->getValue($this->key());
        }

        return false;
    }

    /**
     * Determines whether the parameter exists within the query string.
     * @param string $name The name of the parameter for which to determine whether it exists within the query string.
     * @return bool Whether the parameter exists within the query string.
     */
    public function exists($name)
    {
        return array_key_exists($name, $this->values);
    }

    /**
     * Get an array of integers from a query string parameter value. Returns an empty framework
     * array if the parameter value wasn't found.
     * @param string $name The name of the query string parameter for which to return the value.
     * @param int $index The index of the parameter value to be returned.
     * @param string $delimiter The string delimiter on which to split the parameter value string.
     * @return Framework_Collection_Array An array of integers based on the query string parameter values.
     */
    public function getIntArray($name, $index = 0, $delimiter)
    {
        $ints = new Framework_Collection_Array();

        $value = $this->getValue($name, $index);

        if ($value !== "")
        {
            $strings = explode($delimiter, $value);

            foreach ($strings as $string)
            {
                $ints->push((int)$string);
            }
        }

        return $ints;
    }

    /**
     * Returns the query string parameter value as an integer, or the framework default for an integer
     * if the value cannot be found in the query string.
     * @param string $name The name of the query string parameter for which to return the value.
     * @param int $index The index of the parameter value to be returned.
     * @return int The value of the query string parameter cast to an integer.
     */
    public function getInteger($name, $index = 0)
    {
        $value = $this->getValue($name, $index);

        $int = Framework_Types_Integer::DEFAULT_VALUE;

        // Depends on the output of getValue(), which doesn't use the framework defaults.
        if ($value !== "")
        {
            $int = (int)$value;
        }

        return $int;
    }

    /**
     * Get a query string parameter value.
     * @param string $name The name of the query string parameter for which to return the value.
     * @param int $index The index of the parameter value to be returned.
     * @return string The value of the query string parameter.
     */
    public function getValue($name, $index = 0)
    {
        if (array_key_exists($name, $this->values) === true &&
            array_key_exists($index, $this->values[$name]) === true)
        {
            return $this->values[$name][$index];
        }

        return "";
    }

    /**
     * Returns the current index offset.
     * @return string The current index offset.
     */
    public function key()
    {
        return key($this->values);
    }

    /**
     * Move forward to the next element.
     * @return string The value of the next element.
     */
    public function next()
    {
        next($this->values);

        return $this->current();
    }

    /**
     * Rewind the collection to its first element and returns the value of that element.
     * @return string The value of the first element, or false for an empty array.
     */
    public function rewind()
    {
        reset($this->values);

        return $this->current();
    }

    /**
     * Set a query string parameter value.
     * @param string $name The name of the query string parameter for which to set the value.
     * @param string $value The value of the query string parameter.
     * @param int $index The index at which to set the parameter value.
     */
    public function setValue($name, $value, $index = 0)
    {
        if (array_key_exists($name, $this->values) === false)
        {
                $this->values[$name] = array();
        }

        $this->values[$name][$index] = $value;
    }

    /**
     * Unset a query string parameter value.
     * @param string $name The name of the query string parameter to be unset.
     * @param int $index The index of the value to be unset.
     */
    public function unsetValue($name, $index = 0)
    {
        if (array_key_exists($name, $this->values) === true &&
            array_key_exists($index, $this->values[$name]) === true)
        {
            unset($this->values[$name][$index]);
        }
    }

    /**
     * Determines if the current index offset exists.
     * @return bool Whether the current index offset exists.
     */
    public function valid()
    {
        return ($this->current() !== false);
    }

    /**
     * Get the number of parameter values in the query string.
     * @return int The number of parameter values in the query string.
     */
    public function getLength()
    {
        return array_sum(array_map("count", $this->values));
    }

    /**
     * Get the parameters defined in the query string.
     * @return Framework_Collection_NameValueCollection The parameters defined in the query string.
     * @throws Exception
     * @deprecated Has been deprecated in order to support parameters with multiple values.
     */
    public function getParameters()
    {
        throw new Exception(
            __METHOD__ . " has been deprecated. See the class documentation for alternatives."
        );
    }

    /**
     * Get the full query string, excluding the question mark.
     * @return string The full query string, excluding the question mark.
     */
    public function getQueryString()
    {
        return $this->__toString();
    }
}