<?php
namespace craft\app\events;

/**
 * Event class.
 *
 * @author    Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @copyright Copyright (c) 2014, Pixel & Tonic, Inc.
 * @license   http://buildwithcraft.com/license Craft License Agreement
 * @see       http://buildwithcraft.com
 * @package   craft.app.events
 * @since     3.0
 */
class Event extends \CEvent
{
	// Properties
	// =========================================================================

	/**
	 * @var bool Whether the caller should go through with the action.
	 */
	public $performAction = true;
}
