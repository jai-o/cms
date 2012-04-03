<?php
namespace Blocks;

/**
 *
 */
class PluginUpdateInfo
{
	public $class;
	public $localVersion;
	public $latestVersion;
	public $status;
	public $displayName;
	public $notes;
	public $criticalUpdateAvailable;
	public $releases;

	/**
	 * @param null $properties
	 */
	function __construct($properties = null)
	{
		if ($properties == null)
			return;

		$this->handle = isset($properties['class']) ? $properties['class'] : null;
		$this->localVersion = isset($properties['localVersion']) ? $properties['localVersion'] : null;
		$this->latestVersion = isset($properties['latestVersion']) ? $properties['latestVersion'] : null;
		$this->status = isset($properties['status']) ? $properties['status'] : null;
		$this->displayName = isset($properties['displayName']) ? $properties['displayName'] : null;
		$this->notes = isset($properties['notes']) ? $properties['notes'] : null;
		$this->criticalUpdateAvailable = isset($properties['criticalUpdateAvailable']) ? $properties['criticalUpdateAvailable'] : null;

		if (isset($properties['pluginReleases']))
			foreach ($properties['pluginReleases'] as $pluginReleaseData)
				$this->pluginReleases[] = new PluginNewReleaseInfo($pluginReleaseData);
	}
}
