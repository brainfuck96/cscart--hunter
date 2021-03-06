<?php
/***************************************************************************
 *                                                                          *
 *   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
 *                                                                          *
 * This  is  commercial  software,  only  users  who have purchased a valid *
 * license  and  accept  to the terms of the  License Agreement can install *
 * and use this program.                                                    *
 *                                                                          *
 ****************************************************************************
 * PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
 * "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
 ****************************************************************************/

namespace Tygh\Shippings\YandexDelivery;

class Config
{
    public $client_id = 0;
    public $ids = array(
        'client' => 0,
        'senders' => array(),
        'warehouses' => array(),
        'requisites' => array()
    );
    public $sender_id = 0;
    public $warehouse_id = 0;
    public $requisite_id = 0;
    public $api_url = '';
    public $format = '';

    public $keys = array(
        'getPaymentMethods' => '',
        'getDeliveryMethods' => '',
        'searchDeliveryList' => '',
        'createOrder' => '',
        'confirmSenderOrder' => '',
        'confirmSenderParcel' => '',
        'confirmSenderOrders' => '',
        'getSenderOrders' => '',
        'getSenderOrderLabel' => '',
        'getSenderParcelLabel' => '',
        'getSenderOrderStatus' => '',
        'getSenderOrderStatuses' => '',
        'getSenderNomenclature' => '',
        'getSenderGoodsBalans' => '',
        'getCities' => '',
        'getIndex' => '',
    );

    public $available_city_from = array();
}
