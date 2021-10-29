<?php
require 'C:\Users\deadp\superposuda\vendor\autoload.php';
use RetailCrm\Api\Interfaces\ClientExceptionInterface;
use RetailCrm\Api\Enum\CountryCodeIso3166;
use RetailCrm\Api\Enum\Customers\CustomerType;
use RetailCrm\Api\Factory\SimpleClientFactory;
use RetailCrm\Api\Interfaces\ApiExceptionInterface;
use RetailCrm\Api\Model\Entity\Orders\Delivery\OrderDeliveryAddress;
use RetailCrm\Api\Model\Entity\Orders\Delivery\SerializedOrderDelivery;
use RetailCrm\Api\Model\Entity\Orders\Items\Offer;
use RetailCrm\Api\Model\Entity\Orders\Items\OrderProduct;
use RetailCrm\Api\Model\Entity\Orders\Items\PriceType;
use RetailCrm\Api\Model\Entity\Orders\Items\Unit;
use RetailCrm\Api\Model\Entity\Orders\Order;
use RetailCrm\Api\Model\Entity\Orders\Payment;
use RetailCrm\Api\Model\Entity\Orders\SerializedRelationCustomer;
use RetailCrm\Api\Model\Request\Orders\OrdersCreateRequest;

$client = SimpleClientFactory::createClient('https://cevladimir.retailcrm.ru', 'NuNuPM4dOQ5XE8QPWtp1ejb3TZwmhucW');

$request         = new OrdersCreateRequest();
$order           = new Order();
$payment         = new Payment();
$delivery        = new SerializedOrderDelivery();
$deliveryAddress = new OrderDeliveryAddress();
$offer           = new Offer();
$item            = new OrderProduct();

// $offer->name        = 'Маникюрный набор AZ105R Azalita';      //Это почему-то все не работает. Как по бренду фильтровать вообще неясно. Кроме поля Производитель на сайте ничего нет или хитро спрятано.
// $offer->displayName     = 'Маникюрный набор AZ105R Azalita';  //Это почему-то все не работает. В документации ничего по поводу производителя или бренда найти не получается.
$offer->article     = 'AZ105R';

// $item->offer            = $offer;                             //Это почему-то все не работает. Кроме имени продукта вообще в сопоставлении ничего не работает.
$item->productName      = 'Маникюрный набор AZ105R Azalita';
// $item->article      = 'AZ105R';                               //Это почему-то все не работает. На форумах просто нет информации по этому апи. 

$order->items           = [$item];
$order->orderType       = 'fizik';
$order->orderMethod     = 'test';
$order->firstName       = 'Vladimir';
$order->lastName        = 'Che';
$order->patronymic      = 'Enhoevich';
$order->status          = 'trouble';
$order->customerComment = 'https://github.com/cevportfolio/superposuda';
$order->customFields  = [
    "prim" => 'тестовое задание'
];

$request->order = $order;
$request->site  = 'test';

try {
    $response = $client->orders->create($request);
} catch (ApiExceptionInterface | ClientExceptionInterface $exception) {
    echo $exception; // Every ApiExceptionInterface instance should implement __toString() method.
    exit(-1);
}

printf(
    'Created order id = %d with the following data: %s',
    $response->id,
    print_r($response->order, true)
);
