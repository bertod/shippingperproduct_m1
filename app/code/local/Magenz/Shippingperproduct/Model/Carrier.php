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

        //$handling = Mage::getStoreConfig('carriers/'.$this->_code.'/handling');
        $result = Mage::getModel('shipping/rate_result');
        $show = true;
        if($show){ // This if condition is just to demonstrate how to return success and error in shipping methods

            $method = Mage::getModel('shipping/rate_result_method');
            $method->setCarrier($this->_code);
            $method->setMethod($this->_code);
            $method->setCarrierTitle($this->getConfigData('title'));
            $method->setMethodTitle($this->getConfigData('name'));
            $price = $this->getConfigData('baseprice');
            $order_total = $request->getPackageValue();
            switch ($this->getConfigData('shippingpricesource')){
                case "customattribute":
                    $items = $request->getAllItems();
                    # $price += $this->getCustomAttributePrice($items);
                    break;
                case "fix":
                    $shipprice = $this->getConfigData('shippingfixprice');
                    if(!empty($shipprice))
                        $price += floatval($shipprice);
                    break;
                case "itempricebased":
                    $price += $this->getItemBasedPrice($order_total);
                    break;
            }

            #$price = $price + ($request->getPackageValue()*5/100);
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

    public function getItemBasedPrice($order_total){
        $increment_type = $this->getConfigData('itempriceincrement');
        $price_to_add = 0;
        switch ($increment_type){
            case "percentage":
                $price_to_add = floatval($this->getConfigData('percentagepriceincrement'))*$order_total/100;
                break;
            case "none":
            case "math":
                break;

        }
        return $price_to_add;
    }
}