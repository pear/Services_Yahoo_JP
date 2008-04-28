<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Abstract Auctio class
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

require_once 'Services/Yahoo/JP/Auction/Response.php';
require_once 'HTTP/Request.php';

/**
 * Abstract Auction class
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
abstract class Services_Yahoo_JP_Auction_AbstractAuction
{
    /**
     * parameter
     *
     * @access protected
     * @var    array
     */
    protected $parameters = array('appid' => 'PEAR_Services_Y_JP');

    /**
     * Submits the Auction
     *
     * This method submits the auction and handles the response.  It
     * returns an instance of Services_Yahoo_Result which may be used
     * to further make use of the result.
     *
     * @return object Services_Yahoo_Response Auction Tree result
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

        return new Services_Yahoo_JP_Auction_Response($request);
    }

    /**
     * Set Application ID for the Auction
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
     * @param string $id Application
     *
     * @return void
     */
    public function withAppID($id)
    {
        $this->parameters['appid'] = $id;
    }

    /**
     * Set the id to category for
     *
     * @param string $id to category for
     *
     * @return void
     */
    public function setCategory($id)
    {
        $this->parameters['category'] = $id;
    }

    /**
     * Set the page to auction
     *
     * @param string $page to auction
     *
     * @return void
     */
    public function setPage($page)
    {
        $this->parameters['page'] = $page;
    }

    /**
     * Set the store to auction
     *
     * @param string $store to auction
     *
     * @return void
     */
    public function setStore($store)
    {
        $this->parameters['store'] = $store;
    }

    /**
     * Set the escrow to auction
     *
     * @return void
     */
    public function setEscrow()
    {
        $this->parameters['escrow'] = 1;
    }

    /**
     * Set the easypayment to auction
     *
     * @return void
     */
    public function setEasypayment()
    {
        $this->parameters['easypayment'] = 1;
    }

    /**
     * Set the new to auction
     *
     * @return void
     */
    public function setNew()
    {
        $this->parameters['new'] = 1;
    }

    /**
     * Set the largeimg to auction
     *
     * @return void
     */
    public function setLargeimg()
    {
        $this->parameters['largeimg'] = 1;
    }

    /**
     * Set the freeshipping to auction
     *
     * @return void
     */
    public function setFreeshipping()
    {
        $this->parameters['freeshipping'] = 1;
    }

    /**
     * Set the wrappingicon to auction
     *
     * @return void
     */
    public function setWrappingicon()
    {
        $this->parameters['wrappingicon'] = 1;
    }

    /**
     * Set the buynow to auction
     *
     * @return void
     */
    public function setBuynow()
    {
        $this->parameters['buynow'] = 1;
    }

    /**
     * Set the thumbnail to auction
     *
     * @param string $thumbnail to auction
     *
     * @return void
     */
    public function setThumbnail($thumbnail = 1)
    {
        $this->parameters['thumbnail'] = $thumbnail;
    }

    /**
     * Set the attn to auction
     *
     * @param string $attn to auction
     *
     * @return void
     */
    public function setAttn($attn = 1)
    {
        $this->parameters['attn'] = $attn;
    }

    /**
     * Set the gift_icon to auction
     *
     * @param string $gift_icon to auction
     *
     * @return void
     */
    public function setGiftIcon($gift_icon)
    {
        $this->parameters['gift_icon'] = $gift_icon;
    }

    /**
     * Set the sort to auction
     *
     * @param string $sort to auction
     *
     * @return void
     */
    public function setSort($sort)
    {
        $this->parameters['sort'] = $sort;
    }

    /**
     * Set the order to auction
     *
     * @param string $order to auction
     *
     * @return void
     */
    public function setOrder($order)
    {
        $this->parameters['order'] = $order;
    }

    /**
     * Set the sellerID to auction
     *
     * @param string $seller to auction
     *
     * @return void
     */
    public function setSellerID($seller)
    {
         $this->parameters['sellerID'] = $seller;
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
}
?>
