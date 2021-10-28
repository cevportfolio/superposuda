<?php

use RetailCrm\Api\Interfaces\ClientExceptionInterface;
use RetailCrm\Api\Interfaces\ApiExceptionInterface;
use RetailCrm\Api\Factory\SimpleClientFactory;
use RetailCrm\Api\Model\Entity\Customers\Customer;
use RetailCrm\Api\Model\Request\Customers\CustomersCreateRequest;

$client = SimpleClientFactory::createClient('https://test.retailcrm.pro', 'apiKey');

$request = new CustomersCreateRequest();
$request->customer = new Customer();

$request->site = 'aliexpress';
$request->customer->email = 'john.doe@example.com';
$request->customer->firstName = 'John';
$request->customer->lastName = 'Doe';

try {
    $response = $client->customers->create($request);
} catch (ApiExceptionInterface | ClientExceptionInterface $exception) {
    echo $exception; // Every ApiExceptionInterface instance should implement __toString() method.
    exit(-1);
}

echo 'Customer ID: ' . $response->id;
