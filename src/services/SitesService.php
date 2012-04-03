<?php
namespace Blocks;

/**
 *
 */
class SitesService extends Component
{
	private $_currentSite;
	private $_licenseKeyStatus;

	/**
	 * @return array|null
	 */
	public function getLicenseKeys()
	{
		$keysArr = array();
		$licenseKeys = LicenseKey::model()->findAll();

		foreach ($licenseKeys as $licenseKey)
			$keysArr[] = $licenseKey->license_key;

		if (count($keysArr) > 0)
			return $keysArr;

		return null;
	}

	/**
	 * @return string|null
	 */
	public function getSiteName()
	{
		if (isset(b()->params['config']['siteName']))
			return b()->params['config']['siteName'];

		return null;
	}

	/**
	 * @return string|null
	 */
	public function getSiteLanguage()
	{
		if (isset(b()->params['config']['language']))
			return b()->params['config']['language'];

		return null;
	}

	/**
	 * @return string|null
	 */
	public function getSiteUrl()
	{
		if (isset(b()->params['config']['siteUrl']))
			return b()->params['config']['siteUrl'];

		return null;
	}

	/**
	 * Gets the current site model by Url
	 * @return Site
	 */
	public function getCurrent()
	{
		if ($this->_currentSite === null)
		{
			// Try to find the site that matches the request URL
			$serverName = b()->request->serverName;
			$httpServerName = 'http://'.$serverName;
			$httpsServerName = 'https://'.$serverName;

			$site = Site::model()->find(
				'url=:url OR url=:httpUrl OR url=:httpsUrl', array(':url' => $serverName, ':httpUrl' => $httpServerName, ':httpsUrl' => $httpsServerName)
			);

			// Get the primary site if we can't find a site with a URL match
			if (!$site)
			{
				$site = Site::model()->findByAttributes(array(
					'primary' => true
				));
			}

			$this->_currentSite = $site;
		}

		return $this->_currentSite;
	}

	/**
	 * @param Site $site
	 */
	public function setCurrentSite($site)
	{
		$this->_currentSite = $site;
	}

	/**
	 * Returns all sites
	 * @return mixed
	 */
	public function getAll()
	{
		return Site::model()->findAll();
	}

	/**
	 * @param $url
	 * @return Site
	 */
	public function getSiteByUrl($url)
	{
		$url = ltrim('http://', $url);
		$url = ltrim('https://', $url);

		$httpServerName = 'http://'.$url;
		$httpsServerName = 'https://'.$url;

		$site = Site::model()->find(
			'url=:url OR url=:httpUrl OR url=:httpsUrl', array(':url' => $url, ':httpUrl' => $httpServerName, ':httpsUrl' => $httpsServerName)
		);

		return $site;
	}

	/**
	 * @param $id
	 * @return Site
	 */
	public function getSiteById($id)
	{
		$site = Site::model()->findById($id);
		return $site;
	}

	/**
	 * @param $handle
	 * @return Site
	 */
	public function getSiteByHandle($handle)
	{
		$site = Site::model()->findByAttributes(array(
			'handle' => $handle,
		));

		return $site;
	}

	/**
	 * @return string
	 */
	public function getLicenseKeyStatus()
	{
		$licenseKeyStatus = b()->fileCache->get('licenseKeyStatus');
		if ($licenseKeyStatus == false)
			$licenseKeyStatus = $this->_getLicenseKeyStatus();

		return $licenseKeyStatus;
	}

	/**
	 * @return mixed
	 */
	public function getPrimarySite()
	{
		$site = Site::model()->findByAttributes(array(
			'primary' => 1
		));

		return $site;
	}

	/**
	 * @param $licenseKeyStatus
	 */
	public function setLicenseKeyStatus($licenseKeyStatus)
	{
		// cache it and set it to expire according to config
		b()->fileCache->set('licenseKeyStatus', $licenseKeyStatus, b()->config->cacheTimeSeconds);
	}

	/**
	 * @access private
	 * @return string
	 */
	private function _getLicenseKeyStatus()
	{
		$licenseKeys = b()->sites->licenseKeys;

		if (!$licenseKeys)
			return LicenseKeyStatus::MissingKey;

		$package = b()->et->ping();
		$licenseKeyStatus = isset($package->licenseKeyStatus) ? $package->licenseKeyStatus : $licenseKeyStatus = LicenseKeyStatus::InvalidKey;

		$this->setLicenseKeyStatus($licenseKeyStatus);
		return $licenseKeyStatus;
	}
}
