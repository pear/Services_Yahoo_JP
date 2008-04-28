<?php
/**
 * Image search class
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
require_once 'Services/Yahoo/Search/image.php';

/**
 * Image search class
 *
 * This class implements an interface to Yahoo's image search by using
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
class Services_Yahoo_JP_Search_Image
        extends Services_Yahoo_Search_image
{
    /**
     * api url
     *
     * @access protected
     * @var    string
     */
    protected $requestURL_JP =
        'http://api.search.yahoo.co.jp/ImageSearchService/V1/imageSearch';

    /**
     * Constructor to set a api url
     */
    public function __construct()
    {
        $this->requestURL = $this->requestURL_JP;
    }
}
?>
