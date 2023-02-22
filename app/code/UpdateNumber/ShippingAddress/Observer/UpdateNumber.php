<?php

declare(strict_types=1);

namespace UpdateNumber\ShippingAddress\Observer;

use Psr\Log\LoggerInterface;

/**
 * UpdateNumberInShippingAddress Class
 */
class UpdateNumber implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     * @throws \Magento\Framework\Exception\AuthorizationException
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        try {
            $order = $observer->getEvent()->getOrder();
            $shippingAddress = $order->getshippingAddress();
            $shippingAddress->setTelephone("+920123456789")->save();
            $order->setShippingAddress($shippingAddress);
            $order->save();
        } catch (\Exception $exception) {
            $this->logger->critical($exception);
        }

    }
}
