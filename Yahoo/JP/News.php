<?php
/**
 * News dispatcher
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

require_once "Services/Yahoo/Exception.php";

/**
 * News dispatcher class
 *
 * This class provides a method to create a concrete instance of one
 * of the supported News types (topics).
 *
 * @category  Services
 * @package   Services_Yahoo_JP
 * @author    Tetsuya Nakase <phpizer@gmail.com>
 * @copyright 2008 Tetsuya Nakase
 * @license   http://www.opensource.org/licenses/bsd-license.php BSD
 * @version   Release: 0.0.1
 * @link      http://phpize.net
 */
class Services_Yahoo_JP_News
{
    /**
     * Attempts to return a concrete instance of a News class
     *
     * @param string $type Can be one of topics.
     *
     * @return  object Concrete instance of a News class based on the paramter
     * @throws  Services_Yahoo_Exception
     */
    public function factory($type)
    {
        switch ($type) {
        case 'topics' :
            include_once 'Services/Yahoo/JP/News/' . $type . '.php';
            $classname = 'Services_Yahoo_JP_News_' . ucfirst($type);
            return new $classname;
        default :
            throw new Services_Yahoo_Exception('Unknown news type ' . $type);
            break;
        }
    }
}
?>
