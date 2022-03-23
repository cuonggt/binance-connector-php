<?php

namespace Binance\Spot;

trait MarketData
{
    /**
     * Test connectivity to the Rest API.
     *
     * @return mixed
     */
    public function ping()
    {
        return $this->client->publicRequest('GET', '/api/v3/ping');
    }

    /**
     * Test connectivity to the Rest API and get the current server time.
     *
     * @return mixed
     */
    public function time()
    {
        return $this->client->publicRequest('GET', '/api/v3/time');
    }

    /**
     * Current exchange trading rules and symbol information.
     *
     * @param  string  $symbol
     * @return mixed
     */
    public function exchangeInfo($symbol)
    {
        $params = is_array($symbol) ? [
            'symbols' => '["'.implode('","', $symbol).'"]',
        ] : ['symbol' => $symbol];

        return $this->client->publicRequest('GET', '/api/v3/exchangeInfo', $params);
    }

    /**
     * Order Book.
     *
     * @param  string  $symbol
     * @param  array  $options
     * @return mixed
     */
    public function depth($symbol, array $options = [])
    {
        return $this->client->publicRequest('GET', '/api/v3/depth', array_merge([
            'symbol' => $symbol,
        ], $options));
    }

    /**
     * Get recent trades.
     *
     * @param  string  $symbol
     * @param  array  $options
     * @return mixed
     */
    public function trades($symbol, array $options = [])
    {
        return $this->client->publicRequest('GET', '/api/v3/trades', array_merge([
            'symbol' => $symbol,
        ], $options));
    }

    /**
     * Get older market trades.
     *
     * @param  string  $symbol
     * @param  array  $options
     * @return mixed
     */
    public function historicalTrades($symbol, array $options = [])
    {
        return $this->client->limitRequest('GET', '/api/v3/historicalTrades', array_merge([
            'symbol' => $symbol,
        ], $options));
    }

    /**
     * Get compressed, aggregate trades. Trades that fill at the time, from the same order,
     * with the same price will have the quantity aggregated.
     *
     * @param  string  $symbol
     * @param  array  $options
     * @return mixed
     */
    public function aggTrades($symbol, array $options = [])
    {
        return $this->client->publicRequest('GET', '/api/v3/aggTrades', array_merge([
            'symbol' => $symbol,
        ], $options));
    }

    /**
     * Kline/candlestick bars for a symbol.
     *
     * @param  string  $symbol
     * @param  string  $interval
     * @param  array  $options
     * @return mixed
     */
    public function klines($symbol, $interval, array $options = [])
    {
        return $this->client->publicRequest('GET', '/api/v3/klines', array_merge([
            'symbol' => $symbol,
            'interval' => $interval,
        ], $options));
    }

    /**
     * Current average price for a symbol.
     *
     * @param  string  $symbol
     * @return mixed
     */
    public function avgPrice($symbol)
    {
        return $this->client->publicRequest('GET', '/api/v3/avgPrice', [
            'symbol' => $symbol,
        ]);
    }

    /**
     * 24 hour rolling window price change statistics.
     *
     * @param  string|null  $symbol
     * @return mixed
     */
    public function ticker24hr($symbol = null)
    {
        return $this->client->publicRequest('GET', '/api/v3/ticker/24hr', [
            'symbol' => $symbol,
        ]);
    }

    /**
     * Latest price for a symbol or symbols.
     *
     * @param  string|null  $symbol
     * @return mixed
     */
    public function tickerPrice($symbol = null)
    {
        return $this->client->publicRequest('GET', '/api/v3/ticker/price', [
            'symbol' => $symbol,
        ]);
    }

    /**
     * Best price/qty on the order book for a symbol or symbols.
     *
     * @param  string|null  $symbol
     * @return mixed
     */
    public function bookTicker($symbol = null)
    {
        return $this->client->publicRequest('GET', '/api/v3/ticker/bookTicker', [
            'symbol' => $symbol,
        ]);
    }
}
