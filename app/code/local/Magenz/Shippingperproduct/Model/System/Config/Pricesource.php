<?php


class Magenz_Shippingperproduct_Model_System_Config_Pricesource
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => 'none',
                'label' => '-- Select one --',
            ),
            array(
                'value' => 'customattribute',
                'label' => 'From Custom Attribute',
            ),
            array(
                'value' => 'fix',
                'label' => 'Fix shipping cost for every product',
            ),
            array(
                'value' => 'itempricebased',
                'label' => 'Based on item sold price',
            )

        );
    }
}