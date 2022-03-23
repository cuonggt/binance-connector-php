<?php

namespace Binance\Spot;

trait Account
{
    /**
     * Test new order creation and signature/recvWindow long. Creates and validates a new order
     * but does not send it into the matching engine.
     *
     * @param  string  $symbol
     * @param  string  $side
     * @param  string  $type
     * @param  array  $options
     * @return mixed
     */
    public function testNewOrder($symbol, $side, $type, array $options = [])
    {
        return $this->client->signRequest('POST', '/api/v3/order/test', array_merge([
            'symbol' => $symbol,
            'side' => $side,
            'type' => $type,
        ], $options));
    }

    /**
     * Send in a new order.
     *
     * @param  string  $symbol
     * @param  string  $side
     * @param  string  $type
     * @param  array  $options
     * @return mixed
     */
    public function newOrder($symbol, $side, $type, array $options = [])
    {
        return $this->client->signRequest('POST', '/api/v3/order', array_merge([
            'symbol' => $symbol,
            'side' => $side,
            'type' => $type,
        ], $options));
    }

    /**
     * Cancel an active order.
     *
     * @param  string  $symbol
     * @param  array  $options
     * @return mixed
     */
    public function cancelOrder($symbol, array $options = [])
    {
        return $this->client->signRequest('DELETE', '/api/v3/order', array_merge([
            'symbol' => $symbol,
        ], $options));
    }

    /**
     * Cancels all active orders on a symbol.
     * This includes OCO orders.
     *
     * @param  string  $symbol
     * @param  array  $options
     * @return mixed
     */
    public function cancelOpenOrders($symbol, array $options = [])
    {
        return $this->client->signRequest('DELETE', '/api/v3/openOrders', array_merge([
            'symbol' => $symbol,
        ], $options));
    }

    /**
     * Check an order's status.
     *
     * @param  string  $symbol
     * @param  array  $options
     * @return mixed
     */
    public function queryOrder($symbol, array $options = [])
    {
        return $this->client->signRequest('GET', '/api/v3/order', array_merge([
            'symbol' => $symbol,
        ], $options));
    }

    /**
     * Get all open orders on a symbol. Careful when accessing this with no symbol.
     *
     * @param  string  $symbol
     * @param  array  $options
     * @return mixed
     */
    public function currentOpenOrders($symbol = null, array $options = [])
    {
        return $this->client->signRequest('GET', '/api/v3/openOrders', array_merge([
            'symbol' => $symbol,
        ], $options));
    }

    /**
     * Get all account orders; active, canceled, or filled.
     *
     * @param  string  $symbol
     * @param  array  $options
     * @return mixed
     */
    public function allOrders($symbol, array $options = [])
    {
        return $this->client->signRequest('GET', '/api/v3/allOrders', array_merge([
            'symbol' => $symbol,
        ], $options));
    }

    /**
     * Send in a new OCO.
     *
     * @param  string  $symbol
     * @param  string  $side
     * @param  string  $quantity
     * @param  string  $price
     * @param  string  $stopPrice
     * @param  array  $options
     * @return mixed
     */
    public function newOCO($symbol, $side, $quantity, $price, $stopPrice, array $options = [])
    {
        return $this->client->signRequest('POST', '/api/v3/order/oco', array_merge([
            'symbol' => $symbol,
            'side' => $side,
            'quantity' => $quantity,
            'price' => $price,
            'stopPrice' => $stopPrice,
        ], $options));
    }

    /**
     * Cancel an entire Order List.
     *
     * @param  string  $symbol
     * @param  array  $options
     * @return mixed
     */
    public function cancelOCO($symbol, array $options = [])
    {
        return $this->client->signRequest('DELETE', '/api/v3/orderList', array_merge([
            'symbol' => $symbol,
        ], $options));
    }

    /**
     * Retrieves a specific OCO based on provided optional parameters.
     *
     * @param  array  $options
     * @return mixed
     */
    public function queryOCO($options = [])
    {
        return $this->client->signRequest('GET', '/api/v3/orderList', $options);
    }

    /**
     * Retrieves all OCO based on provided optional parameters.
     *
     * @param  array  $options
     * @return mixed
     */
    public function queryAllOCO($options = [])
    {
        return $this->client->signRequest('GET', '/api/v3/allOrderList', $options);
    }

    /**
     * Query Open OCO.
     *
     * @param  array  $options
     * @return mixed
     */
    public function queryOpenOCO($options = [])
    {
        return $this->client->signRequest('GET', '/api/v3/openOrderList', $options);
    }

    /**
     * Get current account information.
     *
     * @param  array  $options
     * @return mixed
     */
    public function account($options = [])
    {
        return $this->client->signRequest('GET', '/api/v3/account', $options);
    }

    /**
     * Get trades for a specific account and symbol.
     *
     * @param  string  $symbol
     * @param  array  $options
     * @return mixed
     */
    public function myTrades($symbol, array $options = [])
    {
        return $this->client->signRequest('DELETE', '/api/v3/myTrades', array_merge([
            'symbol' => $symbol,
        ], $options));
    }

    /**
     * Displays the user's current order count usage for all intervals.
     *
     * @param  array  $options
     * @return mixed
     */
    public function queryCurrentOrderCountUsage($options = [])
    {
        return $this->client->signRequest('GET', '/api/v3/rateLimit/order', $options);
    }
}
