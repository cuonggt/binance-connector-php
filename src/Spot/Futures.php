<?php

namespace Binance\Spot;

trait Futures
{
    /**
     * Execute transfer between spot account and futures account.
     *
     * @param  string  $asset
     * @param  float  $amount
     * @param  int  $type
     * @param  array  $options
     * @return mixed
     */
    public function newFutureAccountTransfer($asset, $amount, $type, array $options = [])
    {
        return $this->client->signRequest('POST', '/sapi/v1/futures/transfer', array_merge([
            'asset' => $asset,
            'amount' => $amount,
            'type' => $type,
        ], $options));
    }

    /**
     * Get Future Account Transaction History List.
     *
     * @param  string  $asset
     * @param  int  $startTime
     * @param  array  $options
     * @return mixed
     */
    public function getFutureAccountTransactionHistoryList($asset, $startTime, array $options = [])
    {
        return $this->client->signRequest('GET', '/sapi/v1/futures/transfer', array_merge([
            'asset' => $asset,
            'startTime' => $startTime,
        ], $options));
    }
}
