<?php

/**
 * @category    Sitewards
 * @package     Sitewards_Webappmanifest
 * @copyright   Copyright (c) Sitewards GmbH (http://www.sitewards.com/)
 */
class Sitewards_Webappmanifest_Model_Manifest extends Mage_Core_Model_Abstract implements JsonSerializable
{
    /**
     * @var array
     */
    private $aManifestData = [];

    /**
     * Sitewards_Webappmanifest_Model_Manifest constructor.
     */
    protected function _construct()
    {
        $this->aManifestData['name']             = Mage::getStoreConfig('general/store_information/name');
        $this->aManifestData['lang']             = Mage::app()->getLocale()->getLocaleCode();
        $this->aManifestData['manifest_version'] = '2';
        $this->aManifestData['start_url']        = '/';

        /** @var Sitewards_Webappmanifest_Model_Icons $oIconModel */
        $oIconModel = Mage::getModel('sitewards_webappmanifest/icons');
        $aIcons     = $oIconModel->getIconArray();

        if (!empty($aIcons)) {
            $this->aManifestData['icons'] = $aIcons;
        }

        $this->loadConfigurableOptions();
    }

    /**
     * @return void
     */
    private function loadConfigurableOptions()
    {
        $aSettings = Mage::getStoreConfig('webappmanifest/settings');
        foreach ($aSettings as $sKey => $mSetting) {
            if (!is_array($mSetting)) {
                $this->aManifestData[$sKey] = $mSetting;
                continue;
            }

            $this->aManifestData[$sKey] = array_values($mSetting);
        }
    }

    /**
     * @return array
     */
    public function getManifestData()
    {
        return $this->aManifestData;
    }

    /**
     * @return string
     */
    public function jsonSerialize()
    {
        return $this->getManifestData();
    }
}