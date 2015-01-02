<?php
namespace craft\app\elementactions;

/**
 * View Element Action
 *
 * @author    Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @copyright Copyright (c) 2014, Pixel & Tonic, Inc.
 * @license   http://buildwithcraft.com/license Craft License Agreement
 * @link      http://buildwithcraft.com
 * @package   craft.app.elementactions
 * @since     3.0
 */
class View extends BaseElementAction
{
	// Public Methods
	// =========================================================================

	/**
	 * @inheritDoc ComponentTypeInterface::getName()
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->getParams()->label;
	}

	/**
	 * @inheritDoc ElementActionInterface::getTriggerHtml()
	 *
	 * @return string|null
	 */
	public function getTriggerHtml()
	{
		$js = <<<EOT
(function()
{
	var trigger = new Craft.ElementActionTrigger({
		handle: 'View',
		batch: false,
		validateSelection: function(\$selectedItems)
		{
			var \$element = \$selectedItems.find('.element');

			return (
				\$element.data('url') &&
				(\$element.data('status') == 'enabled' || \$element.data('status') == 'live')
			);
		},
		activate: function(\$selectedItems)
		{
			window.open(\$selectedItems.find('.element').data('url'));
		}
	});
})();
EOT;

		craft()->templates->includeJs($js);
	}

	// Protected Methods
	// =========================================================================

	/**
	 * @inheritDoc BaseElementAction::defineParams()
	 *
	 * @return array
	 */
	protected function defineParams()
	{
		return array(
			'label' => array(AttributeType::String, 'default' => Craft::t('View')),
		);
	}
}
