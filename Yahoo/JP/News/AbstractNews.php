<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Abstract News class
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

require_once 'Services/Yahoo/JP/News/Response.php';
require_once 'HTTP/Request.php';

/**
 * Abstract News class
 *
 * This abstract class serves as the base class for all different
 * types of news that available through Services_Yahoo.
 *
 * @category  Services
 * @package   Services_Yahoo_JP
 * @author    Tetsuya Nakase <phpizer@gmail.com>
 * @copyright 2008 Tetsuya Nakase
 * @license   http://www.opensource.org/licenses/bsd-license.php BSD
 * @version   Release: 0.0.1
 * @link      http://phpize.net
 */
abstract class Services_Yahoo_JP_News_AbstractNews
{
    /**
     * parameter
     *
     * @access protected
     * @var    array
     */
    protected $parameters = array('appid' => 'PEAR_Services_Y_JP');

    /**
     * Submits the News
     *
     * This method submits the News and handles the response.  It
     * returns an instance of Services_Yahoo_Result which may be used
     * to further make use of the result.
     *
     * @return object Services_Yahoo_Response News result
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

        return new Services_Yahoo_JP_News_Response($request);
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
     * @return string Value of the parameter idenfied by $name
     */
    protected function getParameter($name)
    {
        if (isset($this->parameters[$name])) {
            return $this->parameters[$name];
        }

        return '';
    }

    /**
     * Set the word
     *
     * @param string $word Search word in Topics
     *
     * @return void
     */
    public function setWord($word)
    {
        $this->parameters['word'] = $word;
    }

    /**
     * Set the topicname
     *
     * @param string $topicname Search topics name
     *
     * @return void
     */
    public function setTopicname($topicname)
    {
        $this->parameters['topicname'] = $topicname;
    }

    /**
     * Set the category
     *
     * @param string $category Search category
     *
     * @return void
     */
    public function setCategory($category)
    {
        $this->parameters['category'] = $category;
    }

    /**
     * Set the topflg. It's only on the Yahoo!JAPAN's Top Page
     *
     * @return void
     */
    public function setTopflg()
    {
        $this->parameters['topflg'] = 1;
    }

    /**
     * Set the midashiflg. It has a midashi.
     *
     * @return void
     */
    public function setMidashiflg()
    {
        $this->parameters['midashiflg'] = 1;
    }

    /**
     * Set the relatedsite
     *
     * @param int $relatedsite It's a flag for showing related site
     *
     * @return void
     */
    public function setRelatedsite($relatedsite = 1)
    {
        $this->parameters['relatedsite'] = $relatedsite;
    }

    /**
     * Set the sorder
     *
     * @param string $order An order to sort.
     *
     * @return void
     */
    public function setOrder($order)
    {
        $this->parameters['order'] = $order;
    }

    /**
     * Set the sort
     *
     * @param string $sort An item to sort.
     *
     * @return void
     */
    public function setSort($sort)
    {
        $this->parameters['sort'] = $sort;
    }

    /**
     * Set the num
     *
     * @param int $num Appoint the indication number.
     *
     * @return void
     */
    public function setNum($num)
    {
        $this->parameters['num'] = $num;
    }
}
?>
