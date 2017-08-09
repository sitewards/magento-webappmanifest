<?php

/**
 * @category    Sitewards
 * @package     Sitewards_Webappmanifest
 * @copyright   Copyright (c) Sitewards GmbH (http://www.sitewards.com/)
 */
class Sitewards_Webappmanifest_Model_Icons
{
    const S_IMAGE_TYPE       = 'image/png';
    const S_ICON_CONFIG_PATH = 'webappmanifest/icon/path';

    /**
     * @var array $aManifestIconSizes
     */
    private $aManifestIconSizes = [
        72,
        96,
        128,
        144,
        152,
        192,
        384,
        512,
    ];

    /**
     * @param string $sScope
     *
     * @return string
     */
    private function getStoragePath($sScope)
    {
        return Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA) . DS . 'manifest' . DS . $sScope . DS;
    }

    /**
     * @param string $sFileName
     * @param string $sSize
     *
     * @return string
     */
    private function getResizedImageUrl($sFileName, $sSize)
    {
        $sScope        = Mage::getSingleton('adminhtml/config_data')->getStore();
        $sDefaultScope = Mage::app()->getDefaultStoreView()->getCode();
        $sStoragePath  = $this->getStoragePath($sScope);

        // check if we have a image on the current scope, if not try default
        $sBasePath = $sStoragePath . $sFileName;
        if (!file_exists($sBasePath)) {
            $sStoragePath = $this->getStoragePath($sDefaultScope);
            $sBasePath    = $sStoragePath . $sFileName;
        }

        $sNewPath = $sStoragePath . $sSize . 'x' . $sSize . '_' . $sFileName;
        if (file_exists($sBasePath) && is_file($sBasePath) && !file_exists($sNewPath)) {
            $oImageObj = new Varien_Image($sBasePath);
            $oImageObj->constrainOnly(true);
            $oImageObj->keepAspectRatio(false);
            $oImageObj->keepFrame(false);
            $oImageObj->resize($sSize, $sSize);
            $oImageObj->save($sNewPath);
        }

        return $sNewPath;
    }

    /**
     * @return array
     */
    public function getIconArray()
    {
        $sFileName = Mage::getStoreConfig(self::S_ICON_CONFIG_PATH);
        $aIcons    = [];

        if (empty($sFileName)) {
            return $aIcons;
        }

        foreach ($this->aManifestIconSizes as $iIconSize) {
            $aIcons[] = [
                'src'   => $this->getResizedImageUrl($sFileName, $iIconSize),
                'sizes' => $iIconSize . 'x' . $iIconSize,
                'type'  => self::S_IMAGE_TYPE,
            ];
        }

        return $aIcons;
    }
}
