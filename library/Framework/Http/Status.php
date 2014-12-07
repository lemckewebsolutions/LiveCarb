<?php
/**
 * HTTP statuses.
 * @package Framework_Http
 */
abstract class Framework_Http_Status
{
    /**
     * 100 Continue
     * @var string
     */
    const CONTINUE_REQUEST = "100 Continue";

    /**
     * 101 Switching Protocols
     * @var string
     */
    const SWITCHING_PROTOCOLS = "101 Switching Protocols";

    /**
     * 200 OK
     * @var string
     */
    const OK = "200 OK";

    /**
     * 201 Created
     * @var string
     */
    const CREATED = "201 Created";

    /**
     * 202 Accepted
     * @var string
     */
    const ACCEPTED = "202 Accepted";

    /**
     * 203 Non-Authoritative Information
     * @var string
     */
    const NON_AUTHORITATIVE_INFORMATION = "203 Non-Authoritative Information";

    /**
     * 204 No Content
     * @var string
     */
    const NO_CONTENT = "204 No Content";

    /**
     * 205 Reset Content
     * @var string
     */
    const RESET_CONTENT = "205 Reset Content";

    /**
     * 206 Partial Content
     * @var string
     */
    const PARTIAL_CONTENT = "206 Partial Content";

    /**
     * 300 Multiple Choices
     * @var string
     */
    const MULTIPLE_CHOICES = "300 Multiple Choices";

    /**
     * 301 Moved Permanently
     * @var string
     */
    const MOVED_PERMANENTLY = "301 Moved Permanently";

    /**
     * 302 Found
     * @var string
     */
    const FOUND = "302 Found";

    /**
     * 303 See Other
     * @var string
     */
    const SEE_OTHER = "303 See Other";

    /**
     * 304 Not Modified
     * @var string
     */
    const NOT_MODIFIED = "304 Not Modified";

    /**
     * 305 Use Proxy
     * @var string
     */
    const USE_PROXY = "305 Use Proxy";

    /**
     * 307 Temporary Redirect
     * @var string
     */
    const TEMPORARY_REDIRECT = "307 Temporary Redirect";

    /**
     * 400 Bad Request
     * @var string
     */
    const BAD_REQUEST = "400 Bad Request";

    /**
     * 401 Unauthorized
     * @var string
     */
    const UNAUTHORIZED = "401 Unauthorized";

    /**
     * 402 Payment Required
     * @var string
     */
    const PAYMENT_REQUIRED = "402 Payment Required";

    /**
     * 403 Forbidden
     * @var string
     */
    const FORBIDDEN = "403 Forbidden";

    /**
     * 404 Not Found
     * @var string
     */
    const NOT_FOUND = "404 Not Found";

    /**
     * 405 Method Not Allowed
     * @var string
     */
    const METHOD_NOT_ALLOWED = "405 Method Not Allowed";

    /**
     * 406 Not Acceptable
     * @var string
     */
    const NOT_ACCEPTABLE = "406 Not Acceptable";

    /**
     * 407 Proxy Authentication Required
     * @var string
     */
    const PROXY_AUTHENTICATION_REQUIRED = "407 Proxy Authentication Required";

    /**
     * 408 Request Timeout
     * @var string
     */
    const REQUEST_TIMEOUT = "408 Request Timeout";

    /**
     * 409 Conflict
     * @var string
     */
    const CONFLICT = "409 Conflict";

    /**
     * 410 Gone
     * @var string
     */
    const GONE = "410 Gone";

    /**
     * 411 Length Required
     * @var string
     */
    const LENGTH_REQUIRED = "411 Length Required";

    /**
     * 412 Precondition Failed
     * @var string
     */
    const PRECONDITION_FAILED = "412 Precondition Failed";

    /**
     * 413 Request Entity Too Large
     * @var string
     */
    const REQUEST_ENTITY_TOO_LARGE = "413 Request Entity Too Large";

    /**
     * 414 Request-URI Too Long
     * @var string
     */
    const REQUEST_URI_TOO_LONG = "414 Request-URI Too Long";

    /**
     * 415 Unsupported Media Type
     * @var string
     */
    const UNSUPPORTED_MEDIA_TYPE = "415 Unsupported Media Type";

    /**
     * 416 Requested Range Not Satisfiable
     * @var string
     */
    const REQUESTED_RANGE_NOT_SATISFIABLE = "416 Requested Range Not Satisfiable";

    /**
     * 417 Expectation Failed
     * @var string
     */
    const EXPECTATION_FAILED = "417 Expectation Failed";

    /**
     * 422 Unprocessable
     * @var string
     */
    const UNPROCESSABLE = "422 Unprocessable";

    /**
     * 500 Internal Server Error
     * @var string
     */
    const INTERNAL_SERVER_ERROR = "500 Internal Server Error";

    /**
     * 501 Not Implemented
     * @var string
     */
    const NOT_IMPLEMENTED = "501 Not Implemented";

    /**
     * 502 Bad Gateway
     * @var string
     */
    const BAD_GATEWAY = "502 Bad Gateway";

    /**
     * 503 Service Unavailable
     * @var string
     */
    const SERVICE_UNAVAILABLE = "503 Service Unavailable";

    /**
     * 504 Gateway Timeout
     * @var string
     */
    const GATEWAY_TIMEOUT = "504 Gateway Timeout";

    /**
     * 505 HTTP Version Not Supported
     * @var string
     */
    const HTTP_VERSION_NOT_SUPPORTED = "505 HTTP Version Not Supported";
}