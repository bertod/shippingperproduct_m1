<?php


class Magenz_Shippingperproduct_Model_System_Config_Incrementprice
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => 'none',
                'label' => '-- Select one --',
            ),
            array(
                'value' => 'percentage',
                'label' => 'By Percentage of price',
            ),
            array(
                'value' => 'math',
                'label' => 'By mathematical expression',
            )

        );
    }
}