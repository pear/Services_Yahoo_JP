<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Services_Yahoo_JP Auction Response
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to the New BSD license that is
 * available through the world-wide-web at the following URI:
 * http://www.opensource.org/licenses/bsd-license.php. If you did not receive  
 * a copy of the New BSD License and are unable to obtain it through the web, 
 * please send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category  Services
 * @package   Services_Yahoo_JP
 * @author    Tetsuya Nakase <phpizer@gmail.com>
 * @copyright 2008 Tetsuya Nakase
 * @license   http://www.opensource.org/licenses/bsd-license.php BSD
 * @version   CVS: $Id$
 * @link      http://phpize.net
 */

/**
 * Services_Yahoo Auction Response class
 *
 * This class provides methods for accessing the response of a Auction
 * request.
 *
 * @category  Services
 * @package   Services_Yahoo_JP
 * @extends   Exception
 * @author    Tetsuya Nakase <phpizer@gmail.com>
 * @copyright 2008 Tetsuya Nakase
 * @license   http://www.opensource.org/licenses/bsd-license.php BSD
 * @version   Release: 0.0.1
 * @link      http://phpize.net
 */
class Services_Yahoo_JP_Auction_Response implements Iterator
{
    /**
     * validate flag
     *
     * @access private
     * @var    bool
     */
    private $_isValidIterator = true;

    /**
     * counter
     *
     * @access private
     * @var    intger
     */
    private $_iteratorCounter = 0;

    /**
     * request object
     *
     * @access private
     * @var    object
     */
    private $_request;

    /**
     * result
     *
     * @access private
     * @var    array
     */
    private $_results = array();

    /**
     * index key for loop
     *
     * @access private
     * @var    string
     */
    private $_indexkey;

    /**
     * Constructor
     *
     * @param object $request HTTP_Request Instance of 
     *                        HTTP_Request that was used for the request
     *
     * @throws Services_Yahoo_Exception
     */
    public function __construct(HTTP_Request $request)
    {
        $this->_request = $request;

        $this->_parseRequest();
        
        if ($this->_isError() == true) {
            $exception = new Services_Yahoo_Exception("Auction query failed");
            $exception->addErrors($this->_getMessages());

            throw $exception;
        }
    }

    // {{{ response handling

    /**
     * Get number of result sets returned by the content analysis
     *
     * @return integer Number of result sets returned
     */
    public function getTotalResultsReturned()
    {
        return count((array)$this->xml->{$this->_indexkey});
    }

    /**
     * Get the HTTP_Request instance that was used for the query
     *
     * Access to the HTTP_Request instance is useful for introspecting
     * into the request details.  (E.g. for getting the HTTP response
     * code.)
     *
     * @return object HTTP_Request Instance of HTTP_Request
     */
    public function getRequest()
    {
        return $this->_request;
    }

    // }}}
    // {{{ Iterator implementation

    /**
     * get current result of response
     *
     * @return array current result of response 
     */
    public function current()
    {
        return (array)$this->xml->{$this->_indexkey}[$this->_iteratorCounter];
    }

    /**
     * get next result of response
     *
     * @return array next result of response 
     */
    public function next()
    {
        $this->_iteratorCounter++;
        if (!isset($this->xml->{$this->_indexkey}[$this->_iteratorCounter])) {
            $this->_isValidIterator = false;
        }
    }

    /**
     * get counter for iterator
     *
     * @return string counter
     */
    public function key()
    {
        return $this->_iteratorCounter;
    }

    /**
     * clear counter for  iterator
     *
     * @return void
     */
    public function rewind()
    {
        $this->_iteratorCounter = 0;
    }

    /**
     * get validate status
     *
     * @return bool validate status
     */
    public function valid()
    {
        return $this->_isValidIterator;
    }

    // }}}
    // {{{ private methods

    /**
     * Parse XML from the response
     *
     * @throws Services_Yahoo_Exception
     *
     * @return void
     */
    private function _parseRequest()
    {
        $this->xml = simplexml_load_string($this->_request->getResponseBody());

        if ($this->xml === false) {
            throw new 
                Services_Yahoo_Exception("The response contained no valid XML");
        }
    }

    /**
     * Determine if an error was returned by the Yahoo API
     *
     * This method evaluates the HTTP response code. If it indicates
     * an error, the method returns true.
     *
     * @return boolean  True on error, otherwise false.
     */
    private function _isError()
    {
        return in_array($this->_request->getResponseCode(),
                   array(400, 403, 404, 503));
    }

    /**
     * Get all error messages if the response contained an error
     *
     * Returns all errors in an numerically indexed array that were 
     * part of the response.
     *
     * @see    _isError()
     * @return array
     */
    private function _getMessages()
    {
        $returnValue = array();
        foreach ($this->xml->Message as $message) {
            $returnValue[] = $message;
        }
        return $returnValue;
    }

    /**
     * Set Key for Response Loop Field
     *
     * @param string $key key for loop in result
     *
     * @return void
     */
    public function setIndexKey($key)
    {
        return $this->_indexkey = $key;
    }

    /**
     * get Attribute
     *
     * @param string $name key in result
     *
     * @return string value of attribute
     */
    public function returnAttribute($name)
    {
        if (isset($this->xml[$name])) {
            return $this->xml[$name];
        }

        return null;
    }
    // }}}
}
