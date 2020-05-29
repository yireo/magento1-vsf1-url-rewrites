<?php
declare(strict_types=1);

use Divante_VueStorefrontIndexer_Api_Mapping_FieldInterface as FieldInterface;

/**
 * Class Yireo_VueStorefrontIndexerUrlRewrites_Observer_AppendUrlRewritesMapping
 */
class Yireo_VueStorefrontIndexerUrlRewrites_Observer_AppendUrlRewritesMapping
{
    /**
     * @param Varien_Event_Observer $observer
     */
    public function execute(Varien_Event_Observer $observer)
    {
        /** @var $mappedObject Varien_Object */
        $mappedObject = $observer->getEvent()->getMapping();
        $properties = $mappedObject->getData('properties');
        $properties['url_rewrites'] = ['type' => FieldInterface::TYPE_TEXT];
        $mappedObject->setData('properties', $properties);
    }
}
