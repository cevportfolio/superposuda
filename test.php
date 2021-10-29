<?php
require 'C:\Users\deadp\superposuda\vendor\autoload.php';
use RetailCrm\Api\Interfaces\ClientExceptionInterface;
use RetailCrm\Api\Interfaces\ApiExceptionInterface;
use RetailCrm\Api\Factory\SimpleClientFactory;
use RetailCrm\Api\Model\Entity\Customers\Customer;
use RetailCrm\Api\Model\Request\Customers\CustomersCreateRequest;

$client = SimpleClientFactory::createClient('https://cevladimir.retailcrm.ru', 'NuNuPM4dOQ5XE8QPWtp1ejb3TZwmhucW');

$request = new CustomersCreateRequest();
$request->customer = new Customer();

$request->site = 'cevladimir';
$request->customer->email = 'john.doe@example.com';
$request->customer->firstName = 'Vladimir';
$request->customer->lastName = 'Che';

try {
    $response = $client->customers->create($request);
} catch (ApiExceptionInterface | ClientExceptionInterface $exception) {
    echo $exception; // Every ApiExceptionInterface instance should implement __toString() method.
    exit(-1);
}

echo 'Customer ID: ' . $response->id;
