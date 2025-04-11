<?php
namespace Themestar\Xcard\Block;

use Magento\Framework\View\Element\Template;
use Themestar\Xcard\Helper\Data;
use Magento\Framework\Registry;

class TwitterMeta extends Template
{
    protected $helper;
    protected $registry;

    public function __construct(
        Template\Context $context,
        Data $helper,
        Registry $registry,
        array $data = []
    ) {
        $this->helper = $helper;
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    public function getTwitterData()
    {
        if (!$this->helper->isEnabled()) {
            return [];
        }

        $title = $this->getPageTitle();
        $description = $this->getPageDescription();
        $cardType = $this->detectCardType();
        $fallbackImages = $this->helper->getFallbackImages();
        $mediaUrl = $this->getMediaUrl();

        $formattedFallbackImages = array_map(function($img) use ($mediaUrl) {
            return $mediaUrl . 'xcard/' . trim($img);
        }, $fallbackImages);

        $image = $this->getMainImage($formattedFallbackImages); // Includes CMS fallback logic

        return [
            'username' => $this->helper->getUsername(),
            'author' => $this->helper->getAuthor(),
            'card_type' => $cardType,
            'title' => $title,
            'description' => $description,
            'image' => $image,
            'fallback_images' => $formattedFallbackImages
        ];
    }

    protected function detectCardType()
    {
        if ($this->registry->registry('current_product')) {
            return $this->helper->getProductCardType();
        }
        if ($this->registry->registry('current_category')) {
            return $this->helper->getCategoryCardType();
        }
        if ($this->registry->registry('cms_page')) {
            return $this->helper->getCmsCardType();
        }
        return 'summary';
    }

    protected function getPageTitle()
    {
        return $this->pageConfig->getTitle()->get();
    }

    protected function getPageDescription()
    {
        foreach ($this->pageConfig->getMetadata() as $name => $content) {
            if ($name === 'description') {
                return $content;
            }
        }
        return '';
    }

    protected function getMediaUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    protected function getMainImage(array $fallbackImages)
{
    // Check if the current page is a product page
    if ($product = $this->registry->registry('current_product')) {
        $image = $product->getData('twitter_image') ?: $product->getImage();
        if ($image && $image != 'no_selection') {
            return $this->getMediaUrl() . 'catalog/product' . $image;
        }
    }

    // Check if the current page is a category page
    if ($category = $this->registry->registry('current_category')) {
        // If no category image, return fallback image
        return !empty($fallbackImages) ? $fallbackImages[0] : null;
    }

    // If it's a CMS page, return the first fallback image
    if ($this->registry->registry('cms_page')) {
        return !empty($fallbackImages) ? $fallbackImages[0] : null;
    }

    // Return fallback image if no other image is found
    return !empty($fallbackImages) ? $fallbackImages[0] : null;
}

}
