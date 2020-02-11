<?php

namespace App\Http\Traits;

use GuzzleHttp\Client;

trait GuzzleHelper
{
    public function guzzleGet($url)
    {
        $client = new Client(); //GuzzleHttp\Client
        $result = $client->get($url);
        return json_decode($result->getBody()->getContents());
    }

    public function guzzleShow($url)
    {
        $client = new Client(); //GuzzleHttp\Client
        $result = $client->get($url);
        return $result->getBody()->getContents();
    }
}
