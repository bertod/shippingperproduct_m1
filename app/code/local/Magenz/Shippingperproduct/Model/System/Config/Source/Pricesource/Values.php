<?php


class Magenz_Shippingperproduct_Model_System_Config_Source_Pricesource_Values
{
    public function toOptionArray()
    {
        return array(
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