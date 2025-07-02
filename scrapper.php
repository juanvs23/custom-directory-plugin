<?php
require  __DIR__.'/vendor/autoload.php';

use GuzzleHttp\Client;
use  Symfony\Component\DomCrawler\Crawler;

$url = 'https://recovery.com/california/';


$client = new Client();
$response = $client->request('GET', $url);

$html = $response->getBody();

$crawler = new Crawler($html->getContents()); 

$items = [];

$count = 0;
$crawler->filter('h3.title-style')->each(function (Crawler $node) use (&$items, &$count) {
    $items[]['title'] = $node->text();
    
});



var_dump($items);