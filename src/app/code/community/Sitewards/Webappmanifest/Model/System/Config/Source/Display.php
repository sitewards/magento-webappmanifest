<?php

/**
 * @category    Sitewards
 * @package     Sitewards_Webappmanifest
 * @copyright   Copyright (c) Sitewards GmbH (http://www.sitewards.com/)
 */
class Sitewards_Webappmanifest_Model_System_Config_Source_Display
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array(
                'value' => 'fullscreen',
                'label' => Mage::helper('sitewards_webappmanifest')->__('Full Screen')),
            array(
                'value' => 'standalone',
                'label' => Mage::helper('sitewards_webappmanifest')->__('Standalone')),
            array(
                'value' => 'minimal-ui',
                'label' => Mage::helper('sitewards_webappmanifest')->__('Minimal UI')),
            array(
                'value' => 'browser',
                'label' => Mage::helper('sitewards_webappmanifest')->__('Browser')),
            );
    }
}
