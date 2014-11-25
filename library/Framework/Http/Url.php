<?php
/**
 * Provides access to the individual parts of a URL.
 * @package Framework_Http
 */
class Framework_Http_Url
{
    /**
     * The HTTP protocol URL scheme.
     * @var string
     */
    const SCHEME_HTTP = "http";

    /**
     * The HTTPS protocol URL scheme.
     * @var string
     */
    const SCHEME_HTTPS = "https";

    /**
     * The fragment part of the URL (excluding the hash sign).
     * @var string
     */
    private $fragment = "";

    /**
     * The hostname part of the URL.
     * @var string
     */
    private $hostname = "";

    /**
     * The password included in the URL.
     * @var string
     */
    private $password = "";

    /**
     * The path part of the URL.
     * @var string
     */
    private $path = "";

    /**
     * The server port used.
     * @var int
     */
    private $port = 0;

    /**
     * The query string part of the URL (excluding the question mark).
     * @var Framework_Http_QueryString
     */
    private $queryString = null;

    /**
     * The protocol scheme used.
     * @var string
     */
    private $scheme = self::SCHEME_HTTP;

    /**
     * The path segment (each individual directory and the filename).
     * @var Framework_Collection_Array
     */
    private $segments = null;

    /**
     * The username included in the URL.
     * @var string
     */
    private $username = "";

    /**
     * Initialize a new URL object.
     * @param string $url The URL string.
     * @throws Framework_Common_ParseErrorException
     */
    public function __construct($url)
    {
        $urlComponents = @parse_url($url);

        if ($urlComponents === false)
        {
                throw new Framework_Common_ParseErrorException("Invalid URL: " . $url);
        }

        foreach ($urlComponents as $key => $value)
        {
            $value = urldecode($value);

            switch ($key)
            {
                case "scheme":
                        $this->setScheme($value);
                        break;
                case "host":
                        $this->setHostname($value);
                        break;
                case "port":
                        $this->setPort($value);
                        break;
                case "user":
                        $this->setUsername($value);
                        break;
                case "pass":
                        $this->setPassword($value);
                        break;
                case "path":
                        $this->setPath($value);
                        break;
                case "query":
                        $this->setQueryString(new Framework_Http_QueryString($value));
                        break;
                case "fragment":
                        $this->setFragment($value);
                        break;
            }
        }

        // If no path was included the URL, create an empty placeholder for the URL segments.
        if ($this->getPath() === "")
        {
            $this->setSegments(new Framework_Collection_Array());
        }

        // If no querystring was included the URL, create an empty placeholder.
        if ($this->getQueryString() === null)
        {
            $this->setQueryString(new Framework_Http_QueryString(""));
        }
    }

    /**
     * Create a deep clone of the URL object.
     */
    public function __clone()
    {
            $this->setQueryString(clone $this->getQueryString());
            $this->setSegments(clone $this->getSegments());
    }

    /**
     * Extract the segments from the path.
     */
    private function extractSegments()
    {
            $segments = new Framework_Collection_Array(preg_split(
                    '/\//',
                    $this->getPath(),
                    -1,
                    PREG_SPLIT_NO_EMPTY
            ));

            $this->setSegments($segments);
    }

    /**
     * Get the relative URL string without schema and hostname.
     * @return string The relative URL without schema and hostname.
     */
    public function getRelativeUrl()
    {
            $url = $this->getPath();

            if ($this->getQueryString()->getLength() > 0)
            {
                    $url .= "?" . $this->getQueryString()->__toString();
            }

            if ($this->getFragment() !== "")
            {
                    $url .= "#" . rawurlencode($this->getFragment());
            }

            return $url;
    }

    /**
     * Get the URL string.
     * @return string The URL string.
     */
    public function getUrl()
    {
            $url = "";

            if ($this->getScheme() !== "" && $this->getHostname() !== "")
            {
                    $url = $this->getScheme() . "://";

                    if ($this->getUsername() !== "")
                    {
                            $url .= $this->getUsername();

                            if ($this->getPassword() !== "")
                            {
                                    $url .= ":" . $this->getPassword();
                            }

                            $url .= "@";
                    }

                    $url .= $this->getHostname();

                    if ($this->getPort() > 0)
                    {
                            $url .= ":" . $this->getPort();
                    }
            }

            $url .= $this->getRelativeUrl();

            return $url;
    }

    /**
     * Get the fragment part of the URL (excluding the hash sign).
     * @return string The fragment part of the URL (excluding the hash sign).
     */
    public function getFragment()
    {
            return $this->fragment;
    }

    /**
     * Set the fragment part of the URL (excluding the hash sign).
     * @param string $value The fragment part of the URL (excluding the hash sign).
     */
    public function setFragment($value)
    {
            $this->fragment = (string)$value;
    }

    /**
     * Get the hostname part of the URL.
     * @return string The hostname part of the URL.
     */
    public function getHostname()
    {
            return $this->hostname;
    }

    /**
     * Set the hostname part of the URL.
     * @param string $value The hostname part of the URL.
     */
    public function setHostname($value)
    {
            $this->hostname = (string)$value;
    }

    /**
     * Get the password included in the URL.
     * @return string The password included in the URL.
     */
    public function getPassword()
    {
            return $this->password;
    }

    /**
     * Set the password included in the URL.
     * @param string $value The password included in the URL.
     */
    public function setPassword($value)
    {
            $this->password = (string)$value;
    }

    /**
     * Get the path part of the URL.
     * @return string The path part of the URL.
     */
    public function getPath()
    {
            return $this->path;
    }

    /**
     * Set the path part of the URL.
     * @param string $value The path part of the URL.
     */
    public function setPath($value)
    {
            $this->path = (string)$value;

            $this->extractSegments();
    }

    /**
     * Get the server port used.
     * @return int The server port used.
     */
    public function getPort()
    {
            return $this->port;
    }

    /**
     * Set the server port used.
     * @param int $value The server port used.
     */
    public function setPort($value)
    {
            $this->port = (int)$value;
    }

    /**
     * Get the query string part of the URL (excluding the question mark).
     * @return Framework_Http_QueryString The query string part of the URL (excluding the question mark).
     */
    public function getQueryString()
    {
            return $this->queryString;
    }

    /**
     * Set the query string part of the URL (excluding the question mark).
     * @param Framework_Http_QueryString $value The query string part of the URL (excluding the question mark).
     */
    public function setQueryString(Framework_Http_QueryString $value)
    {
            $this->queryString = $value;
    }

    /**
     * Get the protocol scheme used.
     * @return string The protocol scheme used.
     */
    public function getScheme()
    {
            return $this->scheme;
    }

    /**
     * Set the protocol scheme used.
     * @param string $value The protocol scheme used.
     */
    public function setScheme($value)
    {
            $this->scheme = strtolower($value);
    }

    /**
     * Get the path segment (each individual directory and the filename).
     * @return Framework_Collection_Array The path segment (each individual directory and the filename).
     */
    public function getSegments()
    {
            return $this->segments;
    }

    /**
     * Set the path segment (each individual directory and the filename).
     * @param Framework_Collection_Array $value The path segment (each individual directory and the filename).
     */
    private function setSegments(Framework_Collection_Array $value)
    {
            $this->segments = $value;
    }

    /**
     * Get the username included in the URL.
     * @return string The username included in the URL.
     */
    public function getUsername()
    {
            return $this->username;
    }

    /**
     * Set the username included in the URL.
     * @param string $value The username included in the URL.
     */
    public function setUsername($value)
    {
            $this->username = (string)$value;
    }
}