<?php

namespace Binance;

class Futures
{
    use Futures\Account;
    use Futures\MarketData;
    use Futures\UserData;
    use Futures\WebsocketMarket;

    /**
     * The Binance client instance.
     *
     * @var \Binance\Client
     */
    public $client;

    /**
     * Create a new Binance Futures instance.
     *
     * @param  array  $options
     * @return void
     */
    public function __construct($options = [])
    {
        $this->client = new Client(array_merge([
            'base_url' => 'https://fapi.binance.com',
            'base_websocket_url' => 'wss://fstream.binance.com',
        ], $options));
    }
}
