<?php

namespace Binance\Futures;

trait Account
{
    /**
     * Change user's position mode (Hedge Mode or One-way Mode) on EVERY symbol.
     *
     * @param  string  $dualSidePosition
     * @param  array  $options
     * @return mixed
     */
    public function changePositionMode($dualSidePosition, array $options = [])
    {
        return $this->client->signRequest('POST', '/fapi/v1/positionSide/dual', array_merge([
            'dualSidePosition' => $dualSidePosition,
        ], $options));
    }

    /**
     * Get user's position mode (Hedge Mode or One-way Mode) on EVERY symbol.
     *
     * @param  array  $options
     * @return mixed
     */
    public function getCurrentPositionMode(array $options = [])
    {
        return $this->client->signRequest('GET', '/fapi/v1/positionSide/dual', $options);
    }

    /**
     * Change user's Multi-Assets mode (Multi-Assets Mode or Single-Asset Mode) on Every symbol.
     *
     * @param  string  $multiAssetsMargin
     * @param  array  $options
     * @return mixed
     */
    public function changeMultiAssetsMode($multiAssetsMargin, array $options = [])
    {
        return $this->client->signRequest('POST', '/fapi/v1/multiAssetsMargin', array_merge([
            'multiAssetsMargin' => $multiAssetsMargin,
        ], $options));
    }

    /**
     * Get user's Multi-Assets mode (Multi-Assets Mode or Single-Asset Mode) on Every symbol.
     *
     * @param  array  $options
     * @return mixed
     */
    public function getCurrentMultiAssetsMode(array $options = [])
    {
        return $this->client->signRequest('GET', '/fapi/v1/multiAssetsMargin', $options);
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
        return $this->client->signRequest('POST', '/fapi/v1/order', array_merge([
            'symbol' => $symbol,
            'side' => $side,
            'type' => $type,
        ], $options));
    }

    /**
     * Place Multiple Orders.
     *
     * @param  array  $batchOrders
     * @param  array  $options
     * @return mixed
     */
    public function batchOrders(array $batchOrders, array $options = [])
    {
        return $this->client->signRequest('POST', '/fapi/v1/batchOrders', array_merge([
            'batchOrders' => $batchOrders,
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
        return $this->client->signRequest('GET', '/fapi/v1/order', array_merge([
            'symbol' => $symbol,
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
        return $this->client->signRequest('DELETE', '/fapi/v1/order', array_merge([
            'symbol' => $symbol,
        ], $options));
    }

    /**
     * Cancel All Open Orders.
     *
     * @param  string  $symbol
     * @param  array  $options
     * @return mixed
     */
    public function cancelOpenOrders($symbol, array $options = [])
    {
        return $this->client->signRequest('DELETE', '/fapi/v1/allOpenOrders', array_merge([
            'symbol' => $symbol,
        ], $options));
    }

    /**
     * Cancel Multiple Orders.
     *
     * @param  string  $symbol
     * @param  array  $options
     * @return mixed
     */
    public function cancelMultipleOrders($symbol, array $options = [])
    {
        return $this->client->signRequest('DELETE', '/fapi/v1/batchOrders', array_merge([
            'symbol' => $symbol,
        ], $options));
    }

    /**
     * Cancel all open orders of the specified symbol at the end of the specified countdown..
     *
     * @param  string  $symbol
     * @param  int  $countdownTime
     * @param  array  $options
     * @return mixed
     */
    public function countdownCancelAll($symbol, $countdownTime, array $options = [])
    {
        return $this->client->signRequest('DELETE', '/fapi/v1/countdownCancelAll', array_merge([
            'symbol' => $symbol,
            'countdownTime' => $countdownTime,
        ], $options));
    }

    /**
     * Query Current Open Order.
     *
     * @param  string  $symbol
     * @param  array  $options
     * @return mixed
     */
    public function openOrder($symbol, array $options = [])
    {
        return $this->client->signRequest('GET', '/fapi/v1/openOrder', array_merge([
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
    public function openOrders($symbol = null, array $options = [])
    {
        return $this->client->signRequest('GET', '/fapi/v1/openOrders', array_merge([
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
        return $this->client->signRequest('GET', '/fapi/v1/allOrders', array_merge([
            'symbol' => $symbol,
        ], $options));
    }

    /**
     * Futures Account Balance V2.
     *
     * @param  array  $options
     * @return mixed
     */
    public function balance(array $options = [])
    {
        return $this->client->signRequest('GET', '/fapi/v2/balance', $options);
    }

    /**
     * Get current account information. User in single-asset/ multi-assets mode will see different value,
     * see comments in response section for detail.
     *
     * @param  array  $options
     * @return mixed
     */
    public function account(array $options = [])
    {
        return $this->client->signRequest('GET', '/fapi/v2/account', $options);
    }

    /**
     * Change user's initial leverage of specific symbol market.
     *
     * @param  string  $symbol
     * @param  int  $leverage
     * @param  array  $options
     * @return mixed
     */
    public function leverage($symbol, $leverage, array $options = [])
    {
        return $this->client->signRequest('POST', '/fapi/v1/leverage', array_merge([
            'symbol' => $symbol,
            'leverage' => $leverage,
        ], $options));
    }

    /**
     * Change Margin Type.
     *
     * @param  string  $symbol
     * @param  string  $marginType
     * @param  array  $options
     * @return mixed
     */
    public function marginType($symbol, $marginType, array $options = [])
    {
        return $this->client->signRequest('POST', '/fapi/v1/marginType', array_merge([
            'symbol' => $symbol,
            'marginType' => $marginType,
        ], $options));
    }

    /**
     * Modify Isolated Position Margin.
     *
     * @param  string  $symbol
     * @param  float  $amount
     * @param  int  $type
     * @param  array  $options
     * @return mixed
     */
    public function positionMargin($symbol, $amount, $type, array $options = [])
    {
        return $this->client->signRequest('POST', '/fapi/v1/positionMargin', array_merge([
            'symbol' => $symbol,
            'amount' => $amount,
            'type' => $type,
        ], $options));
    }

    /**
     * Get Position Margin Change History.
     *
     * @param  string  $symbol
     * @param  array  $options
     * @return mixed
     */
    public function positionMarginHistory($symbol, array $options = [])
    {
        return $this->client->signRequest('GET', '/fapi/v1/positionMargin/history', array_merge([
            'symbol' => $symbol,
        ], $options));
    }

    /**
     * Get current position information.
     *
     * @param  string|null  $symbol
     * @param  array  $options
     * @return mixed
     */
    public function positionRisk($symbol = null, array $options = [])
    {
        return $this->client->signRequest('GET', '/fapi/v2/positionRisk', array_merge([
            'symbol' => $symbol,
        ], $options));
    }

    /**
     * Get trades for a specific account and symbol.
     *
     * @param  string  $symbol
     * @param  array  $options
     * @return mixed
     */
    public function userTrades($symbol, array $options = [])
    {
        return $this->client->signRequest('GET', '/fapi/v1/userTrades', array_merge([
            'symbol' => $symbol,
        ], $options));
    }

    /**
     * Get Income History.
     *
     * @param  array  $options
     * @return mixed
     */
    public function income(array $options = [])
    {
        return $this->client->signRequest('GET', '/fapi/v1/income', $options);
    }

    /**
     * Notional and Leverage Brackets.
     *
     * @param  array  $options
     * @return mixed
     */
    public function leverageBracket(array $options = [])
    {
        return $this->client->signRequest('GET', '/fapi/v1/leverageBracket', $options);
    }

    /**
     * Position ADL Quantile Estimation.
     *
     * @param  array  $options
     * @return mixed
     */
    public function adlQuantile(array $options = [])
    {
        return $this->client->signRequest('GET', '/fapi/v1/adlQuantile', $options);
    }

    /**
     * User's Force Orders.
     *
     * @param  array  $options
     * @return mixed
     */
    public function forceOrders(array $options = [])
    {
        return $this->client->signRequest('GET', '/fapi/v1/forceOrders', $options);
    }

    /**
     * Futures Trading Quantitative Rules Indicators.
     *
     * @param  array  $options
     * @return mixed
     */
    public function apiTradingStatus(array $options = [])
    {
        return $this->client->signRequest('GET', '/fapi/v1/apiTradingStatus', $options);
    }

    /**
     * User Commission Rate.
     *
     * @param  array  $options
     * @return mixed
     */
    public function commissionRate(array $options = [])
    {
        return $this->client->signRequest('GET', '/fapi/v1/commissionRate', $options);
    }

    /**
     * Get Download Id For Futures Transaction History.
     *
     * @param  int  $startTime
     * @param  int  $endTime
     * @param  array  $options
     * @return mixed
     */
    public function getDownloadIdForFuturesTransactionHistory($startTime, $endTime, array $options = [])
    {
        return $this->client->signRequest('GET', '/fapi/v1/income/asyn', array_merge([
            'startTime' => $startTime,
            'endTime' => $endTime,
        ], $options));
    }

    /**
     * Get Futures Transaction History Download Link by Id.
     *
     * @param  int  $downloadId
     * @param  array  $options
     * @return mixed
     */
    public function getFuturesTransactionHistoryDownloadLinkById($downloadId, array $options = [])
    {
        return $this->client->signRequest('GET', '/fapi/v1/income/asyn/id', array_merge([
            'downloadId' => $downloadId,
        ], $options));
    }
}
