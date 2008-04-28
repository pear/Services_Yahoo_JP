<?php
/**
 * Search dispatcher
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

require_once 'Services/Yahoo/Search.php';

/**
 * Search dispatcher class
 *
 * This class provides a method to create a concrete instance of one
 * of the supported search types (Web, Images, Videos).
 *
 * @category  Services
 * @package   Services_Yahoo_JP
 * @author    Tetsuya Nakase <phpizer@gmail.com>
 * @copyright 2008 Tetsuya Nakase
 * @license   http://www.opensource.org/licenses/bsd-license.php BSD
 * @version   Release: 0.0.1
 * @link      http://phpize.net
 */
class Services_Yahoo_JP_Search extends Services_Yahoo_Search
{
    /**
     * Attempts to return a concrete instance of a search class
     *
     * @param string $type Can be one of web, image or video
     *
     * @return  object Concrete instance of a search class based on the paramter
     * @throws  Services_Yahoo_Exception
     */
    public function factory($type)
    {
        switch ($type) {
        case 'web' :
        case 'image' :
        case 'video' :
            include_once 'Services/Yahoo/JP/Search/' . $type . '.php';
            $classname = 'Services_Yahoo_JP_Search_' . ucfirst($type);
            return new $classname;
        default :
            throw new Services_Yahoo_Exception('Unknown search type ' . $type);
            break;
        }
    }
}
?>
