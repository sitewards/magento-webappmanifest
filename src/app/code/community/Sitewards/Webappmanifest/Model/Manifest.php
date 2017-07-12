<?php
/**
 * @category    Sitewards
 * @package     Sitewards_Webappmanifest
 * @copyright   Copyright (c) Sitewards GmbH (http://www.sitewards.com/)
 */
class Sitewards_Webappmanifest_Model_Manifest extends Mage_Core_Model_Abstract
{
    /**
     * @return string
     */
    public function getManifestJson()
    {
        return Zend_Json_Encoder::encode([
            'name'      => Mage::getStoreConfig('general/store_information/name'),
            'start_url' => '/',
        ]);
    }
}