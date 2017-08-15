<?php

/**
 * @category    Sitewards
 * @package     Sitewards_Webappmanifest
 * @copyright   Copyright (c) Sitewards GmbH (http://www.sitewards.com/)
 */
class Sitewards_Webappmanifest_Model_Icons
{
    const S_IMAGE_TYPE       = 'image/png';
    const S_ICON_CONFIG_PATH = 'webappmanifest/icon/logo';

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
    private function getResizedImageUrl($sFileName, $sSize, $sScope)
    {
        $sStoragePath  = $this->getStoragePath($sScope);

        $sBasePath = $sStoragePath . $sFileName;

        $sNewPath = $sStoragePath . $sSize . 'x' . $sSize . '_' . $sFileName;
        if (file_exists($sBasePath) && is_file($sBasePath) && !file_exists($sNewPath)) {
            $oImageObj = new Varien_Image($sBasePath);
            $oImageObj->constrainOnly(true);
            $oImageObj->keepAspectRatio(false);
            $oImageObj->keepFrame(false);
            $oImageObj->resize($sSize, $sSize);
            $oImageObj->save($sNewPath);
        }

        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'manifest' . DS . $sScope . DS . $sSize . 'x' . $sSize . '_' . $sFileName;
    }

    /**
     * @return array
     */
    public function getIconArray()
    {
        /**
         * @var array<string,string> $aFilePath scope,filename
         */
        $aFilePath = explode('/', Mage::getStoreConfig(self::S_ICON_CONFIG_PATH));

        $sScope    = $aFilePath[0];
        $sFileName = $aFilePath[1];

        $aIcons    = [];

        if (empty($sFileName)) {
            return $aIcons;
        }

        foreach ($this->aManifestIconSizes as $iIconSize) {
            $aIcons[] = [
                'src'   => $this->getResizedImageUrl($sFileName, $iIconSize, $sScope),
                'sizes' => $iIconSize . 'x' . $iIconSize,
                'type'  => self::S_IMAGE_TYPE,
            ];
        }

        return $aIcons;
    }
}
