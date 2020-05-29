<?php
declare(strict_types=1);

/**
 * Class Yireo_VueStorefrontIndexerUrlRewrites_Model_UrlRewrites
 */
class Yireo_VueStorefrontIndexerUrlRewrites_Model_UrlRewrites
{
    /**
     * @param int $product
     * @param int $storeId
     * @return array
     */
    public function getUrlRewritesByProductId(int $productId, int $storeId): array
    {
        $productUrlRewrites = [];
        $urlRewrites = $this->getAllUrlRewrites($storeId);
        foreach($urlRewrites as $urlRewrite) {
            if ($urlRewrite['id_path'] === 'product/'.$productId) {
                $productUrlRewrites[] = $urlRewrite['request_path'];
            }

            if (strstr($urlRewrite['id_path'], 'product/'.$productId.'/')) {
                $productUrlRewrites[] = $urlRewrite['request_path'];
            }
        }

        return $productUrlRewrites;
    }

    /**
     * @param int $storeId
     * @return string[]
     */
    public function getAllUrlRewrites(int $storeId): array
    {
        static $allUrlRewrites = [];
        if (!empty($allUrlRewrites)) {
            return $allUrlRewrites;
        }

        $collection = Mage::getModel('core/url_rewrite')->getCollection();
        $collection->addFieldToSelect(['id_path', 'request_path']);
        $collection->addFieldToFilter('store_id', $storeId);
        $allUrlRewrites = [];
        foreach($collection as $item) {
            /** @var $item Varien_Object */
            $allUrlRewrites[] = $item->getData();
        }

        return $allUrlRewrites;
    }
}
