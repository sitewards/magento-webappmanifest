<?php

/**
 * @category    Sitewards
 * @package     Sitewards_Webappmanifest
 * @copyright   Copyright (c) Sitewards GmbH (http://www.sitewards.com/)
 */
class Sitewards_Webappmanifest_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * sends json response
     */
    public function indexAction()
    {
        /** @var Sitewards_Webappmanifest_Model_Manifest $oManifestModel */
        $oManifestModel = Mage::getModel('sitewards_webappmanifest/manifest');

        /** @var Mage_Core_Controller_Response_Http $oResponse */
        $oResponse = $this->getResponse();
        $oResponse->setHeader('Content-type', 'text/json');
        $oResponse->setBody($oManifestModel->getManifestJson());
    }
}