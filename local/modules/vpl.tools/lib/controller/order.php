<?php

namespace VPL\Tools\Controller;

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Loader;
use Bitrix\Sale;
use Bitrix\Sale\Delivery;
use Bitrix\Sale\Order as bxOrder;
use Bitrix\Main\Context;
use Bitrix\Sale\Basket;
use Bitrix\Currency\CurrencyManager;

class Order extends Controller
{

    /**
     * @return \array[][]
     */
    public function configureActions(): array
    {
        return [
            'orderOneClick' => [
                'prefilters' => [],
            ],
        ];
    }

    /**
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function orderOneClickAction(array $data): bool
    {
        if ($data['productID']) {

            Loader::includeModule("sale");
            Loader::includeModule("catalog");

            global $USER;
            $siteId = Context::getCurrent()->getSite();
            $deliveryID = Delivery\Services\EmptyDeliveryService::getEmptyDeliveryServiceId();
            $currencyCode = CurrencyManager::getBaseCurrency();

            $order = bxOrder::create($siteId, $USER->isAuthorized() ? $USER->GetID() : \CSaleUser::GetAnonymousUserID());
            $order->setPersonTypeId(1);
            if (strlen($data["text"]) > 0) {
                $order->setField('USER_DESCRIPTION', $data["text"]);
            }

            $basket = Basket::create($siteId);
            $item = $basket->createItem('catalog', $data['productID']);
            $item->setFields([
                'QUANTITY' => 1,
                'CURRENCY' => $currencyCode,
                'LID' => $siteId,
                'PRODUCT_PROVIDER_CLASS' => '\CCatalogProductProvider',
            ]);
            $order->setBasket($basket);

            $shipmentCollection = $order->getShipmentCollection();
            $shipment = $shipmentCollection->createItem();
            $service = Delivery\Services\Manager::getById($deliveryID);
            $shipment->setFields(array(
                'DELIVERY_ID' => $service['ID'],
                'DELIVERY_NAME' => $service['NAME'],
            ));
            $shipmentItemCollection = $shipment->getShipmentItemCollection();
            $shipmentItem = $shipmentItemCollection->createItem($item);
            $shipmentItem->setQuantity($item->getQuantity());

            $propertyCollection = $order->getPropertyCollection();
            foreach ($propertyCollection as $property) {
                $propCode = $property->getField('CODE');
                $property->setValue($data[$propCode]);
            }
            $order->doFinalAction(true);
            $result = $order->save();
            $status = $result->isSuccess();
            if($status){
                return $status;
            } else {
                throw new \Exception('При оформлении  заказа возникла техническая ошибка');
            }
        } else {
            throw new \Exception('Не указан товар который  необходимо покупать');
        }
    }
}