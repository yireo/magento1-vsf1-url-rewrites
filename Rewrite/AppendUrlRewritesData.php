<?php
declare(strict_types=1);

/**
 * Class Yireo_VueStorefrontIndexerUrlRewrites_Rewrite_AppendUrlRewritesData
 */
class Yireo_VueStorefrontIndexerUrlRewrites_Rewrite_AppendUrlRewritesData extends \Divante_VueStorefrontIndexer_Model_Resource_Catalog_Product
{
    /**
     * @param int $storeId
     * @param array $productIds
     * @param int $fromId
     * @param int $limit
     * @return array
     */
    public function getProducts($storeId = 1, array $productIds = [], $fromId = 0, $limit = 1000)
    {
        $urlRewritesModel = $this->getUrlRewritesModel();
        $products = parent::getProducts($storeId, $productIds, $fromId, $limit);
        foreach ($products as &$product) {
            $product['url_rewrites'] = $urlRewritesModel->getUrlRewritesByProductId((int)$product['entity_id'], (int)$storeId);
        }

        return $products;
    }

    /**
     * @return Yireo_VueStorefrontIndexerUrlRewrites_Model_UrlRewrites
     */
    private function getUrlRewritesModel(): Yireo_VueStorefrontIndexerUrlRewrites_Model_UrlRewrites
    {
        return Mage::getModel('vsf_indexer_url_rewrites/urlRewrites');
    }
}
