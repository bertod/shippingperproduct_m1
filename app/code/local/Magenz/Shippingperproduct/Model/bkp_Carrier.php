<?php

class Magenz_Shippingperproduct_Model_Carrier extends Mage_Shipping_Model_Carrier_Abstract
    implements Mage_Shipping_Model_Carrier_Interface {

    protected $_code = 'magenz_shippingperproduct';

    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        if (!Mage::getStoreConfig('carriers/'.$this->_code.'/active')) {
            Mage::log("NON SONO ATTIVATA! ",null,"magenz.log");
            return false;
        }

        Mage::log("SONO ATTIVATA! ",null,"magenz.log");

        $handling = Mage::getStoreConfig('carriers/'.$this->_code.'/handling');
        $result = Mage::getModel('shipping/rate_result');
        $show = true;
        if($show){ // This if condition is just to demonstrate how to return success and error in shipping methods

            $method = Mage::getModel('shipping/rate_result_method');
            $method->setCarrier($this->_code);
            $method->setMethod($this->_code);
            $method->setCarrierTitle($this->getConfigData('title'));
            $method->setMethodTitle($this->getConfigData('name'));
            $price = $this->getConfigData('baseprice') + ($request->getPackageValue()*5/100);
            # $method->setPrice($this->getConfigData('price'));
            $method->setPrice($price);
            $result->append($method);

        }else{
            $error = Mage::getModel('shipping/rate_result_error');
            $error->setCarrier($this->_code);
            $error->setCarrierTitle($this->getConfigData('name'));
            $error->setErrorMessage("Sorry, not available for u");
            #$error->setErrorMessage($this->getConfigData('specificerrmsg'));
            $result->append($error);
        }
        return $result;
    }
    public function getAllowedMethods()
    {
        return array('magenz_shippingperproduct'=>$this->getConfigData('name'));
    }
}