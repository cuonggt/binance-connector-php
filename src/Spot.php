<?php

namespace Binance;

class Spot
{
    use Spot\Account;
    use Spot\MarketData;
    use Spot\UserData;
    use Spot\WebsocketMarket;

    /**
     * The Binance client instance.
     *
     * @var \Binance\Client
     */
    public $client;

    /**
     * Create a new Binance Spot instance.
     *
     * @param  array  $options
     * @return void
     */
    public function __construct($options = [])
    {
        $this->client = new Client(array_merge([
            'base_url' => 'https://api.binance.com',
            'base_websocket_url' => 'wss://stream.binance.com:9443',
        ], $options));
    }
}
