<?php
namespace Academy\PickUpAtStore\Model\Carrier;

use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory;
use Psr\Log\LoggerInterface;
use Magento\Shipping\Model\Rate\ResultFactory;
use Magento\Quote\Model\Quote\Address\RateResult\MethodFactory;
use Magento\Checkout\Model\Session;
use Academy\PickUpAtStore\Helper\Data;

class PickUpShipping extends \Magento\Shipping\Model\Carrier\AbstractCarrier implements
    \Magento\Shipping\Model\Carrier\CarrierInterface
{
    protected $_code = 'storeshipping';
    protected $_rateResultFactory;
    protected $_scopeInterface;
    protected $_rateMethodFactory;
    protected $_checkoutSession;
    protected $_helper;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ErrorFactory $rateErrorFactory,
        LoggerInterface $logger,
        ResultFactory $rateResultFactory,
        MethodFactory $rateMethodFactory,
        Session $checkoutSession,
        Data $helper,
        array $data = []
    ) {
        $this->_checkoutSession = $checkoutSession;
        $this->_rateResultFactory = $rateResultFactory;
        $this->_rateMethodFactory = $rateMethodFactory;
        $this->_helper = $helper;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }

    public function getAllowedMethods()
    {
        return [$this->_code => $this->getConfigData('name')];
    }

    private function getShippingPrice()
    {
        $configPrice = $this->getConfigData('price');

        $shippingPrice = $this->getFinalPriceWithHandlingFee($configPrice);

        return $shippingPrice;
    }

    public function collectRates(RateRequest $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        $cartItems = $this->_checkoutSession->getQuote()->getAllVisibleItems();

        $stores = $this->_helper->getAllStores();
        $fastDeliveryStore = $this->_helper->getFastDeliveryStore($cartItems);

        if($stores){
            $result = $this->_rateResultFactory->create();

            foreach($stores as $key => $store){
                if(in_array($store->getId(), $fastDeliveryStore)){
                    $storeName = $store->getName() . " (Fast delivery)";
                } else {
                    $storeName = $store->getName() . " (" . $this->_helper->getConfigValue('carriers/storeshipping/wait_message') . ")";
                }
                $method = $this->_rateMethodFactory->create();

                $method->setCarrier($this->_code);
                $method->setCarrierTitle($this->getConfigData('title'));
                $method->setMethod($this->_code . $key);
                $method->setMethodTitle($storeName);
                $amount = $this->getShippingPrice();
                $method->setPrice($amount);
                $method->setCost($amount);
                $result->append($method);
            }

            return $result;
        }

        return false;
    }
}