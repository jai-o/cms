<?php
namespace craft\app\cache;

/**
 * ApcCache provides APC caching in terms of an application component.
 *
 * The caching is based on [APC](http://www.php.net/apc). To use this application component, the APC PHP extension
 * must be loaded.
 *
 * @author    Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @copyright Copyright (c) 2014, Pixel & Tonic, Inc.
 * @license   http://buildwithcraft.com/license Craft License Agreement
 * @see       http://buildwithcraft.com
 * @package   craft.app.cache
 * @since     3.0
 */
class ApcCache extends \CApcCache
{

}
