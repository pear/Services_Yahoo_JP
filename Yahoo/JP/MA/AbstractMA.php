<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Abstract MA class
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
 * @link      http://pear.php.net/package/Services_Yahoo
 */

require_once 'Services/Yahoo/JP/MA/Response.php';
require_once 'HTTP/Request.php';

/**
 * Abstract MA class
 *
 * This abstract class serves as the base class for all different
 * types of categories that available through Services_Yahoo.
 *
 * @category  Services
 * @package   Services_Yahoo_JP
 * @author    Tetsuya Nakase <phpizer@gmail.com>
 * @copyright 2008 Tetsuya Nakase
 * @license   http://www.opensource.org/licenses/bsd-license.php BSD
 * @version   Release: 0.0.1
 * @link      http://phpize.net
 */
abstract class Services_Yahoo_JP_MA_AbstractMA
{
    /**
     * parameter
     *
     * @access protected
     * @var    array
     */
    protected $parameters = array('appid' => 'PEAR_Services_Y_JP');

    /**
     * Submits the MA
     *
     * This method submits the MA and handles the response.  It
     * returns an instance of Services_Yahoo_Result which may be used
     * to further make use of the result.
     *
     * @return object Services_Yahoo_Response MA result
     * @throws Services_Yahoo_Exception
     */
    public function submit()
    {
        $url = $this->requestURL . '?';

        foreach ($this->parameters as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $value2) {
                    $url .= $key . '=' . urlencode($value2) . '&';
                }
                continue;
            }

            $url .= $key . '=' . urlencode($value) . '&';
        }

        $request = new HTTP_Request($url);

        $result = $request->sendRequest();
        if (PEAR::isError($result)) {
            throw new Services_Yahoo_Exception($result->getMessage());
        }

        return new Services_Yahoo_JP_MA_Response($request);
    }

    /**
     * Set Application ID
     *
     * An Application ID is a string that uniquely identifies your 
     * application. Think of it as like a User-Agent string. If you 
     * have multiple applications, you should use a different ID for 
     * each one. You can register your ID and make sure nobody is 
     * already using your ID on Yahoo's Application ID registration 
     * page.
     *
     * The ID defaults to "PEAR_Services_Y_JP", but you are free to
     * change it to whatever you want.  Please note that the access
     * to the Yahoo API is not limited via the Application ID but via
     * the IP address of the host where the package is used.
     *
     * @param string $id Application ID
     *
     * @return void
     */
    public function withAppID($id)
    {
        $this->parameters['appid'] = $id;
    }

    /**
     * Returns an element from the parameters
     *
     * @param string $name Name of the element
     *
     * @return string Value of the parameter
     */
    protected function getParameter($name)
    {
        if (isset($this->parameters[$name])) {
            return $this->parameters[$name];
        }

        return '';
    }

    /**
     * Set the Sentence
     *
     * @param string $sentence for Morphological Analysis
     *
     * @return void
     */
    public function setSentence($sentence)
    {
        $this->parameters['sentence'] = $sentence;
    }

    /**
     * Set the type of result
     *
     * @param string $results type 'ma' or 'uniq'
     *
     * @return void
     */
    public function setResults($results)
    {
        /* ma is default */
        $this->parameters['results'] = ( $results === 'uniq') ? 'uniq' : 'ma';
    }

    /**
     * Set the response field
     *
     * @param string $response field
     *
     * @return void
     */
    public function setResponse($response)
    {
        $this->parameters['response'] = $response;
    }

    /**
     * Set the ma response field
     *
     * @param string $maresponse type of response
     *
     * @return void
     */
    public function setMAResponse($maresponse)
    {
        $this->parameters['ma_response'] = $maresponse;
    }

    /**
     * Set the uniq response field
     *
     * @param string $uniqresponse tyep of response
     *
     * @return void
     */
    public function setUniqResponse($uniqresponse)
    {
        $this->parameters['uniq_response'] = $uniqresponse;
    }

    /**
     * Set the filter
     *
     * @param string $filter filter type
     *
     * @return void
     */
    public function setFileter($filter)
    {
        $this->parameters['filter'] = $filter;
    }

    /**
     * Set the MA filter
     *
     * @param string $mafilter ma filter type
     *
     * @return void
     */
    public function setMAFileter($mafilter)
    {
        $this->parameters['ma_filter'] = $mafilter;
    }

    /**
     * Set the UNIQ filter
     *
     * @param string $uniqfilter uniq filter type
     *
     * @return void
     */
    public function setUniqFileter($uniqfilter)
    {
        $this->parameters['uniq_filter'] = $uniqfilter;
    }

    /**
     * Set the Uniq_by_baseform
     *
     * @param string $ubbf uniq filter
     *
     * @return void
     */
    public function setUniqByBaseform($ubbf)
    {
        $this->parameters['uniq_by_baseform'] = $ubbf;
    }
}
?>
