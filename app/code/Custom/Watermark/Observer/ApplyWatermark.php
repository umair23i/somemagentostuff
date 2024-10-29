<?php
namespace Custom\Watermark\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Custom\Watermark\Model\WatermarkProcessor;

class ApplyWatermark implements ObserverInterface
{
    protected $watermarkProcessor;

    public function __construct(WatermarkProcessor $watermarkProcessor)
    {
        $this->watermarkProcessor = $watermarkProcessor;
    }

    public function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        foreach ($product->getMediaGalleryImages() as $image) {
            $this->watermarkProcessor->applyWatermark($image->getPath());
        }
    }
}
