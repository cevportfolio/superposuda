<?php
require 'C:\Users\deadp\superposuda\vendor\autoload.php';
use RetailCrm\Api\Interfaces\ClientExceptionInterface;
use RetailCrm\Api\Factory\SimpleClientFactory;
use RetailCrm\Api\Interfaces\ApiExceptionInterface;
use RetailCrm\Api\Model\Entity\Orders\Items\Offer;
use RetailCrm\Api\Model\Entity\Orders\Items\OrderProduct;
use RetailCrm\Api\Model\Entity\Orders\Order;
use RetailCrm\Api\Model\Request\Orders\OrdersCreateRequest;

$client = SimpleClientFactory::createClient('https://superposuda.retailcrm.ru', 'QlnRWTTWw9lv3kjxy1A8byjUmBQedYqb');

$request         = new OrdersCreateRequest();
$order           = new Order();
$offer           = new Offer();
$item            = new OrderProduct();

// $offer->name        = 'Маникюрный набор AZ105R Azalita';      //Это почему-то все не работает. Как по бренду фильтровать вообще неясно. Кроме поля Производитель на сайте ничего нет или хитро спрятано.
// $offer->displayName     = 'Маникюрный набор AZ105R Azalita';  //Это почему-то все не работает. В документации ничего по поводу производителя или бренда найти не получается.
// $offer->article     = 'AZ105R';

// $item->offer            = $offer;                             //Это почему-то все не работает. Кроме имени продукта вообще в сопоставлении ничего не работает.
$item->productName      = 'Маникюрный набор AZ105R Azalita';
// $item->article      = 'AZ105R';                               //Это почему-то все не работает. На форумах просто нет информации по этому апи. 

$order->items           = [$item];
$order->number           = '15.03.1984';
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
