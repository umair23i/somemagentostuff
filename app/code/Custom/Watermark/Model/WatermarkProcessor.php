<?php
namespace Custom\Watermark\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Image\Factory as ImageFactory;

class WatermarkProcessor
{
    protected $scopeConfig;
    protected $imageFactory;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ImageFactory $imageFactory
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->imageFactory = $imageFactory;
    }

    public function applyWatermark($productImage)
    {
        $watermarkPath = $this->scopeConfig->getValue('custom_watermark/settings/watermark_image');
        $opacity = (int) $this->scopeConfig->getValue('custom_watermark/settings/opacity');
        $position = $this->scopeConfig->getValue('custom_watermark/settings/position');
        $width = (int) $this->scopeConfig->getValue('custom_watermark/settings/width');
        $height = (int) $this->scopeConfig->getValue('custom_watermark/settings/height');

        $image = $this->imageFactory->create($productImage);
        $image->setWatermarkPosition($position);
        $image->setWatermarkWidth($width);
        $image->setWatermarkHeight($height);
        $image->setWatermarkOpacity($opacity);
        $image->watermark($watermarkPath);
        $image->save($productImage);
    }
}
