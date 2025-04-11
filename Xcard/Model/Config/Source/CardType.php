<?php
namespace Themestar\Xcard\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class CardType implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'summary', 'label' => __('Summary')],
            ['value' => 'summary_large_image', 'label' => __('Summary Large Image')],
            ['value' => 'app', 'label' => __('App')],
            ['value' => 'player', 'label' => __('Player')],
        ];
    }
}
