<?php


class Magenz_Shippingperproduct_Model_System_Config_Magentoattributes
{
    public function toOptionArray() {
        $type = Mage::getModel('eav/entity_type')->loadByCode(Mage_Catalog_Model_Product::ENTITY);
        $attributes = Mage::getResourceModel('eav/entity_attribute_collection')->setEntityTypeFilter($type);

        //$result[] = array('value' => 'qty', 'label' =>  'qty');

        foreach ($attributes as $attribute){
            if (!empty($attribute->getFrontendLabel()))
                $result[] = array('value' =>  $attribute->getFrontendLabel(), 'label' =>  $attribute->getFrontendLabel());
        }

        return $result;
    }
}