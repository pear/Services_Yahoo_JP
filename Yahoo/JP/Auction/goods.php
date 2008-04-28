<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Auction goods class
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

require_once 'AbstractAuction.php';

/**
 * Services_Yahoo_JP_Auction_goods
 *
 * This class implements an interface to Yahoo! JAPAN's Cateogry Tree by using
 * the Yahoo API.
 *
 * @category  Services
 * @package   Services_Yahoo_JP
 * @author    Tetsuya Nakase <phpizer@gmail.com>
 * @copyright 2008 Tetsuya Nakase
 * @license   http://www.opensource.org/licenses/bsd-license.php BSD
 * @version   Release: 0.0.1
 * @link      http://phpize.net
 */
class Services_Yahoo_JP_Auction_Goods
    extends Services_Yahoo_JP_Auction_AbstractAuction
{
    /**
     * api url
     *
     * @access protected
     * @var    string
     */
    protected $requestURL =
        'http://api.auctions.yahoo.co.jp/AuctionWebService/V1/CategoryLeaf';

    /**
     * submit
     * This is override function in Services_Yahoo_JP_Auction_AbstractAuction.
     *
     * @return array A goods list.
     */
    public function submit()
    {
        $res = parent::submit();
        $res->setIndexKey('item');
        return $res;
    }
}
?>
