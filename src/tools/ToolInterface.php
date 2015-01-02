<?php
namespace craft\app\tools;

use craft\app\components\ComponentTypeInterface;

/**
 * Interface ToolInterface
 *
 * @author    Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @copyright Copyright (c) 2014, Pixel & Tonic, Inc.
 * @license   http://buildwithcraft.com/license Craft License Agreement
 * @see       http://buildwithcraft.com
 * @package   craft.app.tools
 * @since     3.0
 */
interface ToolInterface extends ComponentTypeInterface
{
	// Public Methods
	// =========================================================================

	/**
	 * @inheritDoc ToolInterface::getIconValue()
	 *
	 * @return string
	 */
	public function getIconValue();

	/**
	 * Returns the tool's options HTML.
	 *
	 * @return string
	 */
	public function getOptionsHtml();

	/**
	 * Returns the tool's button label.
	 *
	 * @return string
	 */
	public function getButtonLabel();

	/**
	 * Performs the tool's action.
	 *
	 * @param array $params
	 *
	 * @return array
	 */
	public function performAction($params = array());
}
