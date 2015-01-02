<?php
namespace craft\app\models;

use craft\app\enums\AttributeType;

/**
 * Class AssetTransformIndex model.
 *
 * @author    Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @copyright Copyright (c) 2014, Pixel & Tonic, Inc.
 * @license   http://buildwithcraft.com/license Craft License Agreement
 * @see       http://buildwithcraft.com
 * @package   craft.app.models
 * @since     3.0
 */
class AssetTransformIndex extends BaseModel
{
	// Public Methods
	// =========================================================================

	/**
	 * Use the folder name as the string representation.
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->id;
	}

	// Protected Methods
	// =========================================================================

	/**
	 * @inheritDoc BaseModel::defineAttributes()
	 *
	 * @return array
	 */
	protected function defineAttributes()
	{
		return array(
			'id'             => AttributeType::Number,
			'fileId'         => AttributeType::Number,
			'filename'       => AttributeType::Number,
			'format'         => AttributeType::Number,
			'location'       => AttributeType::String,
			'sourceId'       => AttributeType::Number,
			'fileExists'     => AttributeType::Bool,
			'inProgress'     => AttributeType::Bool,
			'dateIndexed'    => AttributeType::DateTime,
			'dateUpdated'    => AttributeType::DateTime,
			'dateCreated'    => AttributeType::DateTime,

			// Format detected for auto transform
			'detectedFormat' => AttributeType::Number,

			// The AssetTransformModel that defines the transformation to make
			'transform'      => AttributeType::Mixed
		);
	}
}
