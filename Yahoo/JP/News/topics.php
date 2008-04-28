<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * News topics class
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
 * @author    Nakase Tetsuya <phpizer@gmail.com>
 * @copyright 2008 Nakase Tetsuya
 * @license   http://www.opensource.org/licenses/bsd-license.php BSD
 * @version   CVS: $Id$
 * @link      http://phpize.net
 */

require_once 'AbstractNews.php';

/**
 * Services_Yahoo_JP_News_topics
 *
 * This class implements an interface to Yahoo! JAPAN's Cateogry Tree by using
 * the Yahoo API.
 *
 * @category  Services
 * @package   Services_Yahoo_JP
 * @author    Nakase Tetsuya <phpizer@gmail.com>
 * @copyright 2008 Nakase Tetsuya
 * @license   http://www.opensource.org/licenses/bsd-license.php BSD
 * @version   Release: 0.0.1
 * @link      http://phpize.net
 */
class Services_Yahoo_JP_News_Topics extends Services_Yahoo_JP_News_AbstractNews
{
    /**
     * api url
     *
     * @access protected
     * @var    string
     */
    protected $requestURL = 'http://api.news.yahoo.co.jp/NewsWebService/V1/Topics';
}
?>
