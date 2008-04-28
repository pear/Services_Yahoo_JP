<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Test Script for Services_Yahoo_JP
 *
 * Services_Yahoo_JP_Examples_01
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

require_once 'Services/Yahoo/JP/News.php';

try {
    $yahoo = Services_Yahoo_JP_News::factory('topics'); 
    $yahoo->withAppID('PEAR_Services_Y_JP');
    $yahoo->setWord('google');

    $result = $yahoo->submit(); 

    foreach ($result as $entry) {
        var_dump($entry);
    }
} catch (Services_Yahoo_Exception $e) {
    print('Error.');
}
?>
