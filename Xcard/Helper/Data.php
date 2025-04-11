<?php
namespace Themestar\Xcard\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const CONFIG_PATH = 'xcard_settings/general/';

    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::CONFIG_PATH . $field,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function isEnabled()
    {
        return (bool) $this->getConfigValue('enabled');
    }

    public function getUsername()
    {
        return (string) $this->getConfigValue('username');
    }

    public function getAuthor()
    {
        return (string) $this->getConfigValue('author');
    }

    public function getCmsCardType()
    {
        return $this->getConfigValue('cms_card_type') ?: 'summary';
    }

    public function getCategoryCardType()
    {
        return $this->getConfigValue('category_card_type') ?: 'summary';
    }

    public function getProductCardType()
    {
        return $this->getConfigValue('product_card_type') ?: 'summary_large_image';
    }

    public function useThumbnail()
    {
        return (bool) $this->getConfigValue('use_thumbnail');
    }

    public function getFallbackImages()
    {
        $images = (string) $this->getConfigValue('fallback_image');
        if (empty($images)) {
            return [];
        }

        return array_filter(array_map('trim', explode(',', $images)));
    }
}
