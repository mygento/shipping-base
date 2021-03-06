<?php
/**
 * @author Mygento
 * @copyright 2017 Mygento (https://www.mygento.ru)
 * @package Mygento_Shipment
 */

namespace Mygento\Shipment\Plugin;

class ExtShippingMethodManagement
{
    protected $shippingExtAttr;

    public function __construct(
        \Magento\Quote\Api\Data\ShippingMethodExtensionFactory $shippingExtAttr
    ) {
        $this->shippingExtAttr = $shippingExtAttr;
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterModelToDataObject(
        \Magento\Quote\Model\Cart\ShippingMethodConverter $subject,
        $result,
        \Magento\Quote\Model\Quote\Address\Rate $rateModel
    ) {
        $extensionAttributes =
            $result->getExtensionAttributes()
            ?? $this->shippingExtAttr->create();
        $extensionAttributes->setEstimate($rateModel->getEstimate());
        $extensionAttributes->setLatitude($rateModel->getLatitude());
        $extensionAttributes->setLongitude($rateModel->getLongitude());
        $result->setExtensionAttributes($extensionAttributes);

        return $result;
    }
}
